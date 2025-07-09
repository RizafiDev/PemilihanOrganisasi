<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Services\PemilihanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    protected $pemilihanService;

    public function __construct(PemilihanService $pemilihanService)
    {
        $this->pemilihanService = $pemilihanService;
    }

    public function index()
    {
        $kandidatPutra = Kandidat::putra()->get();
        $kandidatPutri = Kandidat::putri()->get();
        $jumlahKandidatPutra = Kandidat::putra()->count();
        $jumlahKandidatPutri = Kandidat::putri()->count();
        $totalKandidat = Kandidat::count();
        return view('vote.index', compact('kandidatPutra', 'kandidatPutri', 'totalKandidat', 'jumlahKandidatPutra', 'jumlahKandidatPutri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'votes' => 'required|array|min:1',
            'votes.*' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            // Create unique identifier combining session ID and IP
            $voterIdentifier = session()->getId() . '_' . request()->ip();

            // Check if this voter has already voted
            $existingVote = \App\Models\Vote::where('voter_identifier', $voterIdentifier)->first();
            if ($existingVote) {
                return response()->json([
                    'success' => false,
                    'message' => 'Perangkat ini sudah pernah melakukan voting'
                ], 422);
            }

            $positions = ['pradana', 'wakil', 'adat'];
            $putraVotes = [];
            $putriVotes = [];
            $usedPositions = [
                'putra' => [],
                'putri' => []
            ];

            foreach ($request->votes as $voteJson) {
                $vote = json_decode($voteJson, true);

                if (!$vote || !isset($vote['kandidat_id']) || !isset($vote['jabatan'])) {
                    throw new \Exception('Format vote tidak valid');
                }

                $kandidat = Kandidat::find($vote['kandidat_id']);
                if (!$kandidat) {
                    throw new \Exception('Kandidat tidak ditemukan');
                }

                // Validate position exists
                if (!in_array($vote['jabatan'], $positions)) {
                    throw new \Exception('Jabatan tidak valid: ' . $vote['jabatan']);
                }

                $kategori = $kandidat->jenis_kelamin === 'Laki-laki' ? 'putra' : 'putri';

                // Check for duplicate positions within same category
                if (in_array($vote['jabatan'], $usedPositions[$kategori])) {
                    throw new \Exception('Posisi ' . $vote['jabatan'] . ' untuk kategori ' . $kategori . ' sudah dipilih');
                }

                $usedPositions[$kategori][] = $vote['jabatan'];

                if ($kandidat->jenis_kelamin === 'Laki-laki') {
                    $putraVotes[$vote['jabatan']] = $vote['kandidat_id'];
                } else {
                    $putriVotes[$vote['jabatan']] = $vote['kandidat_id'];
                }
            }

            // Save all votes (flexible - tidak harus lengkap semua posisi)
            foreach ($request->votes as $voteJson) {
                $vote = json_decode($voteJson, true);

                $this->pemilihanService->simpanVote(
                    $vote['kandidat_id'],
                    $vote['jabatan'],
                    $voterIdentifier
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pilihan berhasil disimpan',
                'total_votes' => count($request->votes)
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Data yang dikirim tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            DB::rollback();

            \Log::error('Vote store error: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'ip' => request()->ip()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
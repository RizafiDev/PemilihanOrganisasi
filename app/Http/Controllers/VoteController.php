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

        return view('vote.index', compact('kandidatPutra', 'kandidatPutri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'votes' => 'required|array|size:6',
            'votes.*' => 'required|json'
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

            // Validate that we have exactly 6 votes (3 putra, 3 putri)
            $positions = ['pradana', 'wakil', 'adat'];
            $putraVotes = [];
            $putriVotes = [];

            foreach ($request->votes as $voteJson) {
                $vote = json_decode($voteJson, true);
                
                if (!$vote || !isset($vote['kandidat_id']) || !isset($vote['jabatan'])) {
                    throw new \Exception('Format vote tidak valid');
                }

                $kandidat = Kandidat::find($vote['kandidat_id']);
                if (!$kandidat) {
                    throw new \Exception('Kandidat tidak ditemukan');
                }

                if ($kandidat->jenis_kelamin === 'Laki-laki') {
                    $putraVotes[$vote['jabatan']] = $vote['kandidat_id'];
                } else {
                    $putriVotes[$vote['jabatan']] = $vote['kandidat_id'];
                }
            }

            // Validate we have all required positions for both categories
            foreach ($positions as $position) {
                if (!isset($putraVotes[$position]) || !isset($putriVotes[$position])) {
                    throw new \Exception('Pilihan tidak lengkap. Harus memilih 3 posisi untuk putra dan 3 posisi untuk putri');
                }
            }

            // Save all votes
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
                'message' => 'Pilihan berhasil disimpan'
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\KandidatFirebase;
use App\Services\PemilihanFirebaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    protected $pemilihanService;
    protected $kandidatModel;

    public function __construct(PemilihanFirebaseService $pemilihanService)
    {
        $this->pemilihanService = $pemilihanService;
        $this->kandidatModel = new KandidatFirebase();
    }

    public function index()
    {
        $kandidatPutra = $this->kandidatModel->putra();
        $kandidatPutri = $this->kandidatModel->putri();
        $jumlahKandidatPutra = $kandidatPutra->count();
        $jumlahKandidatPutri = $kandidatPutri->count();
        $totalKandidat = $this->kandidatModel->count();

        return view('vote.index', compact('kandidatPutra', 'kandidatPutri', 'totalKandidat', 'jumlahKandidatPutra', 'jumlahKandidatPutri'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'votes' => 'required|array|min:1',
            'votes.*' => 'required|string'
        ]);

        try {
            // Create unique identifier combining session ID and IP
            $voterIdentifier = session()->getId() . '_' . request()->ip();

            // Check if this voter has already voted
            $existingVote = $this->pemilihanService->checkExistingVote($voterIdentifier);
            if ($existingVote) {
                return response()->json([
                    'success' => false,
                    'message' => 'Perangkat ini sudah pernah melakukan voting'
                ], 422);
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

            return response()->json([
                'success' => true,
                'message' => 'Pilihan berhasil disimpan',
                'total_votes' => count($request->votes)
            ]);

        } catch (\Exception $e) {
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
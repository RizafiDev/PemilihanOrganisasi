<?php

namespace App\Services;

use App\Models\KandidatFirebase;
use App\Models\VoteFirebase;

class PemilihanFirebaseService
{
    protected $kandidatModel;
    protected $voteModel;

    public function __construct()
    {
        $this->kandidatModel = new KandidatFirebase();
        $this->voteModel = new VoteFirebase();
    }

    public function checkExistingVote($voterIdentifier)
    {
        return $this->voteModel->findByVoterIdentifier($voterIdentifier);
    }

    public function simpanVote($kandidatId, $jabatan, $voterIdentifier = null)
    {
        return $this->voteModel->create([
            'kandidat_id' => $kandidatId,
            'jabatan_dipilih' => $jabatan,
            'voter_identifier' => $voterIdentifier,
            'ip_address' => request()->ip()
        ]);
    }

    public function hitungHasilPemilihan()
    {
        $kandidatPutra = $this->kandidatModel->putra();
        $kandidatPutri = $this->kandidatModel->putri();

        $hasilPutra = $this->tentukanJabatan($kandidatPutra, 'putra');
        $hasilPutri = $this->tentukanJabatan($kandidatPutri, 'putri');

        return [
            'putra' => $hasilPutra,
            'putri' => $hasilPutri
        ];
    }

    private function tentukanJabatan($kandidats, $jenisKelamin)
    {
        $hasil = [];
        $jabatanTerpakai = [];

        // Calculate vote counts for each kandidat
        $kandidatsWithVotes = $kandidats->map(function ($kandidat) {
            $kandidat['vote_pradana'] = $this->voteModel->getVotesByKandidatAndJabatan($kandidat['id'], 'pradana');
            $kandidat['vote_wakil'] = $this->voteModel->getVotesByKandidatAndJabatan($kandidat['id'], 'wakil');
            $kandidat['vote_adat'] = $this->voteModel->getVotesByKandidatAndJabatan($kandidat['id'], 'adat');
            return $kandidat;
        });

        // Sort by highest total votes
        $kandidatsSorted = $kandidatsWithVotes->sortByDesc(function ($kandidat) {
            return max([
                $kandidat['vote_pradana'],
                $kandidat['vote_wakil'],
                $kandidat['vote_adat']
            ]);
        });

        foreach ($kandidatsSorted as $kandidat) {
            $jabatanTertinggi = $this->getJabatanTertinggi($kandidat);
            $jabatanFinal = $jabatanTertinggi . '_' . strtolower($jenisKelamin);

            // If position is not taken, assign to this kandidat
            if (!in_array($jabatanTertinggi, $jabatanTerpakai)) {
                $jabatanTerpakai[] = $jabatanTertinggi;

                // Update kandidat with selected position
                $this->kandidatModel->update($kandidat['id'], ['jabatan_terpilih' => $jabatanFinal]);

                $hasil[$jabatanFinal] = [
                    'kandidat' => $kandidat,
                    'suara' => $kandidat['vote_' . strtolower($jabatanTertinggi)]
                ];
            }
        }

        return $hasil;
    }

    private function getJabatanTertinggi($kandidat)
    {
        $suara = [
            'pradana' => $kandidat['vote_pradana'],
            'wakil' => $kandidat['vote_wakil'],
            'adat' => $kandidat['vote_adat']
        ];

        return array_keys($suara, max($suara))[0];
    }
}
<?php

namespace App\Services;

use App\Models\Kandidat;
use App\Models\Vote;

class PemilihanService
{
    public function hitungHasilPemilihan()
    {
        $kandidatPutra = Kandidat::putra()->get();
        $kandidatPutri = Kandidat::putri()->get();

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

        // Urutkan kandidat berdasarkan total suara tertinggi
        $kandidatsSorted = $kandidats->sortByDesc(function ($kandidat) {
            return max([
                $kandidat->getSuaraPradana(),
                $kandidat->getSuaraWakil(),
                $kandidat->getSuaraAdat()
            ]);
        });

        foreach ($kandidatsSorted as $kandidat) {
            $jabatanTertinggi = $kandidat->getJabatanTertinggi();
            $jabatanFinal = $jabatanTertinggi . '_' . strtolower($jenisKelamin);

            // Jika jabatan belum terpakai, assign ke kandidat ini
            if (!in_array($jabatanTertinggi, $jabatanTerpakai)) {
                $jabatanTerpakai[] = $jabatanTertinggi;
                $kandidat->update(['jabatan_terpilih' => $jabatanFinal]);

                $hasil[$jabatanFinal] = [
                    'kandidat' => $kandidat,
                    'suara' => $kandidat->{'getSuara' . ucfirst($jabatanTertinggi)}()
                ];
            }
        }

        return $hasil;
    }

    public function simpanVote($kandidatId, $jabatan, $voterIdentifier = null)
    {
        return Vote::create([
            'kandidat_id' => $kandidatId,
            'jabatan_dipilih' => $jabatan,
            'voter_identifier' => $voterIdentifier,
            'ip_address' => request()->ip()
        ]);
    }
}
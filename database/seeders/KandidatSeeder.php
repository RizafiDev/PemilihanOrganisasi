<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kandidat;

class KandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kandidats = [
            [
                'nama' => 'Ahmad Sukarno',
                'jenis_kelamin' => 'Laki-laki',
                'foto' => 'ahmad-sukarno.jpg',
                'jabatan_terpilih' => null,
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'jenis_kelamin' => 'Perempuan',
                'foto' => 'siti-nurhaliza.jpg',
                'jabatan_terpilih' => null,
            ],
            [
                'nama' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'foto' => 'budi-santoso.jpg',
                'jabatan_terpilih' => null,
            ],
            [
                'nama' => 'Maya Sari',
                'jenis_kelamin' => 'Perempuan',
                'foto' => 'maya-sari.jpg',
                'jabatan_terpilih' => null,
            ],
            [
                'nama' => 'Andi Pratama',
                'jenis_kelamin' => 'Laki-laki',
                'foto' => 'andi-pratama.jpg',
                'jabatan_terpilih' => null,
            ],
            [
                'nama' => 'Luna',
                'jenis_kelamin' => 'Perempuan',
                'foto' => 'maya-sari.jpg',
                'jabatan_terpilih' => null,
            ],
        ];

        foreach ($kandidats as $kandidat) {
            Kandidat::create($kandidat);
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'foto',
        'jabatan_terpilih'
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    // Method untuk menghitung suara per jabatan
    public function getSuaraPradana()
    {
        return $this->votes()->where('jabatan_dipilih', 'pradana')->count();
    }

    public function getSuaraWakil()
    {
        return $this->votes()->where('jabatan_dipilih', 'wakil')->count();
    }

    public function getSuaraAdat()
    {
        return $this->votes()->where('jabatan_dipilih', 'adat')->count();
    }

    // Method untuk menentukan jabatan dengan suara terbanyak
    public function getJabatanTertinggi()
    {
        $suara = [
            'pradana' => $this->getSuaraPradana(),
            'wakil' => $this->getSuaraWakil(),
            'adat' => $this->getSuaraAdat()
        ];

        return array_keys($suara, max($suara))[0];
    }

    // Scope untuk filter berdasarkan jenis kelamin
    public function scopePutra($query)
    {
        return $query->where('jenis_kelamin', 'Laki-laki');
    }

    public function scopePutri($query)
    {
        return $query->where('jenis_kelamin', 'Perempuan');
    }
}

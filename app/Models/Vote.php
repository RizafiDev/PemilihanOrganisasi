<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'kandidat_id',
        'jabatan_dipilih',
        'voter_identifier',
        'ip_address'
    ];

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}

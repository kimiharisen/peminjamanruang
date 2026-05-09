<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    protected $table = 'peminjams';

    protected $fillable = [
        'nama',
        'nim',
        'nomor_hp',
        'jenis_akun',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
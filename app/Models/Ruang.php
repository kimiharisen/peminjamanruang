<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    protected $fillable = [
        'nama_ruang',
        'kapasitas',
        'gedung',
        'lantai',
        'status_ketersediaan',
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function isAvailable(): bool
    {
        return $this->status_ketersediaan === 'tersedia';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    protected $fillable = [
        'kode',
        'nama_peralatan',
        'stok',
        'kategori',
    ];

    public function peminjamans()
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_peralatan')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    public function hasEnoughStock(int $jumlah): bool
    {
        return $jumlah <= $this->stok;
    }
}

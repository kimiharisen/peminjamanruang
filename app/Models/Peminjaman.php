<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'peminjam_id',
        'ruang_id',
        'tanggal_pengajuan',
        'tanggal_pakai',
        'durasi_jam',
        'status',
        'waktu_pengembalian_aktual',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_pakai' => 'date',
        'waktu_pengembalian_aktual' => 'datetime',
    ];

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function peralatans()
    {
        return $this->belongsToMany(Peralatan::class, 'peminjaman_peralatan')
            ->withPivot('jumlah')
            ->withTimestamps();
    }

    public static function isValidStatus(string $status): bool
    {
        return in_array($status, ['menunggu', 'disetujui', 'ditolak', 'selesai']);
    }

    public static function isValidDuration(int $durasiJam): bool
    {
        return $durasiJam > 0;
    }

    public static function hasRequiredFields(array $data, array $requiredFields): bool
    {
        foreach ($requiredFields as $field) {
            if (!isset($data[$field]) || $data[$field] === '') {
                return false;
            }
        }

        return true;
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;

class ReportController extends Controller
{
    public function exportPeminjamanCsv()
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Hanya admin yang dapat mengekspor laporan.');
        }

        $peminjamans = Peminjaman::with(['peminjam', 'ruang', 'peralatans'])
            ->latest()
            ->get();

        $csv = Writer::createFromString('');

        $csv->insertOne([
            'ID Peminjaman',
            'Nama Peminjam',
            'NIM',
            'Jenis Akun',
            'Ruang',
            'Tanggal Pengajuan',
            'Tanggal Pakai',
            'Durasi Jam',
            'Status',
            'Waktu Pengembalian Aktual',
            'Keterangan',
            'Peralatan Dipinjam',
        ]);

        foreach ($peminjamans as $peminjaman) {
            $daftarPeralatan = $peminjaman->peralatans
                ->map(function ($peralatan) {
                    return $peralatan->nama_peralatan . ' (' . $peralatan->pivot->jumlah . ')';
                })
                ->implode('; ');

            $csv->insertOne([
                $peminjaman->id,
                $peminjaman->peminjam->nama ?? '-',
                $peminjaman->peminjam->nim ?? '-',
                $peminjaman->peminjam->jenis_akun ?? '-',
                $peminjaman->ruang->nama_ruang ?? '-',
                $peminjaman->tanggal_pengajuan ? $peminjaman->tanggal_pengajuan->format('d-m-Y') : '-',
                $peminjaman->tanggal_pakai ? $peminjaman->tanggal_pakai->format('d-m-Y') : '-',
                $peminjaman->durasi_jam,
                $peminjaman->status,
                $peminjaman->waktu_pengembalian_aktual
                    ? $peminjaman->waktu_pengembalian_aktual->format('d-m-Y H:i')
                    : '-',
                $peminjaman->keterangan,
                $daftarPeralatan ?: '-',
            ]);
        }

        $filename = 'laporan_peminjaman_' . now()->format('Ymd_His') . '.csv';

        return response($csv->toString(), 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
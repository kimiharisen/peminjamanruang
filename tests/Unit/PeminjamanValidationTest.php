<?php

namespace Tests\Unit;

use App\Models\Peminjaman;
use App\Models\Peralatan;
use App\Models\Ruang;
use PHPUnit\Framework\TestCase;

class PeminjamanValidationTest extends TestCase
{
    public function test_durasi_harus_lebih_dari_nol(): void
    {
        $this->assertTrue(Peminjaman::isValidDuration(1));
        $this->assertTrue(Peminjaman::isValidDuration(3));

        $this->assertFalse(Peminjaman::isValidDuration(0));
        $this->assertFalse(Peminjaman::isValidDuration(-1));
    }

    public function test_status_peminjaman_harus_valid(): void
    {
        $this->assertTrue(Peminjaman::isValidStatus('menunggu'));
        $this->assertTrue(Peminjaman::isValidStatus('disetujui'));
        $this->assertTrue(Peminjaman::isValidStatus('ditolak'));
        $this->assertTrue(Peminjaman::isValidStatus('selesai'));

        $this->assertFalse(Peminjaman::isValidStatus('batal'));
        $this->assertFalse(Peminjaman::isValidStatus('diproses'));
    }

    public function test_jumlah_peralatan_tidak_boleh_melebihi_stok(): void
    {
        $peralatan = new Peralatan([
            'stok' => 5,
        ]);

        $this->assertTrue($peralatan->hasEnoughStock(1));
        $this->assertTrue($peralatan->hasEnoughStock(5));

        $this->assertFalse($peralatan->hasEnoughStock(6));
    }

    public function test_ruang_harus_tersedia(): void
    {
        $ruangTersedia = new Ruang([
            'status_ketersediaan' => 'tersedia',
        ]);

        $ruangTidakTersedia = new Ruang([
            'status_ketersediaan' => 'tidak_tersedia',
        ]);

        $this->assertTrue($ruangTersedia->isAvailable());
        $this->assertFalse($ruangTidakTersedia->isAvailable());
    }

    public function test_field_wajib_tidak_boleh_kosong(): void
    {
        $requiredFields = [
            'peminjam_id',
            'ruang_id',
            'tanggal_pakai',
            'durasi_jam',
            'keterangan',
        ];

        $validData = [
            'peminjam_id' => 1,
            'ruang_id' => 1,
            'tanggal_pakai' => '2026-05-10',
            'durasi_jam' => 2,
            'keterangan' => 'Seminar akademik',
        ];

        $invalidData = [
            'peminjam_id' => 1,
            'ruang_id' => '',
            'tanggal_pakai' => '2026-05-10',
            'durasi_jam' => 2,
            'keterangan' => 'Seminar akademik',
        ];

        $this->assertTrue(Peminjaman::hasRequiredFields($validData, $requiredFields));
        $this->assertFalse(Peminjaman::hasRequiredFields($invalidData, $requiredFields));
    }
}
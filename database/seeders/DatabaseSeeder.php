<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Peminjam;
use App\Models\Ruang;
use App\Models\Peralatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Sertifikasi',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User Operator',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Staff Akademik',
            'email' => 'staff@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Peminjam::create([
            'nama' => 'Budi Santoso',
            'nim' => '220101001',
            'nomor_hp' => '081234567890',
            'jenis_akun' => 'mahasiswa',
        ]);

        Peminjam::create([
            'nama' => 'Sari Wulandari',
            'nim' => '198705112020',
            'nomor_hp' => '081298765432',
            'jenis_akun' => 'dosen',
        ]);

        Peminjam::create([
            'nama' => 'Andi Pratama',
            'nim' => '220101002',
            'nomor_hp' => '081111222333',
            'jenis_akun' => 'mahasiswa',
        ]);

        Ruang::create([
            'nama_ruang' => 'Lab Komputer A',
            'kapasitas' => 40,
            'gedung' => 'Gedung A',
            'lantai' => 2,
            'status_ketersediaan' => 'tersedia',
        ]);

        Ruang::create([
            'nama_ruang' => 'Aula Utama',
            'kapasitas' => 150,
            'gedung' => 'Gedung B',
            'lantai' => 1,
            'status_ketersediaan' => 'tersedia',
        ]);

        Ruang::create([
            'nama_ruang' => 'Ruang Rapat 301',
            'kapasitas' => 20,
            'gedung' => 'Gedung C',
            'lantai' => 3,
            'status_ketersediaan' => 'tidak_tersedia',
        ]);

        Peralatan::create([
            'kode' => 'PRJ001',
            'nama_peralatan' => 'Proyektor Epson',
            'stok' => 5,
            'kategori' => 'Proyektor',
        ]);

        Peralatan::create([
            'kode' => 'CAM001',
            'nama_peralatan' => 'Kamera Sony',
            'stok' => 3,
            'kategori' => 'Kamera',
        ]);

        Peralatan::create([
            'kode' => 'MIC001',
            'nama_peralatan' => 'Mic Wireless',
            'stok' => 4,
            'kategori' => 'Audio',
        ]);
    }
}
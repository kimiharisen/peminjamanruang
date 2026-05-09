<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Ruang;
use App\Models\Peralatan;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'jumlahPeminjam' => Peminjam::count(),
            'jumlahRuang' => Ruang::count(),
            'jumlahPeralatan' => Peralatan::count(),
            'jumlahPeminjaman' => Peminjaman::count(),
            'jumlahMenunggu' => Peminjaman::where('status', 'menunggu')->count(),
        ]);
    }
}
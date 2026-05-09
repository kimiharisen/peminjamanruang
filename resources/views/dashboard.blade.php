@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Dashboard</h3>
        <p class="text-muted mb-0">
            Ringkasan sistem peminjaman ruang dan peralatan.
        </p>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Peminjam</h6>
                <h3>{{ $jumlahPeminjam }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Ruang</h6>
                <h3>{{ $jumlahRuang }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Peralatan</h6>
                <h3>{{ $jumlahPeralatan }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="text-muted">Peminjaman</h6>
                <h3>{{ $jumlahPeminjaman }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h5>Informasi Sistem</h5>
        <p class="mb-2">
            Sistem ini digunakan untuk mengelola data peminjam, ruang, peralatan, dan catatan peminjaman.
        </p>

        <p class="mb-0">
            Jumlah pengajuan dengan status <strong>menunggu</strong>: 
            <span class="badge bg-warning text-dark">{{ $jumlahMenunggu }}</span>
        </p>
    </div>
</div>
@endsection
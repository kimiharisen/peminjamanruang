@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3>Detail Peralatan</h3>
        <p class="text-muted mb-0">Informasi peralatan dan riwayat penggunaannya.</p>
    </div>

    <a href="{{ route('peralatans.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">{{ $peralatan->nama_peralatan }}</h5>

        <table class="table table-bordered">
            <tr>
                <th style="width: 220px;">Kode</th>
                <td>{{ $peralatan->kode }}</td>
            </tr>
            <tr>
                <th>Stok</th>
                <td>{{ $peralatan->stok }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $peralatan->kategori }}</td>
            </tr>
        </table>

        <a href="{{ route('peralatans.edit', $peralatan) }}" class="btn btn-warning">
            Edit Peralatan
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Riwayat Peminjaman Peralatan</h5>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal Pakai</th>
                    <th>Peminjam</th>
                    <th>Ruang</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peralatan->peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->tanggal_pakai }}</td>
                        <td>{{ $peminjaman->peminjam->nama ?? '-' }}</td>
                        <td>{{ $peminjaman->ruang->nama_ruang ?? '-' }}</td>
                        <td>{{ $peminjaman->pivot->jumlah }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('peminjamans.show', $peminjaman) }}" class="btn btn-sm btn-info">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Belum ada riwayat peminjaman untuk peralatan ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
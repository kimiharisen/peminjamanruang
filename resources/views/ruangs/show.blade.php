@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3>Detail Ruang</h3>
        <p class="text-muted mb-0">Informasi ruang dan riwayat peminjaman.</p>
    </div>

    <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">{{ $ruang->nama_ruang }}</h5>

        <table class="table table-bordered">
            <tr>
                <th style="width: 220px;">Kapasitas</th>
                <td>{{ $ruang->kapasitas }} orang</td>
            </tr>
            <tr>
                <th>Gedung</th>
                <td>{{ $ruang->gedung }}</td>
            </tr>
            <tr>
                <th>Lantai</th>
                <td>{{ $ruang->lantai }}</td>
            </tr>
            <tr>
                <th>Status Ketersediaan</th>
                <td>
                    @if($ruang->status_ketersediaan === 'tersedia')
                        <span class="badge bg-success">Tersedia</span>
                    @else
                        <span class="badge bg-danger">Tidak Tersedia</span>
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('ruangs.edit', $ruang) }}" class="btn btn-warning">
            Edit Ruang
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Riwayat Peminjaman Ruang</h5>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal Pakai</th>
                    <th>Peminjam</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruang->peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->tanggal_pakai }}</td>
                        <td>{{ $peminjaman->peminjam->nama ?? '-' }}</td>
                        <td>{{ $peminjaman->durasi_jam }} jam</td>
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
                        <td colspan="5" class="text-center text-muted">
                            Belum ada riwayat peminjaman untuk ruang ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
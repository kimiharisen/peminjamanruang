@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3>Detail Peminjam</h3>
        <p class="text-muted mb-0">Informasi peminjam dan riwayat peminjaman.</p>
    </div>

    <a href="{{ route('peminjams.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">{{ $peminjam->nama }}</h5>

        <table class="table table-bordered">
            <tr>
                <th style="width: 220px;">NIM</th>
                <td>{{ $peminjam->nim }}</td>
            </tr>
            <tr>
                <th>Nomor HP</th>
                <td>{{ $peminjam->nomor_hp }}</td>
            </tr>
            <tr>
                <th>Jenis Akun</th>
                <td>{{ ucfirst($peminjam->jenis_akun) }}</td>
            </tr>
        </table>

        <div class="d-flex gap-2">
            <a href="{{ route('peminjams.edit', $peminjam) }}" class="btn btn-warning">
                Edit Peminjam
            </a>

            <a href="{{ route('peminjamans.create', ['peminjam_id' => $peminjam->id]) }}" class="btn btn-primary">
                + Buat Peminjaman Ruang dan Peralatan
            </a>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Riwayat Peminjaman</h5>

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Tanggal Pakai</th>
                    <th>Ruang</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th>Peralatan</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjam->peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $peminjaman->tanggal_pakai }}</td>
                        <td>{{ $peminjaman->ruang->nama_ruang ?? '-' }}</td>
                        <td>{{ $peminjaman->durasi_jam }} jam</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ ucfirst($peminjaman->status) }}
                            </span>
                        </td>
                        <td>
                            @forelse($peminjaman->peralatans as $peralatan)
                                <div>
                                    {{ $peralatan->nama_peralatan }}
                                    <span class="text-muted">
                                        ({{ $peralatan->pivot->jumlah }})
                                    </span>
                                </div>
                            @empty
                                <span class="text-muted">Tidak ada peralatan</span>
                            @endforelse
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
                            Belum ada riwayat peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
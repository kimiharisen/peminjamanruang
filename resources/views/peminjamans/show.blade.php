@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3>Detail Peminjaman</h3>
        <p class="text-muted mb-0">Detail catatan peminjaman ruang dan peralatan.</p>
    </div>

    <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">Informasi Peminjaman</h5>

        <table class="table table-bordered">
            <tr>
                <th style="width: 240px;">Peminjam</th>
                <td>{{ $peminjaman->peminjam->nama ?? '-' }}</td>
            </tr>
            <tr>
                <th>NIM</th>
                <td>{{ $peminjaman->peminjam->nim ?? '-' }}</td>
            </tr>
            <tr>
                <th>Ruang</th>
                <td>{{ $peminjaman->ruang->nama_ruang ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Pengajuan</th>
                <td>{{ $peminjaman->tanggal_pengajuan->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Tanggal Pakai</th>
                <td>{{ $peminjaman->tanggal_pakai->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Durasi</th>
                <td>{{ $peminjaman->durasi_jam }} jam</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge bg-secondary">
                        {{ ucfirst($peminjaman->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Waktu Pengembalian Aktual</th>
                <td>
                    {{ $peminjaman->waktu_pengembalian_aktual ? $peminjaman->waktu_pengembalian_aktual->format('d-m-Y H:i') : '-' }}
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{{ $peminjaman->keterangan }}</td>
            </tr>
        </table>

        <div class="d-flex gap-2">
            <a href="{{ route('peminjamans.edit', $peminjaman) }}" class="btn btn-warning">
                Edit Peminjaman
            </a>

            <a href="{{ route('peminjams.show', $peminjaman->peminjam) }}" class="btn btn-info">
                Lihat Peminjam
            </a>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="mb-3">Daftar Peralatan Dipinjam</h5>

        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama Peralatan</th>
                    <th>Kategori</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman->peralatans as $peralatan)
                    <tr>
                        <td>{{ $peralatan->kode }}</td>
                        <td>{{ $peralatan->nama_peralatan }}</td>
                        <td>{{ $peralatan->kategori }}</td>
                        <td>{{ $peralatan->pivot->jumlah }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            Tidak ada peralatan yang dipinjam.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if(auth()->user()->isAdmin())
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Update Status Peminjaman</h5>

            <form action="{{ route('peminjamans.updateStatus', $peminjaman) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="menunggu" {{ $peminjaman->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ $peminjaman->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ $peminjaman->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="selesai" {{ $peminjaman->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Waktu Pengembalian Aktual</label>
                    <input type="datetime-local" name="waktu_pengembalian_aktual" class="form-control"
                           value="{{ $peminjaman->waktu_pengembalian_aktual ? $peminjaman->waktu_pengembalian_aktual->format('Y-m-d\TH:i') : '' }}">
                    <small class="text-muted">
                        Wajib diisi jika status diubah menjadi selesai.
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    Update Status
                </button>
            </form>
        </div>
    </div>
@endif
@endsection
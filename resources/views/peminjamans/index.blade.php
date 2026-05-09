@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-1">Data Peminjaman</h3>
        <p class="text-muted mb-0">Kelola catatan peminjaman ruang dan peralatan.</p>
    </div>

    <a href="{{ route('peminjamans.create') }}" class="btn btn-primary">
        + Tambah Peminjaman
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Peminjam</th>
                    <th>Ruang</th>
                    <th>Tanggal Pakai</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $peminjaman)
                    <tr>
                        <td>{{ $loop->iteration + ($peminjamans->currentPage() - 1) * $peminjamans->perPage() }}</td>
                        <td>{{ $peminjaman->peminjam->nama ?? '-' }}</td>
                        <td>{{ $peminjaman->ruang->nama_ruang ?? '-' }}</td>
                        <td>{{ $peminjaman->tanggal_pakai->format('d-m-Y') }}</td>
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

                            <a href="{{ route('peminjamans.edit', $peminjaman) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('peminjamans.destroy', $peminjaman) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data peminjaman ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $peminjamans->links() }}
    </div>
</div>
@endsection
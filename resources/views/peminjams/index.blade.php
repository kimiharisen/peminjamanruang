@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-1">Data Peminjam</h3>
        <p class="text-muted mb-0">Kelola data mahasiswa atau dosen yang melakukan peminjaman.</p>
    </div>

    <a href="{{ route('peminjams.create') }}" class="btn btn-primary">
        + Tambah Peminjam
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Nomor HP</th>
                    <th>Jenis Akun</th>
                    <th style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjams as $peminjam)
                    <tr>
                        <td>{{ $loop->iteration + ($peminjams->currentPage() - 1) * $peminjams->perPage() }}</td>
                        <td>{{ $peminjam->nama }}</td>
                        <td>{{ $peminjam->nim }}</td>
                        <td>{{ $peminjam->nomor_hp }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ ucfirst($peminjam->jenis_akun) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('peminjams.show', $peminjam) }}" class="btn btn-sm btn-info">
                                Detail
                            </a>

                            <a href="{{ route('peminjams.edit', $peminjam) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('peminjams.destroy', $peminjam) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data peminjam ini?')">
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
                        <td colspan="6" class="text-center text-muted">
                            Belum ada data peminjam.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $peminjams->links() }}
    </div>
</div>
@endsection
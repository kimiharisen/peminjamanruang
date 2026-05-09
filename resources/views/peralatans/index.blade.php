@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-1">Data Peralatan</h3>
        <p class="text-muted mb-0">Kelola data peralatan pendukung kegiatan.</p>
    </div>

    <a href="{{ route('peralatans.create') }}" class="btn btn-primary">
        + Tambah Peralatan
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Kode</th>
                    <th>Nama Peralatan</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peralatans as $peralatan)
                    <tr>
                        <td>{{ $loop->iteration + ($peralatans->currentPage() - 1) * $peralatans->perPage() }}</td>
                        <td>{{ $peralatan->kode }}</td>
                        <td>{{ $peralatan->nama_peralatan }}</td>
                        <td>{{ $peralatan->stok }}</td>
                        <td>{{ $peralatan->kategori }}</td>
                        <td>
                            <a href="{{ route('peralatans.show', $peralatan) }}" class="btn btn-sm btn-info">
                                Detail
                            </a>

                            <a href="{{ route('peralatans.edit', $peralatan) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('peralatans.destroy', $peralatan) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data peralatan ini?')">
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
                            Belum ada data peralatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $peralatans->links() }}
    </div>
</div>
@endsection
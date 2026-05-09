@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h3 class="mb-1">Data Ruang</h3>
        <p class="text-muted mb-0">Kelola data ruang kelas, laboratorium, aula, dan ruang lainnya.</p>
    </div>

    <a href="{{ route('ruangs.create') }}" class="btn btn-primary">
        + Tambah Ruang
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Ruang</th>
                    <th>Kapasitas</th>
                    <th>Gedung</th>
                    <th>Lantai</th>
                    <th>Status</th>
                    <th style="width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruangs as $ruang)
                    <tr>
                        <td>{{ $loop->iteration + ($ruangs->currentPage() - 1) * $ruangs->perPage() }}</td>
                        <td>{{ $ruang->nama_ruang }}</td>
                        <td>{{ $ruang->kapasitas }} orang</td>
                        <td>{{ $ruang->gedung }}</td>
                        <td>{{ $ruang->lantai }}</td>
                        <td>
                            @if($ruang->status_ketersediaan === 'tersedia')
                                <span class="badge bg-success">Tersedia</span>
                            @else
                                <span class="badge bg-danger">Tidak Tersedia</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('ruangs.show', $ruang) }}" class="btn btn-sm btn-info">
                                Detail
                            </a>

                            <a href="{{ route('ruangs.edit', $ruang) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <form action="{{ route('ruangs.destroy', $ruang) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ruang ini?')">
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
                            Belum ada data ruang.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $ruangs->links() }}
    </div>
</div>
@endsection
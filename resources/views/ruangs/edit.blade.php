@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Edit Ruang</h3>
    <p class="text-muted">Perbarui data ruang.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('ruangs.update', $ruang) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Ruang</label>
                <input type="text" name="nama_ruang" class="form-control"
                       value="{{ old('nama_ruang', $ruang->nama_ruang) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control"
                       value="{{ old('kapasitas', $ruang->kapasitas) }}" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gedung</label>
                <input type="text" name="gedung" class="form-control"
                       value="{{ old('gedung', $ruang->gedung) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <input type="number" name="lantai" class="form-control"
                       value="{{ old('lantai', $ruang->lantai) }}" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status Ketersediaan</label>
                <select name="status_ketersediaan" class="form-select" required>
                    <option value="tersedia" {{ old('status_ketersediaan', $ruang->status_ketersediaan) == 'tersedia' ? 'selected' : '' }}>
                        Tersedia
                    </option>
                    <option value="tidak_tersedia" {{ old('status_ketersediaan', $ruang->status_ketersediaan) == 'tidak_tersedia' ? 'selected' : '' }}>
                        Tidak Tersedia
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Tambah Ruang</h3>
    <p class="text-muted">Masukkan data ruang baru.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('ruangs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Ruang</label>
                <input type="text" name="nama_ruang" class="form-control" value="{{ old('nama_ruang') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kapasitas</label>
                <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas') }}" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gedung</label>
                <input type="text" name="gedung" class="form-control" value="{{ old('gedung') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <input type="number" name="lantai" class="form-control" value="{{ old('lantai') }}" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status Ketersediaan</label>
                <select name="status_ketersediaan" class="form-select" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="tersedia" {{ old('status_ketersediaan') == 'tersedia' ? 'selected' : '' }}>
                        Tersedia
                    </option>
                    <option value="tidak_tersedia" {{ old('status_ketersediaan') == 'tidak_tersedia' ? 'selected' : '' }}>
                        Tidak Tersedia
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
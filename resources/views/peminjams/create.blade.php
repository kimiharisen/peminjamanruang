@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Tambah Peminjam</h3>
    <p class="text-muted">Masukkan data peminjam baru.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjams.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Peminjam</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ old('nim') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control" value="{{ old('nomor_hp') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Akun</label>
                <select name="jenis_akun" class="form-select" required>
                    <option value="">-- Pilih Jenis Akun --</option>
                    <option value="mahasiswa" {{ old('jenis_akun') == 'mahasiswa' ? 'selected' : '' }}>
                        Mahasiswa
                    </option>
                    <option value="dosen" {{ old('jenis_akun') == 'dosen' ? 'selected' : '' }}>
                        Dosen
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('peminjams.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
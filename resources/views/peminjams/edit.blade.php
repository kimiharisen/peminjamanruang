@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Edit Peminjam</h3>
    <p class="text-muted">Perbarui data peminjam.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjams.update', $peminjam) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Peminjam</label>
                <input type="text" name="nama" class="form-control"
                       value="{{ old('nama', $peminjam->nama) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">NIM</label>
                <input type="text" name="nim" class="form-control"
                       value="{{ old('nim', $peminjam->nim) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor HP</label>
                <input type="text" name="nomor_hp" class="form-control"
                       value="{{ old('nomor_hp', $peminjam->nomor_hp) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Akun</label>
                <select name="jenis_akun" class="form-select" required>
                    <option value="mahasiswa" {{ old('jenis_akun', $peminjam->jenis_akun) == 'mahasiswa' ? 'selected' : '' }}>
                        Mahasiswa
                    </option>
                    <option value="dosen" {{ old('jenis_akun', $peminjam->jenis_akun) == 'dosen' ? 'selected' : '' }}>
                        Dosen
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('peminjams.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
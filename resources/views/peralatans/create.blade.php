@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Tambah Peralatan</h3>
    <p class="text-muted">Masukkan data peralatan baru.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peralatans.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Peralatan</label>
                <input type="text" name="kode" class="form-control" value="{{ old('kode') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Peralatan</label>
                <input type="text" name="nama_peralatan" class="form-control" value="{{ old('nama_peralatan') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="{{ old('stok') }}" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('peralatans.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
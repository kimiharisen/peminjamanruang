@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Edit Peralatan</h3>
    <p class="text-muted">Perbarui data peralatan.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peralatans.update', $peralatan) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Peralatan</label>
                <input type="text" name="kode" class="form-control"
                       value="{{ old('kode', $peralatan->kode) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Peralatan</label>
                <input type="text" name="nama_peralatan" class="form-control"
                       value="{{ old('nama_peralatan', $peralatan->nama_peralatan) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control"
                       value="{{ old('stok', $peralatan->stok) }}" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control"
                       value="{{ old('kategori', $peralatan->kategori) }}" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('peralatans.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="mb-3">
    <h3>Tambah Peminjaman</h3>
    <p class="text-muted">Buat catatan peminjaman ruang dan peralatan.</p>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('peminjamans.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Peminjam</label>
                <select name="peminjam_id" class="form-select" required>
                    <option value="">-- Pilih Peminjam --</option>
                    @foreach($peminjams as $peminjam)
                        <option value="{{ $peminjam->id }}"
                            {{ old('peminjam_id', $selectedPeminjamId) == $peminjam->id ? 'selected' : '' }}>
                            {{ $peminjam->nama }} - {{ $peminjam->nim }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Ruang</label>
                <select name="ruang_id" class="form-select" required>
                    <option value="">-- Pilih Ruang --</option>
                    @foreach($ruangs as $ruang)
                        <option value="{{ $ruang->id }}" {{ old('ruang_id') == $ruang->id ? 'selected' : '' }}>
                            {{ $ruang->nama_ruang }} - {{ $ruang->gedung }} Lt. {{ $ruang->lantai }}
                            ({{ $ruang->status_ketersediaan }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pakai</label>
                <input type="date" name="tanggal_pakai" class="form-control"
                       value="{{ old('tanggal_pakai') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Durasi Jam</label>
                <input type="number" name="durasi_jam" class="form-control"
                       value="{{ old('durasi_jam') }}" min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan Keperluan</label>
                <textarea name="keterangan" class="form-control" rows="3" required>{{ old('keterangan') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Peralatan yang Dipinjam</label>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 60px;">Pilih</th>
                                <th>Kode</th>
                                <th>Nama Peralatan</th>
                                <th>Stok</th>
                                <th>Kategori</th>
                                <th style="width: 160px;">Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peralatans as $peralatan)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="peralatan_ids[]"
                                               value="{{ $peralatan->id }}"
                                               {{ in_array($peralatan->id, old('peralatan_ids', [])) ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $peralatan->kode }}</td>
                                    <td>{{ $peralatan->nama_peralatan }}</td>
                                    <td>{{ $peralatan->stok }}</td>
                                    <td>{{ $peralatan->kategori }}</td>
                                    <td>
                                        <input type="number"
                                               name="jumlah[{{ $peralatan->id }}]"
                                               class="form-control"
                                               value="{{ old('jumlah.' . $peralatan->id, 0) }}"
                                               min="0">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <small class="text-muted">
                    Centang peralatan yang ingin dipinjam, lalu isi jumlahnya.
                </small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
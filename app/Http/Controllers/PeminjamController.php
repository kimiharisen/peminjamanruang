<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use Illuminate\Http\Request;

class PeminjamController extends Controller
{
    public function index()
    {
        $peminjams = Peminjam::latest()->paginate(10);

        return view('peminjams.index', compact('peminjams'));
    }

    public function create()
    {
        return view('peminjams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50', 'unique:peminjams,nim'],
            'nomor_hp' => ['required', 'string', 'max:20'],
            'jenis_akun' => ['required', 'in:mahasiswa,dosen'],
        ]);

        Peminjam::create($validated);

        return redirect()
            ->route('peminjams.index')
            ->with('success', 'Data peminjam berhasil ditambahkan.');
    }

    public function show(Peminjam $peminjam)
    {
        $peminjam->load(['peminjamans.ruang', 'peminjamans.peralatans']);

        return view('peminjams.show', compact('peminjam'));
    }

    public function edit(Peminjam $peminjam)
    {
        return view('peminjams.edit', compact('peminjam'));
    }

    public function update(Request $request, Peminjam $peminjam)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:50', 'unique:peminjams,nim,' . $peminjam->id],
            'nomor_hp' => ['required', 'string', 'max:20'],
            'jenis_akun' => ['required', 'in:mahasiswa,dosen'],
        ]);

        $peminjam->update($validated);

        return redirect()
            ->route('peminjams.index')
            ->with('success', 'Data peminjam berhasil diperbarui.');
    }

    public function destroy(Peminjam $peminjam)
    {
        $peminjam->delete();

        return redirect()
            ->route('peminjams.index')
            ->with('success', 'Data peminjam berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Peralatan;
use Illuminate\Http\Request;

class PeralatanController extends Controller
{
    public function index()
    {
        $peralatans = Peralatan::latest()->paginate(10);

        return view('peralatans.index', compact('peralatans'));
    }

    public function create()
    {
        return view('peralatans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:peralatans,kode'],
            'nama_peralatan' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'kategori' => ['required', 'string', 'max:255'],
        ]);

        Peralatan::create($validated);

        return redirect()
            ->route('peralatans.index')
            ->with('success', 'Data peralatan berhasil ditambahkan.');
    }

    public function show(Peralatan $peralatan)
    {
        $peralatan->load(['peminjamans.peminjam', 'peminjamans.ruang']);

        return view('peralatans.show', compact('peralatan'));
    }

    public function edit(Peralatan $peralatan)
    {
        return view('peralatans.edit', compact('peralatan'));
    }

    public function update(Request $request, Peralatan $peralatan)
    {
        $validated = $request->validate([
            'kode' => ['required', 'string', 'max:50', 'unique:peralatans,kode,' . $peralatan->id],
            'nama_peralatan' => ['required', 'string', 'max:255'],
            'stok' => ['required', 'integer', 'min:0'],
            'kategori' => ['required', 'string', 'max:255'],
        ]);

        $peralatan->update($validated);

        return redirect()
            ->route('peralatans.index')
            ->with('success', 'Data peralatan berhasil diperbarui.');
    }

    public function destroy(Peralatan $peralatan)
    {
        if ($peralatan->peminjamans()->exists()) {
            return redirect()
                ->route('peralatans.index')
                ->with('error', 'Peralatan tidak dapat dihapus karena sudah digunakan pada data peminjaman.');
        }

        $peralatan->delete();

        return redirect()
            ->route('peralatans.index')
            ->with('success', 'Data peralatan berhasil dihapus.');
    }
}
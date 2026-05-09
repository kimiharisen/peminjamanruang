<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = Ruang::latest()->paginate(10);

        return view('ruangs.index', compact('ruangs'));
    }

    public function create()
    {
        return view('ruangs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruang' => ['required', 'string', 'max:255'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'gedung' => ['required', 'string', 'max:255'],
            'lantai' => ['required', 'integer', 'min:1'],
            'status_ketersediaan' => ['required', 'in:tersedia,tidak_tersedia'],
        ]);

        Ruang::create($validated);

        return redirect()
            ->route('ruangs.index')
            ->with('success', 'Data ruang berhasil ditambahkan.');
    }

    public function show(Ruang $ruang)
    {
        $ruang->load(['peminjamans.peminjam']);

        return view('ruangs.show', compact('ruang'));
    }

    public function edit(Ruang $ruang)
    {
        return view('ruangs.edit', compact('ruang'));
    }

    public function update(Request $request, Ruang $ruang)
    {
        $validated = $request->validate([
            'nama_ruang' => ['required', 'string', 'max:255'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'gedung' => ['required', 'string', 'max:255'],
            'lantai' => ['required', 'integer', 'min:1'],
            'status_ketersediaan' => ['required', 'in:tersedia,tidak_tersedia'],
        ]);

        $ruang->update($validated);

        return redirect()
            ->route('ruangs.index')
            ->with('success', 'Data ruang berhasil diperbarui.');
    }

    public function destroy(Ruang $ruang)
    {
        if ($ruang->peminjamans()->exists()) {
            return redirect()
                ->route('ruangs.index')
                ->with('error', 'Ruang tidak dapat dihapus karena sudah digunakan pada data peminjaman.');
        }

        $ruang->delete();

        return redirect()
            ->route('ruangs.index')
            ->with('success', 'Data ruang berhasil dihapus.');
    }
}
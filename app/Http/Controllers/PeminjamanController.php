<?php

namespace App\Http\Controllers;

use App\Models\Peminjam;
use App\Models\Peminjaman;
use App\Models\Peralatan;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['peminjam', 'ruang', 'peralatans'])
            ->latest()
            ->paginate(10);

        return view('peminjamans.index', compact('peminjamans'));
    }

    public function create(Request $request)
    {
        return view('peminjamans.create', [
            'peminjams' => Peminjam::orderBy('nama')->get(),
            'ruangs' => Ruang::orderBy('nama_ruang')->get(),
            'peralatans' => Peralatan::orderBy('nama_peralatan')->get(),
            'selectedPeminjamId' => $request->query('peminjam_id'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePeminjamanRequest($request);
        $syncData = $this->validateAndPreparePeralatan($request);

        DB::transaction(function () use ($validated, $syncData) {
            $peminjaman = Peminjaman::create([
                'peminjam_id' => $validated['peminjam_id'],
                'ruang_id' => $validated['ruang_id'],
                'tanggal_pengajuan' => now()->toDateString(),
                'tanggal_pakai' => $validated['tanggal_pakai'],
                'durasi_jam' => $validated['durasi_jam'],
                'status' => 'menunggu',
                'waktu_pengembalian_aktual' => null,
                'keterangan' => $validated['keterangan'],
            ]);

            $peminjaman->peralatans()->attach($syncData);
        });

        return redirect()
            ->route('peminjamans.index')
            ->with('success', 'Data peminjaman berhasil dibuat.');
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['peminjam', 'ruang', 'peralatans']);

        return view('peminjamans.show', compact('peminjaman'));
    }

    public function edit(Peminjaman $peminjaman)
    {
        $peminjaman->load('peralatans');

        return view('peminjamans.edit', [
            'peminjaman' => $peminjaman,
            'peminjams' => Peminjam::orderBy('nama')->get(),
            'ruangs' => Ruang::orderBy('nama_ruang')->get(),
            'peralatans' => Peralatan::orderBy('nama_peralatan')->get(),
        ]);
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $validated = $this->validatePeminjamanRequest($request);
        $syncData = $this->validateAndPreparePeralatan($request);

        DB::transaction(function () use ($peminjaman, $validated, $syncData) {
            $peminjaman->update([
                'peminjam_id' => $validated['peminjam_id'],
                'ruang_id' => $validated['ruang_id'],
                'tanggal_pakai' => $validated['tanggal_pakai'],
                'durasi_jam' => $validated['durasi_jam'],
                'keterangan' => $validated['keterangan'],
            ]);

            $peminjaman->peralatans()->sync($syncData);
        });

        return redirect()
            ->route('peminjamans.show', $peminjaman)
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()
            ->route('peminjamans.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }

    public function updateStatus(Request $request, Peminjaman $peminjaman)
    {
        /** @var \App\Models\User|null $user */
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Hanya admin yang dapat mengubah status peminjaman.');
        }

        $validated = $request->validate([
            'status' => ['required', 'in:menunggu,disetujui,ditolak,selesai'],
            'waktu_pengembalian_aktual' => ['required_if:status,selesai', 'nullable', 'date'],
        ]);

        if ($validated['status'] === 'selesai' && !empty($validated['waktu_pengembalian_aktual'])) {
            $validated['waktu_pengembalian_aktual'] = Carbon::parse($validated['waktu_pengembalian_aktual'])
                ->format('Y-m-d H:i:s');
        }

        if ($validated['status'] !== 'selesai') {
            $validated['waktu_pengembalian_aktual'] = null;
        }

        $peminjaman->update($validated);

        return redirect()
            ->route('peminjamans.show', $peminjaman)
            ->with('success', 'Status peminjaman berhasil diperbarui.');
    }

    private function validatePeminjamanRequest(Request $request): array
    {
        $validated = $request->validate([
            'peminjam_id' => ['required', 'exists:peminjams,id'],
            'ruang_id' => ['required', 'exists:ruangs,id'],
            'tanggal_pakai' => ['required', 'date'],
            'durasi_jam' => ['required', 'integer', 'min:1'],
            'keterangan' => ['required', 'string', 'max:1000'],
            'peralatan_ids' => ['required', 'array', 'min:1'],
            'peralatan_ids.*' => ['exists:peralatans,id'],
            'jumlah' => ['required', 'array'],
        ]);

        $ruang = Ruang::findOrFail($validated['ruang_id']);

        if (!$ruang->isAvailable()) {
            throw ValidationException::withMessages([
                'ruang_id' => 'Ruang yang dipilih sedang tidak tersedia.',
            ]);
        }

        return $validated;
    }

    private function validateAndPreparePeralatan(Request $request): array
    {
        $peralatanIds = $request->input('peralatan_ids', []);
        $syncData = [];

        foreach ($peralatanIds as $peralatanId) {
            $peralatan = Peralatan::findOrFail($peralatanId);
            $jumlah = (int) $request->input("jumlah.$peralatanId", 0);

            if ($jumlah < 1) {
                throw ValidationException::withMessages([
                    'jumlah' => 'Jumlah peralatan yang dipinjam minimal 1.',
                ]);
            }

            if (!$peralatan->hasEnoughStock($jumlah)) {
                throw ValidationException::withMessages([
                    'jumlah' => "Jumlah {$peralatan->nama_peralatan} yang dipinjam melebihi stok tersedia.",
                ]);
            }

            $syncData[$peralatanId] = [
                'jumlah' => $jumlah,
            ];
        }

        return $syncData;
    }
}
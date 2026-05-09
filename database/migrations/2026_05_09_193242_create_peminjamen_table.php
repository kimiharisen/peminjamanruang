<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('peminjam_id')
                ->constrained('peminjams')
                ->cascadeOnDelete();

            $table->foreignId('ruang_id')
                ->constrained('ruangs')
                ->restrictOnDelete();

            $table->date('tanggal_pengajuan');
            $table->date('tanggal_pakai');
            $table->integer('durasi_jam');

            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'selesai'])
                ->default('menunggu');

            $table->dateTime('waktu_pengembalian_aktual')->nullable();
            $table->text('keterangan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};

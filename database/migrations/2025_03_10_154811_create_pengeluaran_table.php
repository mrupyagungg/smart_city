<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengeluaran')->unique();
            $table->date('tanggal');
            $table->unsignedBigInteger('akun_id');
            $table->string('deskripsi');
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();

            // Foreign Key ke tabel akun
            $table->foreign('akun_id')->references('id')->on('akun')->onDelete('cascade');
        });
    }

    /**
     * Undo migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};
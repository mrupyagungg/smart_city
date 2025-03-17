<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateSaldoAwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saldo_awal', function (Blueprint $table) {
            $table->id();
            $table->string('kode_saldo', 20)->unique();
            $table->date('tanggal');
            $table->foreignId('akun_id')->constrained('akun')->onDelete('cascade');
            $table->text('deskripsi')->nullable();
            $table->decimal('jumlah', 15, 2);
            $table->enum('posisi_db_cr', ['debit', 'kredit']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saldo_awal');
    }
}
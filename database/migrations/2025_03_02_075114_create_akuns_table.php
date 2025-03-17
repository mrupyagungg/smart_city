<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akun', function (Blueprint $table) {
            $table->id(); // Primary key (id auto increment)
                $table->string('kode_akun', 10)->unique();
                $table->string('nama_akun', 100);
                $table->string('header_akun', 100);
                $table->string('db_cr', 100);
                $table->timestamps(); // created_at & updated_at
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akun');
    }
}
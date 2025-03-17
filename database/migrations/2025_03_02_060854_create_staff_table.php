<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id(); // Primary key (id auto increment)
            $table->string('kode_staff', 10)->unique();
            $table->string('nama_staff', 100);
            $table->string('jenis_kelamin', 100);
            $table->string('alamat', 100);
            $table->string('no_telepon', 50);
            $table->string('email_staff', 100);
            $table->string('kategori_staff', 50);
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
        Schema::dropIfExists('staff');
    }
}
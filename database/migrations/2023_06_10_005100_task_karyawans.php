<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tugas');
            $table->string('deskripsi');
            $table->date('tanggal');
            $table->string('gambar');
            $table->string('status')->default('Tidak Selesai');
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
        Schema::dropIfExists('task_karyawans');
    }
};

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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->date('tanggal');
            $table->string('status');
            $table->integer('kode');
            $table->integer('jumlah_harga');
            $table->string('gambar')->default('');
            $table->integer('produk_id');
            $table->integer('ongkir_id')->nullable();
            $table->integer('jumlah_pesan');
            $table->string('img')->default('');
            $table->string('nama_pengirim')->default('');
            $table->string('tlpn')->default('');
            $table->string('angkutan')->default('');
            $table->string('jenis')->default('');
            $table->string('plat')->default('');
            $table->string('kurir')->default('');
            $table->string('resi')->default('');
            $table->text('review')->default('');
            $table->string('img2')->default('');
            $table->string('video')->default('');
            $table->boolean('read')->default(false);
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
        Schema::dropIfExists('pesanans');
    }
};

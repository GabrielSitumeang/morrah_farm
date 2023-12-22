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
        Schema::create('production_reports', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk'); 
            $table->date('tanggal'); 
            $table->string('jumlah');
            $table->string('nama_pelapor');
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
        Schema::dropIfExists('production_reports');
    }
};

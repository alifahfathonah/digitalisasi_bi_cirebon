<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanDinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan_dinas', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_pengemudi')->nullable() ;
            $table->string('no_kendaraan')->nullable();
            $table->string('penumpang')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('penugasan')->nullable();
            $table->boolean('menginap')->nullable();
            $table->integer('lama_menginap')->nullable();
            $table->enum('pembayaran',['Ya','Tidak'])->nullable();
            $table->string('kilometer')->nullable();
            $table->string('gambar_kilometer')->nullable();
            $table->string('bbm')->nullable();
            $table->enum('type',['Masuk','Keluar'])->nullable();
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
        Schema::dropIfExists('kendaraan_dinas');
    }
}

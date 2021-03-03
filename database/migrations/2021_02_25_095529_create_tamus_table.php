<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id') ;
            $table->string('data_tamu_id')->nullable();
            $table->string('nik')->nullable();
            $table->string('keperluan')->nullable();
            $table->string('tujuan')->nullable() ;
            $table->string('keterangan')->nullable() ;
            $table->dateTime('waktu_masuk')->nullable() ;
            $table->dateTime('waktu_keluar')->nullable() ;
            $table->string('status')->nullable() ;
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
        Schema::dropIfExists('tamus');
    }
}

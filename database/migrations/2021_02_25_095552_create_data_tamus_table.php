<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tamus', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable() ;
            $table->string('nik')->nullable();
            $table->string('nama_tamu')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->text('alamat')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('data_tamus');
    }
}

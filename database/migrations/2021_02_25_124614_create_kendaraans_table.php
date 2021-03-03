<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
          $table->id();
          $table->integer('user_id') ;
          $table->string('merk')->nullable();
          $table->string('type')->nullable();
          $table->string('no_pol')->nullable();
          $table->string('tahun')->nullable();
          $table->string('jumlah_seat')->nullable();
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
        Schema::dropIfExists('kendaraans');
    }
}

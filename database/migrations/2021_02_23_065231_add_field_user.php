<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('name')->nullable();
            $table->string('nik')->after('name')->nullable();
            $table->integer('department_id')->after('email')->nullable();
            $table->text('alamat')->after('email')->nullable();
            $table->string('no_telp')->after('email')->nullable();
            $table->string('templat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('photo')->nullable();
            $table->string('jabatan_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

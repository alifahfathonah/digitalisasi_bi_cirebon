<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KendaraanDinas extends Model
{
    protected $fillable = [
          'user_id','nama_pengemudi','no_kendaraan','penumpang','tujuan',
          'penugasan','menginap','lama_menginap','pembayaran','kilometer',
          'gambar_kilometer','bbm','type'
    ] ;
}

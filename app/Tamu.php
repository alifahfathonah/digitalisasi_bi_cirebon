<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $fillable = ['data_tamu_id', 'nik', 'keperluan', 'tujuan','keterangan','waktu_masuk','waktu_keluar','status'] ;

    public function DataTamu(){
      return $this->belongsTo(DataTamu::class);
    }
}

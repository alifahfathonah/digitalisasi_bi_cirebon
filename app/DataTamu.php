<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataTamu extends Model
{
    use SoftDeletes ;

    protected $fillable = ['nik', 'nama_tamu', 'no_telp', 'email', 'alamat', 'photo'] ;
    
    function Tamu()
    {
        return $this->hasMany(Tamu::class);
    }
}

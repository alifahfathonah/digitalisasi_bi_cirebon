<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use SoftDeletes ;

    protected $fillable = ['user_id','merk','type','no_pol','tahun','jumlah_seat','photo'];

}

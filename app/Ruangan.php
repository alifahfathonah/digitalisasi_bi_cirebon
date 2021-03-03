<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ruangan extends Model
{
    use SoftDeletes ;
    protected $fillable = ['user_id', 'nama_ruangan', 'kapasistas', 'photo'];
}

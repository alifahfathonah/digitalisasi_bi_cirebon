<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes ;

    protected $fillable = ['user_id', 'nama_department', 'kode_department', 'leader', 'status'] ;
}

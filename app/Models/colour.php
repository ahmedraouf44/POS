<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class colour extends Model
{
    //
    protected $table = 'colour';
    public $timestamps = false;
    protected $fillable = ['name','id'];
}

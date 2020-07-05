<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carpet_colour extends Model
{
    protected $table = 'carpet_colour';
    public $timestamps = false;

    public function carpets(){
        return $this->hasMany(carpets::class,'id','carpet_id');

    }
    public function colours(){
        return $this->hasMany(colour::class);
    }
    //
}

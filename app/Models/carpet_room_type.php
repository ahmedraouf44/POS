<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carpet_room_type extends Model
{
    //
    protected $table = 'carpet_room_type';
    public $timestamps = false;

    public function carpets(){
        return $this->hasMany(carpets::class,'id','carpet_id');

    }
    public function room_types(){
        return $this->hasMany(room_type::class,'id','room_type_id');

    }
}

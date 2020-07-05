<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carpets extends Model
{
    //
    protected $table = 'carpets';
    public $timestamps = false;

    public function images(){
        return $this->hasMany(Image::class,'carpet_id','id');

    }
      public function sub_category(){
        return $this->hasOne(sub_category::class,'id','id');

    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class main_category extends Model
{
    //
    protected $table = 'main_category';
    public $timestamps = false;

      public function sub_category(){
        return $this->hasMany(sub_category::class);

    }
}

<?php

namespace App\Models;


//use carpets;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = 'stock';

    public $timestamps = false;

    public function branch(){

        return $this->belongsTo('App\Models\Branches','branch_id', 'id');
    }


//       public function governs(){
//        return $this->hasOne(Governs::class);
//
//        }
    public function products()
    {
        return $this->hasOne(carpets::class,'id','product_id');


    }
}

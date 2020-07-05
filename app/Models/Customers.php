<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    protected $table = 'customers';

    public function branch()
    {
        return $this->belongsTo(Branches::class,'branch_number','branch_number');

    }
    public function type()
    {
        return $this->belongsTo(TypeMaster::class,'customer_type','type_master_id');

    }


//    public function stock()
//    {
//        return $this->hasMany(Stock::class,'branch_id','id');
//
//    }

}

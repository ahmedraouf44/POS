<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    //
    protected $table = 'order_details';

    public function branch()
    {
        return $this->hasOne(Branches::class,'branch_number','branch_number');

    }
    public function order()
    {
        return $this->hasMany(OrderMaster::class,'order_number','order_number');

    }
    public function itemmaster()
    {
        return $this->hasOne(ItemMaster::class,'item_code','item_code');

    }
    // public function orderMasterRelation()
    // {
    //     return $this->morphTo('order_number');
    // }

}

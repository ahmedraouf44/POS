<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    //
    protected $table = 'order_master';
    protected $fillable = ['total_amount'];
    public function branch()
    {
        return $this->hasOne(Branches::class,'branch_number','branch_number');

    }
    public function customer()
    {
        return $this->hasOne(Customers::class,'customer_number','customer_number');

    }
    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'order_number','order_number');
    }
    public function check()
    {
        return $this->hasOne(check::class,'id','check_id');

    }

}

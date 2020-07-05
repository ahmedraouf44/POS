<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    //
    protected $table = 'branches';
    protected $primaryKey='branch_id';
    public function stock()
    {
        return $this->hasMany(ItemStock::class,'branch_number','branch_number');

    }
    public function customers()
    {
        return $this->hasMany(Customers::class,'branch_number','branch_number');

    }



}

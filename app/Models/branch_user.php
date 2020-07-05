<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class branch_user extends Model
{



    protected $table = 'branch_user';

    public function stock()
    {
        return $this->hasMany(ItemStock::class,'branch_number','branch_id')->where('item_quantity','>','0');

    }
    public function branch()
    {
        return $this->belongsTo(Branches::class,'branch_id','branch_number');
    }


}

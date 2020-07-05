<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStock extends Model
{
    //
    protected $table = 'item_stock';
    protected $primaryKey = 'item_stock_id';

    public function branch()
    {
        return $this->hasOne(Branches::class,'branch_number','branch_number');

    }
    public function master()
    {
        return $this->belongsTo(ItemMaster::class,'item_code','item_code');

    }
    public function price()
    {
        return $this->hasOne(PriceList::class,'ref_code','ref_code');

    }


}

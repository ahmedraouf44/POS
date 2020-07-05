<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockDocDetails extends Model
{
    //
    protected $table = 'stock_doc_details';

    public function branch()
    {
        return $this->hasOne(Branches::class,'branch_number','branch_number');

    }
    public function stock()
    {
        return $this->hasOne(Stock::class,'stock_doc_id','stock_doc_id');

    }

    public function itemMaster()
    {
        return $this->belongsTo(ItemMaster::class,'item_code','item_code');

    }

}

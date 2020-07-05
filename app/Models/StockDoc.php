<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockDoc extends Model
{
    //
    protected $table = 'stock_doc';

    public function branch()
    {
        return $this->hasOne(Branches::class,'branch_number','branch_number');

    }
    public function branchfrom()
    {
        return $this->hasOne(Branches::class,'branch_number','stock_branch_from');

    }
    public function branchto()
    {
        return $this->hasOne(Branches::class,'branch_number','stock_branch_to');

    }
    public function details()
    {
        return $this->hasMany(StockDocDetails::class,'stock_id','id');

    }

}

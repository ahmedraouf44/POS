<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferStock extends Model
{
    //
    protected $table = 'transfer_stock';

//    public $timestamps = false;

    public function package()
    {
        return $this->hasOne(Packages::class,'id','package_id');

    }

    public function from_branch()
    {
        return $this->hasOne(Branches::class,'id','from');

    }

    public function to_branch()
    {
        return $this->hasOne(Branches::class,'id','to');

    }


}

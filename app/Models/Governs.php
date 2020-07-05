<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Branches;

class Governs extends Model
{
    //
    protected $table = 'governs';

    public function branches(){
        return $this->hasOne(branches::class,'govern_id','id');
    }

}


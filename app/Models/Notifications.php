<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    //
    protected $table = 'notifications';
    protected $primaryKey='notifications_id';
    public function branch()
    {
        return $this->hasMany(Branches::class,'branch_number','branch_number');

    }

}

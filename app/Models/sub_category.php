<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sub_category extends Model
{
    //
    protected $table = 'sub_category';
    public $timestamps = false;


    protected $fillable = ['name','main_category_id'];
    public function main_category(){

        return $this->belongsTo('App\Models\main_category','main_category_id', 'id');
    }

}

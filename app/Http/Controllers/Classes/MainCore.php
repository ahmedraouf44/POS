<?php
/**
 * Created by PhpStorm.
 * User: khaled nabawy
 * Date: 3/2/2020
 * Time: 11:46 PM
 */

namespace App\Http\Controllers\Classes;


use App\Models\branch_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class MainCore
{
    private static $_instance = null;
    public $userbranchid;

    public function __construct()
    {



    }

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new MainCore();
        }

        return self::$_instance;
    }
    public function getuserbranchid()
    {

        return $this->userbranchid = branch_user::where('user_id', Auth::user()->id)->with('stock','branch')->get();

    }

    public static function readAll($table_name, $columns, $model_name, $relationships)
    {
        if ($relationships != null && $model_name != null) {
            return $model_name::with($relationships)->get();
        } elseif ($table_name != null && $columns != null) {
            return DB::table($table_name)->select($columns ? $columns : '*')->get();
        } else {
            $all = $model_name::all();
            return $all;


        }
    }


    public static function store($model_name, $table_name, $input, $message_variable, $url)
    {

        if ($model_name != null) {
            $created = $model_name::create($input);
            if ($created) {
                Session::flash('create', $message_variable . '  Has Been Created Successfully ');
            } else {
                Session::flash('error', $message_variable . '  error in create ');
            }

            ${$table_name . "result"} = $created;
dd($created);
            return redirect($url);
        } elseif ($table_name != null) {
            DB::table($table_name)->insert($input);
            Session::flash('create', $message_variable . ' Has Been Created Successfully');
            return redirect($url);
        }
    }


    public static function update($model_name, $table_name, $input, $target_record, $message_variable, $target_record_column, $url)
    {

        if ($model_name != null) {
            $model = $model_name::find($target_record);
            $model->update($input);
            Session::flash('update', $message_variable . '  Has Been Updated Successfully ');
            return redirect($url);
        } elseif ($table_name != null) {
            DB::table($table_name)->where($target_record_column, $target_record)->update($input);
            Session::flash('update', $message_variable . ' Has Been Updated Successfully');
            return redirect($url);
        }
    }


    public static function destroy($model_name, $table_name, $target_record, $message_variable, $target_record_column, $url)
    {

        if ($model_name != null) {
            $client = $model_name::find($target_record);
            $client->delete();
            Session::flash('delete', $message_variable . '  Has Been Deleted Successfully ');
            return redirect($url);
        } elseif ($table_name != null) {
            DB::table($table_name)->where($target_record_column, $target_record)->delete();
            Session::flash('delete', $message_variable . ' Has Been Deleted Successfully');
            return redirect($url);
        }

    }


}



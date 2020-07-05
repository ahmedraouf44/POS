<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\room_type;
use Validator;
use App\Http\Controllers\Classes\MainCore;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $all_room_type=  MainCore::readAll('room_type','','\App\Models\room_type','');
        $all_color=  MainCore::readAll('colour','','\App\Models\colour','');
        $all_main_category=  MainCore::readAll('main_category','','\App\Models\main_category','');
        $all_sub_category=  MainCore::readAll('sub_category','','\App\Models\sub_category','main_category');

    return view('category',compact('all_room_type','all_color','all_main_category','all_sub_category'));
    }
    public function getAll()
    {
        return $all_room_type=  MainCore::readAll('room_type','','\App\Models\room_type','');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        return MainCore::store('\App\Models\room_type','room_type',$request->all(),'room type','/category');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


     /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

            $validator = Validator::make($data, [
                'room_type' => ['required', 'string', 'max:255'],
                'room_type_ar' => ['required', 'string', 'max:255'],
                 'image' => 'required', //|base64image
                 //description optional


            ]);

        return $validator;

    }


        protected function saveImageBase64($request_image)
    {
        $path = public_path('room_type_images');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $file_data = substr($request_image, strpos($request_image, ",") + 1);

        //generating unique file name;
        $file_name = 'image_' . str_random(5) . '.png';

        $image = base64_decode($file_data);
        $path = public_path() . "/room_type_images/" . $file_name;
        file_put_contents($path, $image);
        return $file_name;
    }
}

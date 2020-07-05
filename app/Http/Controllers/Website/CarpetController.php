<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\carpets;
use App\Models\colour;
use App\Models\room_type;
use App\Models\carpet_room_type;
use App\Models\carpet_colour;
use App\Models\main_category;
use App\Models\sub_category;
use Validator;

class CarpetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $AllCarpets=carpets::with('sub_category','sub_category.main_category')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $room_types=room_type::all();
         $colour=colour::all();
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
         $url = \URL::to('/');
        if ($this->validator($request->all())->fails()) {

            $message="error in validation";


            } else {
                    $newCarpet=new carpets;
                    $newCarpet->name= $request->name;
                    $newCarpet->name_ar= $request->name_ar;
                    $newCarpet->description= $request->description;
                    $newCarpet->description_ar= $request->description_ar;
                    $newCarpet->code= $request->code;
                    $newCarpet->pile_height= $request->pile_height;
                    $newCarpet->aspect= $request->aspect;
                    $newCarpet->price= $request->price;
                    $newCarpet->is_local= $request->is_local;
                    $carpet_picture = $this->saveImageBase64($request->photo);
                    $newCarpet->photo=  $url. "/carpets/" .$carpet_picture;
                    //check maincategory
                    $sub_categoryCheck=sub_category::where('id',$request->sub_category_id)->first();
                    if($sub_categoryCheck)
                    {
                     $newCarpet->sub_category_id= $sub_categoryCheck->id;
                    }
                    else
                    {
                         $message="sub_category not exist";
                    }
                     $newCarpet->save();

                    if($newCarpet){
                    $carpet_room_type1=new carpet_room_type;
                    $carpet_room_type1->room_type_id=$request->room_type_id;
                    $carpet_room_type1->carpet_id= $newCarpet->id;
                    $carpet_room_type1->save();
                    $carpet_color1=new carpet_colour;
                    $carpet_color1->colour_id=$request->color_id;
                    $carpet_color1->carpet_id= $newCarpet->id;
                     $carpet_color1->save();
                     $message="created carpet successfly";
                    }else{
                     $message="error in create carpet";
                    }

            }
 return $message;
    }

//
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
         $carpet=carpets::where('id',$id)->first();
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
          $url = \URL::to('/');
        if ($this->validator($request->all())->fails()) {

            $message="error in validation";

            } else {
             $CarpetToEdit=carpets::where('id',$id)->first();
             if( $CarpetToEdit)
             {

                $CarpetToEdit=  $CarpetToEdit->update($request->all());

                  $carpet_picture = $this->saveImageBase64($request->photo);
                  $carpet_picture_path=  $url. "/carpets/" .$carpet_picture;
                 $CarpetToEdit->update(['photo'=>$carpet_picture_path]) ;
                 carpet_room_type::update((['room_type_id'=> $request->room_type_id,'carpet_id'=> $CarpetToEdit->id]));
                 carpet_colour::update((['colour_id'=> $request->color_id,'carpet_id'=> $CarpetToEdit->id]));;

             }
                    if($CarpetToEdit){
                     $message="updated carpet successfly";
                    }else{
                     $message="error in update carpet";
                    }
                return $message;
            }
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
         $deleted=DB::table('carpets')->where('id', '=', $id)->delete();
          $deleted_roomtype=DB::table('carpet_room_type')->where('carpet_id', '=', $id)->delete();
           $deleted_color=DB::table('carpet_colour')->where('carpet_id', '=', $id)->delete();

         if($deleted)
         {
           $message="delete carpet successfly";
         }
         else
         {
             $message="error in delete carpet";
         }
           return $message;
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
                'name' => ['required', 'string', 'max:255'],
                'name_ar' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:255'],
                'description_ar' => ['required', 'string', 'max:255'],
                'code' => ['required', 'string', 'max:255'],
                'pile_height' => ['required', 'string', 'max:255'],
                'aspect' => ['required', 'string', 'max:255'],
                 'color_id' => ['required', 'string', 'max:255'],
                  'room_type_id' => ['required', 'string', 'max:255'],
                'price' => ['required', 'string', 'max:255'],
                 'photo' => 'required', //|base64image
                 'is_local' => 'required|integer|between:0,1',

                   'sub_category_id' => 'required|integer', //id

            ]);

        return $validator;

    }


        protected function saveImageBase64($request_image)
    {
        $path = public_path('carpets');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $file_data = substr($request_image, strpos($request_image, ",") + 1);

        //generating unique file name;
        $file_name = 'image_' . str_random(5) . '.png';

        $image = base64_decode($file_data);
        $path = public_path() . "/carpets/" . $file_name;
        file_put_contents($path, $image);
        return $file_name;
    }
}

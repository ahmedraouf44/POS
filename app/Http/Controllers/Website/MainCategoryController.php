<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\main_category;
use Validator;
use File;
use App\Http\Controllers\Classes\MainCore;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $all_Main=  MainCore::readAll('main_category','','\App\Models\main_category','');
        return view('dashboard.main_category.index',compact('all_Main'));
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

    public function createMainCategoryView()
    {
        //
        // return $request;

        return view('dashboard.main_category.create');
    }
    public function store(Request $request)
    {

        // return $request->file('image');
         $url = \URL::to('/');
       $x=$this->validator($request->all());
       if(! $x)
       {

            $message="error in validation";


            } else {



                $new_main_category=new main_category;
                $new_main_category->name= $request->name;
//                $main_category_picture = $this->saveImageBase64($request->image);
            $main_category_picture = $this->saveImageBase64($request->file('image'));

                $new_main_category->image=  $url. "/main_category_images/" .$main_category_picture;
                $new_main_category->save();
                 if($new_main_category){
                     $message="created Main category successfly";
                    }else{
                     $message="error in create Main category";
                    }

            }
             return $message;
        //
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
        $url = \URL::to('/');
        if ($this->validator($request->all())->fails()) {

            $message = "error in validation";

        } else {
            $MainCategoryToEdit = main_category::where('id', $id)->first();
            if ($MainCategoryToEdit) {
                $MainCategoryToEdit = $MainCategoryToEdit->update($request->all());
                $main_category_picture = $this->saveImageBase64($request->image);
                $main_category_picture_path = $url . "/main_category_images/" . $main_category_picture;
                $MainCategoryToEdit->update(['image' => $main_category_picture_path]);

                if ($MainCategoryToEdit) {
                    $message = "created Main category successfly";
                } else {
                    $message = "error in update Main category";
                }

            } else {
                $message = " Main category not exist";
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
                'name' => ['required', 'max:255']
               


            ]);

        return $validator;

    }


        protected function saveImageBase64($request_image)
    {
        $path = public_path('main_category_images');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
//
//        $file_data = substr($request_image, strpos($request_image, ",") + 1);
//
//        //generating unique file name;
//        $file_name = 'image_' . str_random(5) . '.png';
//
//        $image = base64_decode($file_data);
//        $path = public_path() . "/main_category_images/" . $file_name;
//        file_put_contents($path, $image);
//        return $file_name;


            $fileName = time() . $request_image->getClientOriginalName();
        // $request_image->move( public_path() . "/main_category_images/" . $fileName, $fileName);
//            $filePath = $fileName;
            $path=public_path() . "/main_category_images/" . $fileName; 
            move_uploaded_file($_FILES["image"]["tmp_name"], $path);
            return $fileName;

    }
}

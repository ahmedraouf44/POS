<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branches;
// use APP\Models\Branches;
use App\Models\Governs;
use Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $AllBranches=Branches::with('governs')->get();
         return view('index',compact('AllBranches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $governs=Governs::all();

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
                    $newBranch=new Branches;
                    $newBranch->title= $request->title;
                    $newBranch->sub_title= $request->sub_title;
                    $newBranch->title_en= $request->title_en;
                    $newBranch->sub_title_en= $request->sub_title_en;
                    $newBranch->phone= $request->phone;
                    $newBranch->location= $request->location;
                    $branch_picture = $this->saveImageBase64($request->image);
                    $newBranch->photo=  $url. "/branches_images/" .$branch_picture;
                    //check governs
                    $govern=Governs::where('id',$request->govern_id)->first();
                    if($govern)
                    {
                     $newBranch->govern_id= $govern->id;
                    }
                    else
                    {
                         $message="govern not exist";
                    }
                     $newBranch->save();

                    if($newBranch){
                     $message="created branch successfly";
                    }else{
                     $message="error in create branch";
                    }

            }
 return $message;

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

            $message="error in validation";


            } else {
              $BranchToEdit=Branches::where('id',$id)->first();
             if( $BranchToEdit)
             {

                $BranchToEdit=  $BranchToEdit->update($request->all());
                $branch_picture = $this->saveImageBase64($request->image);
                $branch_picture_path= $url. "/branches_images/" .$branch_picture;
                 $BranchToEdit->update(['image'=>$branch_picture_path]) ;

                  $message="updated branch successfly";
             }
                   else{
                     $message="error in update branch";
                    }


            }
 return $message;
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
        $deleted=DB::table('Branches')->where('id', '=', $id)->delete();


         if($deleted)
         {
           $message="delete branch successfly";
         }
         else
         {
             $message="error in delete branch";
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
                'title' => ['required', 'string', 'max:255'],
                'sub_title' => ['required', 'string', 'max:255'],
                'title_en' => ['required', 'string', 'max:255'],
                'sub_title_en' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:11'],
                 'image' => 'required', //|base64image
                 'location' => ['required', 'string', 'max:255'],
                  'govern_id' => 'required|integer', //id

            ]);

        return $validator;

    }


        protected function saveImageBase64($request_image)
    {
        $path = public_path('branches_images');
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $file_data = substr($request_image, strpos($request_image, ",") + 1);

        //generating unique file name;
        $file_name = 'image_' . str_random(5) . '.png';

        $image = base64_decode($file_data);
        $path = public_path() . "/branches_images/" . $file_name;
        file_put_contents($path, $image);
        return $file_name;
    }
}

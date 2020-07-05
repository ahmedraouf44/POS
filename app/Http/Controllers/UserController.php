<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Classes\MainCore;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = MainCore::readAll('', '', 'App\Models\Branches', '');
        $users = User::all();

        return view('users', compact('users', 'branches'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'max:11'],
            'password' => ['required'],
            'password_conf' => ['required']
        ]);

        if ($validator->fails()) {

            $message = "error in validation";


        } else {

            $newUser = new User();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->phone = $request->phone;
            $newUser->password = Hash::make($request->password);
            $newUser->save();

            if ($newUser) {

                MainCore::store('','branch_user',["user_id"=>$newUser->id,"branch_id"=>$request->branches],'','');
                $message = "created user successfly";
            } else {
                $message = "error in create user";
            }

        }

        return redirect()->route('users')->with($message);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = 0)
    {
//        dd($request);
        $validator = Validator::make($request->input(), [

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'string', 'max:11'],
//            'password' => ['required'],
//            'password_conf' => 'required', //id

        ]);
//        dd($validator);
        if ($validator->fails()) {

            $message = "error in validation";


        } else {
            $newUser = User::where('id', $request->id)->first();
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->phone = $request->phone;
//            $newUser->password= bcrypt($request->password);
            $newUser->save();

            if ($newUser) {
                $message = "created branch successfly";
            } else {
                $message = "error in create branch";
            }

        }
        return redirect()->route('users')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        if ($user) {
            $message = "delete user successfly";
        } else {
            $message = "error in delete user";
        }

        return redirect()->route('users')->with($message);

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
            'address' => ['required', 'string', 'max:255'],
            // 'title_en' => ['required', 'string', 'max:255'],
            // 'sub_title_en' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:11'],
            //  'image' => 'required', //|base64image
            //  'location' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'max:11'],
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

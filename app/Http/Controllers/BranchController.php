<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PriceList;
use Illuminate\Http\Request;
use App\Models\Branches;
// use APP\Models\Branches;
use App\Models\Governs;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
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
        $AllBranches=Branches::with('stock','customers.branch','customers.type')->get();
//         return $stock=Stock::with('products')->get();
//        dd($AllBranches[87]);

         return view('branches',compact('AllBranches'));
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
//        $validator = Validator::make($request->input(), [
//
//            'title' => ['required', 'string', 'max:255'],
//            'address' => ['required', 'string', 'max:255'],
//            'phone' => ['required', 'string', 'max:11'],
//            'govern_id' => 'required', //id
//        ]);
//
//        if ($validator->fails()) {

            $message="error in validation";


//            } else {
        $newBranch=new Branches;
        if($request->branch_name){
            $newBranch->branch_name= $request->branch_name;
        }
        if($request->branch_phone){
            $newBranch->branch_phone= $request->branch_phone;
        }
        if($request->branch_type){
            $newBranch->branch_type= $request->branch_type;
        }
        if($request->branch_email){
            $newBranch->branch_email= $request->branch_email;
        }
        if($request->branch_address){
            $newBranch->branch_address= $request->branch_address;
        }
        $branch_number=Branches::select('branch_number')->max('branch_number');
        $branch_number++;
        $newBranch->branch_number= $branch_number;
        $newBranch->branch_status= 1;
        $newBranch->save();

        if($newBranch){
         $message="created branch successfly";
        }else{
         $message="error in create branch";
        }

//            }
 return redirect()->route('branches')->with($message);

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

    public function transfer(Request $request)
    {

        return Auth::user()->getuserbranchid();
        $branch=Session::get(userbranchid);
        dd($branch);
        foreach ($request->title as $key=>$value){
            dd($value);
        }

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
    public function update(Request $request,$id)
    {

        $newBranch = Branches::where('id', $id)->first();
        if ($request->branch_name) {
            $newBranch->branch_name = $request->branch_name;
        }
        if ($request->branch_phone) {
            $newBranch->branch_phone = $request->branch_phone;
        }
        if ($request->branch_type) {
            $newBranch->branch_type = $request->branch_type;
        }
        if ($request->branch_email) {
            $newBranch->branch_email = $request->branch_email;
        }
        if ($request->branch_address) {
            $newBranch->branch_address = $request->branch_address;
        }

        $newBranch->branch_status = 1;
        $newBranch->save();

        if ($newBranch) {
            $message = "updated branch successfly";
        } else {
            $message = "error in update branch";
        }


        return redirect()->route('branches')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branch=Branches::where('branch_id',$id)->first();
        $branch->delete();
        if($branch){
            $message="delete branch successfly";
            }else{
            $message="error in delete branch";
            }

        return redirect()->route('branches')->with($message);

    }

    public function priceList()
    {
        $priceLists=PriceList::all();
        return view('priceLists',compact('priceLists'));
    }

    public function addPriceList(Request $request)
    {
        $newPrice=new PriceList();
        if ($request->ref_code) {
            $newPrice->ref_code = $request->ref_code;
        }
        if ($request->item_price) {
            $newPrice->item_price = $request->item_price;
        }
        if ($request->start_date) {
            $newPrice->start_date = $request->start_date;
        }
        if ($request->end_date) {
            $newPrice->end_date = $request->end_date;
        }
        if ($request->type) {
            $newPrice->type = $request->type;
        }
        $newPrice->save();
        return redirect()->route('priceList');
    }

    public function editPriceList(Request $request, $id)
    {
        $newPrice= PriceList::where('price_list_id',$id)->first();
        if ($request->ref_code) {
            $newPrice->ref_code = $request->ref_code;
        }
        if ($request->item_price) {
            $newPrice->item_price = $request->item_price;
        }
        if ($request->start_date) {
            $newPrice->start_date = $request->start_date;
        }
        if ($request->end_date) {
            $newPrice->end_date = $request->end_date;
        }
        if ($request->type) {
            $newPrice->type = $request->type;
        }
        $newPrice->save();
        return redirect()->route('priceList');
    }

    public function deletePriceList($id)
    {
        $newPrice= PriceList::where('price_list_id',$id)->first();
        $newPrice->delete();
        return redirect()->route('priceList');
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
//                'stock' => ['required', 'integer', 'max:11'],
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

<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Classes\MainCore;
use App\Http\Controllers\Controller;
use App\Models\branch_user;
use App\Models\Branches;
use App\Models\ItemStock;
use App\Models\ItemMaster;
use App\Models\Notifications;
use App\Models\PriceList;
use App\Models\Stock;
use App\Models\Packages;
use App\Models\PackageDetails;
use App\Models\StockDoc;
use App\Models\StockDocDetails;
use App\Models\TransferStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

use App\User;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function branch_id()
    {
        if (Auth::user()->is_admin == 1) {
            return 1;
        } else {
            return 2;
        }
    }

    public function stock_id()
    {
        $id = StockDoc::select('stock_doc_id')->where('branch_number', $this->branch_id())->max('stock_doc_id');
        $id++;
        return $id;
    }

    public $runners = [100222882, 100222884, 100222890, 100222892, 100222900, 100222901, 100222907, 100222908, 100222917, 100214366, 100222727, 100222729, 100222730, 100218359, 100214367, 100222731, 100222732, 100222745, 100219310, 100214359, 100214368, 100222746, 100222747, 100216376, 100216378, 100216380, 100216375, 100216382, 100216383, 100216384, 100214193, 100214192, 100214191, 100216366, 100216367, 100216368, 100216370, 100216371, 100216372, 100222899, 100222918, 100219309, 100214358, 100222744, 100216392, 100216374, 100216379, 100216389, 100222919, 100214357, 100222893, 100222909, 100222885, 100222916];

    public function index()
    {
//        $getmainbranchid = Branches::where('is_center', '1')->select('id')->get();
//        $getbranchwithstock = branch_user::where('user_id', Auth::user()->id)->with('stock')->get();
//        $allstockforallbranches = MainCore::readAll('', '', '\App\Models\Stock', ['products', 'branch']);
        $getstockformainbranch = ItemStock::with('branch')->where('branch_number', $this->branch_id())->where('item_quantity', '!=', 0)->get();
        $branches = Branches::all();
        $runners = $this->runners;
        $branch_id = $this->branch_id();
        $docStockId = $this->stock_id();
        return view('package', compact('docStockId', 'branches', 'runners', 'branch_id'));
    }

    public function ItemBySerial(Request $request)
    {
        //    return($request->serial);
        $item = ItemStock::with('master')->where('item_serial', $request->serial)->where('branch_number', $this->branch_id())->where('item_quantity', '>', 0)->get();
        if (count($item) > 0) {
            return $item[0];
        } else {
            return $item = ["item_serial" => "not found"];
        }
    }

    public function confirmSerial(Request $request)
    {
        $item = ItemStock::where('item_serial', $request->serial)->where('branch_number', $this->branch_id())->where('item_quantity', '>', 0)->get();
        if (count($item) > 0) {
            return $item[0];
        } else {
            return $item = ["item_serial" => "not found"];
        }
    }

    public function importDocs()
    {

        $docs = StockDoc::with('details.itemMaster', 'branchfrom')->where('branch_number', $this->branch_id())->where('stock_branch_to', $this->branch_id())->get();
        $pending = StockDoc::with('details', 'branchfrom')
            ->where('ref_stock_doc', NULL)
            ->where('stock_doc_status', 1)
            ->where('stock_branch_to', $this->branch_id())
            ->get()->sortByDesc("id");
//        dd($docs);
        foreach ($pending as $key => $value) {
            $exist = StockDoc::where('ref_stock_doc', $value->stock_doc_id)->first();
            if ($exist) {
                unset($pending[$key]);
            }
        }
        return view('importDocs', compact('docs', 'pending'));
    }

    public function exportDocs()
    {
        $docs = StockDoc::with('details.itemMaster', 'branchto')
            ->where('branch_number', $this->branch_id())
            ->where('stock_branch_from', $this->branch_id())->get()->sortByDesc("id");
        return view('exportDocs', compact('docs'));
    }


    public function transfer(Request $request)
    {
        $branchname = Branches::select('branch_name')->where('branch_number',$request->branchFrom)->first();
       // return $branchname->branch_name;
       // return $request;
        if($request->update == 226){
             $doc =  StockDoc::with('details')
              ->where('stock_doc_id',$request->docid)
              ->where('branch_number',$request->branchnumber)
              ->first();

             $docdetids =[];
             foreach ($doc->details as  $value){
                 array_push($docdetids,$value['stock_doc_details_id']);
             }
           // return $request->oldids;
             $diff =  array_diff($docdetids,$request->oldids);
             if(!empty($diff)){
                 StockDocDetails::wherein('stock_doc_details_id',array_values($diff))->delete();
             }

            if (!empty( $request->newids)) {
                foreach ($request->newids as $key => $value) {
                    if (!empty($value)) {
                        $item = ItemStock::where('item_stock_id', $key)->first();
                        $item->item_quantity = 0;
                        $item->save();

                        $docDetails = new StockDocDetails();
                        $docDetails->stock_doc_id = $request->docid;
                        $docDetails->stock_id = $doc->id;
                        $docDetails->branch_number = $request->branchnumber;
                        $docDetails->item_code = $item->item_code;
                        $docDetails->ref_code = $item->ref_code;
                        $docDetails->item_serial = $item->item_serial;
                        $docDetails->item_quantity = $value;
                        $docDetails->item_width = $item->item_width;
                        $docDetails->item_length = $item->item_length;
                        $docDetails->save();
                    }
                }
            }
            if (!empty($request->length)) {
                foreach ($request->length as $key => $value) {
                    if (!empty($value)) {
                        $item = ItemStock::where('item_stock_id', $key)->first();
                        $item->item_length = ($item->item_length - $value);
                        $item->item_quantity = ($item->item_length - $value) * $item->item_width / 10000;
                        $item->save();

                        $docDetails = new StockDocDetails();
                        $docDetails->stock_doc_id = $request->docid;
                        $docDetails->stock_id =  $doc->id;
                        $docDetails->branch_number = $request->branchnumber;
                        $docDetails->item_code = $item->item_code;
                        $docDetails->ref_code = $item->ref_code;
                        $docDetails->item_serial = $item->item_serial;
                        $docDetails->item_quantity = $value * $item->item_width / 10000;
                        $docDetails->item_width = $item->item_width;
                        $docDetails->item_length = $value;
                        $docDetails->save();
                    }
                }
            }
            $doc->stock_doc_status = 1;
            $doc->save();
            return redirect()->route('exportDocs');

        }else{


//        dd(Auth::user()->getuserbranchid()[0]->Id);
        $doc = new StockDoc();
//        $doc->ref_stock_doc = ;
        $doc->stock_doc_id = $this->stock_id();
        $doc->branch_number = $request->branchFrom;
        $doc->doc_name = $request->name;
        $doc->stock_branch_from = $request->branchFrom;
        $doc->stock_branch_to = $request->branchTo;
//        $doc->stock_branch_date = _current_time();
        $doc->trans_type = 1;
        $doc->stock_doc_status = 0;
        $doc->stock_doc_createdby = Auth::user()->id;
        $doc->save();

        if ($doc) {
            $not = new Notifications();
            $not->notification_text = "لديك تحويل جديد من مخزن :  " . $branchname->branch_name." برقم ".$doc->stock_doc_id;
            $not->branch_number = $request->branchTo;
            $not->type = 2;
            $not->save();
            if (!empty($request->quantity)) {
                foreach ($request->quantity as $key => $value) {
                    if (!empty($value)) {
                        $item = ItemStock::where('item_stock_id', $key)->first();
                        $item->item_quantity = 0;
                        $item->save();

                        $docDetails = new StockDocDetails();
                        $docDetails->stock_doc_id = $doc->stock_doc_id;
                        $docDetails->stock_id = $doc->id;
                        $docDetails->branch_number = $doc->branch_number;
                        $docDetails->item_code = $item->item_code;
                        $docDetails->ref_code = $item->ref_code;
                        $docDetails->item_serial = $item->item_serial;
                        $docDetails->item_quantity = $value;
                        $docDetails->item_width = $item->item_width;
                        $docDetails->item_length = $item->item_length;
                        $docDetails->save();
                    }
                }
            }
            if (!empty($request->length)) {
                foreach ($request->length as $key => $value) {
                    if (!empty($value)) {
                        $item = ItemStock::where('item_stock_id', $key)->first();
                        $item->item_length = ($item->item_length - $value);
                        $item->item_quantity = ($item->item_length - $value) * $item->item_width / 10000;
                        $item->save();

                        $docDetails = new StockDocDetails();
                        $docDetails->stock_doc_id = $doc->stock_doc_id;
                        $docDetails->stock_id = $doc->id;
                        $docDetails->branch_number = $doc->branch_number;
                        $docDetails->item_code = $item->item_code;
                        $docDetails->ref_code = $item->ref_code;
                        $docDetails->item_serial = $item->item_serial;
                        $docDetails->item_quantity = $value * $item->item_width / 10000;
                        $docDetails->item_width = $item->item_width;
                        $docDetails->item_length = $value;
                        $docDetails->save();
                    }
                }
            }
            $toUser = Branches::where('branch_number', $request->branchTo)->first();

            $message = "you have a new Document from : " . Auth::user()->name;
            $data = StockDoc::with('details')->where('id', $doc->id)->get();
//            Mail::to($toUser->branch_email)->send(new SendMailable($message, $data, $toUser));
//            Mail::to('ahmed.rauf4444@gmail.com')->send(new SendMailable($message,$data,$toUser));

        }
            return redirect()->route('exportDocs');
        }
    }

    public function acceptDoc($id)
    {

        $doc = StockDoc::with('details')->where('id', $id)->first();
        $accept = new StockDoc();
        $accept->stock_doc_id = $this->stock_id();
        $accept->ref_stock_doc = $doc->stock_doc_id;
        $accept->branch_number = $this->branch_id();
        $accept->stock_branch_from = $doc->stock_branch_from;
        $accept->stock_branch_to = $doc->stock_branch_to;
//        $accept->stock_branch_date = _current_time();
        $accept->trans_type = 2;
        $accept->stock_doc_status = 2;
        $accept->stock_doc_createdby = Auth::user()->id;
        $accept->save();
        $branchname = Branches::select('branch_name')->where('branch_number',$doc->stock_branch_to)->first();
        if ($accept) {
            $not = new Notifications();
            $not->notification_text = "لقد تم استلام تحويلك الصادر الى  : " .  $branchname->branch_name;
            $not->branch_number = $doc->stock_branch_from;
            $not->type = 1;
            $not->save();
            foreach ($doc->details as $item) {
                $newDetails = $item->replicate();
                $newDetails->stock_doc_details_id = null;
                $newDetails->stock_id = $accept->id;
                $newDetails->save();

                $product = ItemStock::where('item_serial', strval($item->item_serial))->where('branch_number', $doc->stock_branch_from)->first();
//                $product->item_quantity = $product->item_quantity-$item->item_quantity;
//                $product->save();

                $new = new ItemStock();
                $new->item_code = $product->item_code;
                $new->ref_code = $product->ref_code;
                $new->item_serial = $product->item_serial;
                $new->item_quantity = $item->item_quantity;
                $new->item_width = $product->item_width;
                $new->item_length = $product->item_length;
                $new->item_class = $product->item_class;
                $new->post_date = date('Y-m-d');
                $new->stock_doc_type = $product->stock_doc_type;
                $new->stock_doc_number = $doc->stock_doc_id;
                $new->branch_number = $this->branch_id();

                $new->save();
            }
        }

        return redirect()->route('importDocs');
    }

    public function nots($id)
    {
        $not = Notifications::where('notifications_id', $id)->first();
        $not->is_read = 1;
        $not->save();
        if ($not->type == 2) {
            return redirect()->route('importDocs');
        } elseif ($not->type == 1) {
            return redirect()->route('exportDocs');
        }
    }

    public function filteration(Request $request)
    {
//        dd($request);
        $items = [];
        if ($request->code) {
            $products = ItemStock::with('branch')
                ->where('branch_number', $this->branch_id())
                ->where('item_quantity', '!=', 0)
                ->where('ref_code', $request->code)->get();
            foreach ($products as $product) {
                array_push($items, $product);
            }
        }
        if ($request->group) {
            $products = ItemStock::with('branch')
                ->whereHas('master', function ($query) use ($request) {
                    $query->where('item_group', 'LIKE', '%' . $request->group . '%');
                })
                ->where('branch_number', $this->branch_id())
                ->where('item_quantity', '!=', 0)->get();
            foreach ($products as $product) {
                array_push($items, $product);
            }
        }
        $getstockformainbranch = array_unique($items);

        $branches = Branches::all();
        $runners = $this->runners;
        return view('package', compact('getstockformainbranch', 'branches', 'runners'));
    }

    public function itemMaster(){
        $items=ItemMaster::all();
        return view('master', compact('items'));
    }

    public function addMaster(Request $request){
        $item=new ItemMaster();
        if($request->item_code){
            $item->item_code=$request->item_code;
        }
        if($request->item_group){
            $item->item_group=$request->item_group;
        }
        if($request->item_price){
            $item->item_price=$request->item_price;
        }
        if($request->grade){
            $item->grade=$request->grade;
        }
        if($request->quality){
            $item->quality=$request->quality;
        }
        if($request->backing){
            $item->backing=$request->backing;
        }
        if($request->design_no){
            $item->design_no=$request->design_no;
        }
        if($request->item_width){
            $item->item_width=$request->item_width;
        }
        if($request->item_length){
            $item->item_length=$request->item_length;
        }
        if($request->sample_no){
            $item->sample_no=$request->sample_no;
        }
        if($request->shape){
            $item->shape=$request->shape;
        }
        if($request->finishing){
            $item->finishing=$request->finishing;
        }
        if($request->min_stock){
            $item->min_stock=$request->min_stock;
        }

        $item->save();

        return redirect()->route('itemMaster');
    }
    public function updateMaster(Request $request,$id){
        $item= ItemMaster::where('item_id',$id)->first();
        if($request->item_code){
            $item->item_code=$request->item_code;
        }
        if($request->item_group){
            $item->item_group=$request->item_group;
        }
        if($request->item_price){
            $item->item_price=$request->item_price;
        }
        if($request->grade){
            $item->grade=$request->grade;
        }
        if($request->quality){
            $item->quality=$request->quality;
        }
        if($request->backing){
            $item->backing=$request->backing;
        }
        if($request->design_no){
            $item->design_no=$request->design_no;
        }
        if($request->item_width){
            $item->item_width=$request->item_width;
        }
        if($request->item_length){
            $item->item_length=$request->item_length;
        }
        if($request->sample_no){
            $item->sample_no=$request->sample_no;
        }
        if($request->shape){
            $item->shape=$request->shape;
        }
        if($request->finishing){
            $item->finishing=$request->finishing;
        }
        if($request->min_stock){
            $item->min_stock=$request->min_stock;
        }

        $item->save();

        return redirect()->route('itemMaster');
    }
    public function deleteMaster($id){
        $item= ItemMaster::where('item_id',$id)->first();
        $item->delete();

        return redirect()->route('itemMaster');
    }

    public function branchStock(){
//        dd(Auth::user()->getuserbranchwithstock()[0]);
        $branch = Branches::where('branch_id',Auth::user()->getuserbranchwithstock()[0]->branch_id)->first();
        $items = ItemStock::with('master')->where('branch_number',$this->branch_id())->where('item_quantity','>',0)->get();
//        dd($items[0]);
        $code=ItemMaster::select('item_code')->get();
        $codes=[];
        foreach ($code as $c){
            if (!in_array($c->item_code,$codes)){
                array_push($codes, $c->item_code);
            }
        }
        $codes=array_unique($codes);

        $ref=PriceList::select('ref_code')->where('type',$branch->branch_type)->get();
        $refs=[];
        foreach ($ref as $r){
            if (!in_array($r->ref_code,$refs)){
                array_push($refs, $r->ref_code);
            }
        }
        $refs=array_unique($refs);
        $class=ItemMaster::select('grade')->get();
        $classes=[];
        foreach ($class as $cl){
            if (!in_array($cl->grade,$classes)){
                array_push($classes, $cl->grade);
            }
        }
        $classes=array_unique($classes);
        return view('branchStock', compact('items','codes','refs','classes'));
    }
    public function addBranchStock(Request $request){
//        dd($request);
        $item = new ItemStock();
        if($request->item_code && $request->item_code !=0){
            $item->item_code=$request->item_code;
        }
        if($request->ref_code && $request->ref_code !=0){
            $item->ref_code=$request->ref_code;
        }
        if($request->item_serial){
            $item->item_serial=$request->item_serial;
        }
        if($request->item_width && $request->item_length){
            $item->item_width=$request->item_width;
            $item->item_length=$request->item_length;

            $item->item_quantity=$request->item_length*$request->item_width/10000;
        }
        if($request->item_class && $request->item_class != 0){
            $item->item_class=$request->item_class;
        }
        $item->branch_number=$this->branch_id();
        $item->stock_doc_type=2;
        $item->post_date = date('Y-m-d');
        $item->save();

        return redirect()->route('branchStock');
    }

    public function updateBranchStock(Request $request,$id){
        $item = ItemStock::where('item_stock_id',$id)->first();
        if($request->item_code && $request->item_code !=0){
            $item->item_code=$request->item_code;
        }
        if($request->ref_code && $request->ref_code !=0){
            $item->ref_code=$request->ref_code;
        }
        if($request->item_serial){
            $item->item_serial=$request->item_serial;
        }
        if($request->item_width && $request->item_length){
            $item->item_width=$request->item_width;
            $item->item_length=$request->item_length;

            $item->item_quantity=$request->item_length*$request->item_width/10000;
        }
        if($request->item_class && $request->item_class !=0){
            $item->item_class=$request->item_class;
        }

        $item->branch_number=$this->branch_id();
        $item->stock_doc_type=2;
//        $item->post_date=;
        $item->save();

        return redirect()->route('branchStock');
    }

    public function deleteBranchStock($id){
        $item = ItemStock::where('item_stock_id',$id)->first();
        $item->delete();

        return redirect()->route('branchStock');
    }

    public function viewstock()
    {

        $getmainbranchid = Branches::where('is_center', '1')->select('id')->get();

        $getbranchwithstock = branch_user::where('user_id', Auth::user()->id)->with('stock')->get();
        $allstockforallbranches = MainCore::readAll('', '', '\App\Models\Stock', ['products', 'branch']);
        $getstockformainbranch = Stock::where('branch_id', Auth::user()->getuserbranchid()[0]->branch_id)->with('products', 'branch')->get();

        return view('viewstock', compact('getstockformainbranch', 'allstockforallbranches'));

    }

    public function requestPackage()
    {
        $user_id = Auth::user()->id;

        $allstockforallbranches = MainCore::readAll('', '', '\App\Models\Stock', ['products', 'branch']);
//        dd( $allstockforallbranches[0]->branch->id);
        return view('requestPackage', compact('allstockforallbranches', 'user_id'));
    }

    public function requestPackageSubmit(Request $request)
    {
//dd($request->all());
        $idstock = $request->idstock;
        $quantity = $request->quantity;
        $userrequest = $request->user_id;
        $userrequestbranch = branch_user::where('user_id', $userrequest)->first(); //frombranch
        $from = $userrequestbranch->id;
        $productids = $request->productids;
        $productsnew = array_slice($productids, 0, count($idstock));
        $qunew = array_slice($quantity, 0, count($idstock));

        $branchesid = $request->branchids;
        $branchesnew = array_slice($branchesid, 0, count($idstock));
        $totalquantity = array_sum($qunew);
        $newpackage = new Packages;
        $newpackage->name = time() . $userrequest . 'user requestpackage';
        $newpackage->total_quantity = $totalquantity;
        $newpackage->save();


        if ($newpackage) {
            $newpackagedetails = new PackageDetails;
            $to = Stock::select('branch_id')->where('id', $branchesnew[0])->first();
            for ($i = 0; $i < count($idstock); $i++) {

                $newpackagedetails->package_id = $newpackage->id;
                $newpackagedetails->product_id = $productsnew[$i];
                $newpackagedetails->quntity = $qunew[$i];
                $newpackagedetails->save();
            }

            $newtransferStock = new TransferStock;
            $newtransferStock->package_id = $newpackage->id;
            $newtransferStock->status = "request";
            $newtransferStock->from_branch = $from;
            $newtransferStock->to_branch = $to;
            $newtransferStock->user_id = $userrequest;
            $newtransferStock->save();
            return redirect()->route('requestPackage');


        }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

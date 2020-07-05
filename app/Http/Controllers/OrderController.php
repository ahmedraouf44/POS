<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use Auth;
 use App\Models\ItemStock;
 use App\Models\PriceList;
 use App\Models\Customers;
 use App\Models\OrderMaster;
 use App\Models\OrderDetails;
 use App\Models\check;
 
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getBranchNumberAndUser()
     {
        $user=Auth::user();
        $created_by=$user->id;
        if($user->is_admin==1)
        { $branch_number=1;}
        else{
            $branch_number=2;
        }
        $data=["user_id"=>$created_by,'branch_number'=> $branch_number];

        return $data;
     }
    public function orderview()
    {
        //
    //     $user=Auth::user();
    //     $created_by=$user->id;
    //     if($user->is_admin==1)
    //     { $branch_number=1;}
    //     else{
    //         $branch_number=2;
    //     }

    //     $all_item_stock=ItemStock::where('branch_number',$branch_number)->with('price')->get();

    // //   dd($all_item_stock);

    //     // return view('create_order',compact('branch_number','all_item_stock','created_by'));
    //     return view('itemwithserial',compact('branch_number','all_item_stock','created_by'));

        $branchAndUser=$this->getBranchNumberAndUser();
        $branch_number=$branchAndUser['branch_number'];

        $allSales=OrderMaster::where('order_type', 9)->where('branch_number', $branch_number)->with('details')->with('details.itemmaster')->get();
        // dd($allSales);
        return view('sales',compact('allSales'));
    }
    public function getcustomers()
    {
        return Customers::select('customer_phone')->get();
    }

    public function getcustomerByPhone(Request $request)
    {
       $phone= $request->phone;
       $customer=Customers::where('customer_phone',$phone)->first();
       return $customer;

    }

    public function saveCustomer(Request $request)
    {
       $phone= $request->phone;
       $name= $request->name;
       $address= $request->address;
       $type= $request->type;
       $exist=Customers::where('customer_phone',$phone)->first();
       if($exist)
       {
           return ['exist'=>true,'customer'=>$exist];
       }
       else{
        $newCustomer=new Customers;
        $newCustomer->customer_name=$name;
        $branch_number=$this->getBranchNumberAndUser()['branch_number'];
        // $newCustomer->customer_number=$customer_number;
        $newCustomer->customer_number=$this->getLastCustomerNumberOfBranch($branch_number)+1;
        $newCustomer->customer_phone=$phone;
        $newCustomer->customer_address=$address;
        $newCustomer->branch_number=$branch_number;
        $newCustomer->customer_type=$type;
        $newCustomer->save();
        return  ['exist'=>false,'customer'=>$newCustomer];
       }


    }



    public function orderCreate(Request $request)
    {
        //return $request;
        $runners=[100222882,100222884,100222890,100222892,100222900,100222901,100222907,100222908,100222917,100214366,100222727,100222729,100222730,100218359,100214367,100222731,100222732,100222745,100219310,100214359,100214368,100222746,100222747,100216376,100216378,100216380,100216375,100216382,100216383,100216384,100214193,100214192,100214191
        ,100216366
        ,100216367
        ,100216368
        ,100216370
        ,100216371
        ,100216372
        ,100222899
        ,100222918
        ,100219309
        ,100214358
        ,100222744
        ,100216392
        ,100216374
        ,100216379
        ,100216389
        ,100222919
        ,100214357
        ,100222893
        ,100222909
        ,100222885
        ,100222916];
    //    dd( $request->customer_id);
        if($request->Draft !=null)
        {
            $order_status=0;
        }
        else{
            $order_status=1;
        }
        $created_by=$request->created_by;
        $customer_name=$request->customer_name;
        // $customer_number=$request->customer_number;
        $customer_phone=$request->customer_phone;
        $customer_address=$request->customer_address;
        $customer_branch_number=$request->customer_branch_number;
        $customer_type=$request->customer_type;
        $discount=$request->discount;
        $Tax_amount=$request->Tax_amount;
        $discountValues=$request->discountValues;
        $discount_type1=$request->discount_type1;
        $lengthArr=$request->length;

        $idStockItems=$request->iditem_stock;
        $payment_type=$request->payment_type;


        if($payment_type==15 || $payment_type==16 || $payment_type==17)
        {
            $collect=0;
           
        }
        else{
            $collect=1;
        }
       
        $newLength=array_slice( $lengthArr, 0, count( $idStockItems));
        $newDiscountValues=array_slice( $discountValues, 0, count( $idStockItems));
        $newdiscount_type1=array_slice( $discount_type1, 0, count( $idStockItems));

        $order_type=$request->order_type;


        if($order_type==9) //بيع
        {
            $reforder=0;
        }
        else{
            $reforder=0; //temporary but i shoul get id og old order مرتجع
        }


        // create customer
        if($request->customer_id ==null)
        {
        $newCustomer=new Customers;
        $newCustomer->customer_name=$customer_name;
        // $newCustomer->customer_number=$customer_number;
        $newCustomer->customer_number=$this->getLastCustomerNumberOfBranch($customer_branch_number)+1;
        $newCustomer->customer_phone=$customer_phone;
        $newCustomer->customer_address=$customer_address;
        $newCustomer->branch_number=$customer_branch_number;
        $newCustomer->customer_type=$customer_type;
        $newCustomer->save();
        }
        else{
            $newCustomer=Customers::where('customer_id',$request->customer_id )->first();
        }
        if($newCustomer)
        {
                $message=$newCustomer;
        }
        else{
            $message='error in create customer';
        }
        $lastOrderNymber= $this->getLastOrderNumberOfBranch($customer_branch_number);
        // dd($lastOrderNymber);
        $newOrderNumber=$lastOrderNymber+1;

        //get selected item stock item
        $selected_item_stock=ItemStock::wherein('item_stock_id',$idStockItems)->with('price')->get();

        // create OrderMaster
        $newOrderMaster=new OrderMaster;
        $newOrderMaster->order_type=$order_type;
        $newOrderMaster->ref_order=$reforder;
        $newOrderMaster->branch_number=$customer_branch_number;
        $newOrderMaster->order_number=$newOrderNumber;
        $newOrderMaster->customer_number= $newCustomer->customer_number;
        $newOrderMaster->customer_name=$newCustomer->customer_name;
        $newOrderMaster->customer_phone=$newCustomer->customer_phone;
        $newOrderMaster->payment_type=$payment_type;
        $newOrderMaster->created_by=$created_by;
        $newOrderMaster->discount=$discount;
        $newOrderMaster->tax_amount=$Tax_amount;
        $newOrderMaster->order_status=$order_status;
        $newOrderMaster->collect=$collect;
        // $newOrderMaster->net_amount=$Net_amount;
        $newOrderMaster->total_amount=0; //untill get all total amount from insert order details
        // dd($lastOrderNymber);

        if($payment_type==17)
        {
            $check_id=$request->check_id;
            $newOrderMaster->check_id=$check_id;
        }


        $Iterator1=0;
        foreach ($selected_item_stock as $item) {
            $totalAmount=0;
            $newWidth=$item->item_width;
                $newLength1=$newLength[$Iterator1];
                $itemQuantity=($newWidth * $newLength1)/10000;
                $itemTotalPrice=($item->price->item_price *  $itemQuantity);

                $totalAmount +=$itemTotalPrice;

                $Iterator1 +=1;
        }

        $discountWay=$request->discount_type;
        $netstate =$totalAmount;
        if($discount !=0)
        {
            if($discountWay==2){//value
         $netstate=$totalAmount-$discount;
        }
         else{
            $valuediscount=$totalAmount*($discount/100);
            $netstate=$totalAmount-$discount;
         }

        }
        if($Tax_amount !=0)
        {
            $value=$totalAmount*($Tax_amount/100);
// dd($value);
         $netstate=$totalAmount+$value;
        }

        $newOrderMaster->net_amount=$netstate;
        $newOrderMaster->total_amount=$totalAmount;
        $newOrderMaster->save();
        if($newOrderMaster)
        {
            $allDetails=[];
            $Iterator=0;
            $totalAmount=0;
            foreach ($selected_item_stock as $item) {


                $existRunners= in_array($item->item_code, $runners);
                // dd($item->item_width);
                $newWidth=$item->item_width;
                $newLength1=$newLength[$Iterator];
                $itemQuantity=($newWidth * $newLength1)/10000;
                $itemTotalPrice=($item->price->item_price *  $itemQuantity);

                if($newdiscount_type1[$Iterator]==2)
                {
                    $afterdiscount=$itemTotalPrice-$newDiscountValues[$Iterator];
                }
                else{
                    $valueDiscount=$itemTotalPrice*($newDiscountValues[$Iterator]/100);
                    $afterdiscount=$itemTotalPrice-$valueDiscount;
                }

                $newOrderDetails=new OrderDetails;
                $newOrderDetails->order_number=$newOrderMaster->order_number;
                // $newOrderDetails->branch_number=$customer_branch_number;
                $newOrderDetails->branch_number=$customer_branch_number;
                $newOrderDetails->item_code=$item->item_code;
                $newOrderDetails->ref_code=$item->ref_code;
                $newOrderDetails->item_serial=$item->item_serial;
                $newOrderDetails->item_price=$item->price->item_price;
                $newOrderDetails->item_width=$item->item_width;
                $newOrderDetails->item_length=$newLength1;
                $newOrderDetails->item_class=$item->item_class;
                $newOrderDetails->net_amount=$afterdiscount;
                $newOrderDetails->discount=$newDiscountValues[$Iterator];

                if($existRunners)
                {
                    $newOrderDetails->item_quantity=$itemQuantity;
                }
                else
                {
                    $newOrderDetails->item_quantity=$item->item_quantity;
                }


                $newOrderDetails->total_price=$itemTotalPrice;

                // dd(count($selected_item_stock));
                $newOrderDetails->save();
                array_push($allDetails, $newOrderDetails);

                if($order_status==1)//cut from length and quantity of item stock
                {
                    $itemStocklengthAfterOrder=($item->item_length -$newLength1);
                    $itemStockQuantityAfterOrder=($itemStocklengthAfterOrder * $item->item_width)/10000;
                    $newItemStockUpdate=ItemStock::where('item_stock_id', $item->item_stock_id)

                    ->update(['item_quantity' => $itemStockQuantityAfterOrder,'item_length'=>$itemStocklengthAfterOrder]);

                }

            }
            // $newOrderMaster->total_amount=$totalAmount;
            // $newOrderMaster->save();



        }
        $lastorderMasterAfterUpdate=OrderMaster::where('order_master_id', $newOrderMaster->id)->first();
       $discountWay= $request->discount_type;
        if($order_status ==1)
        {
            return view('invoice',compact('lastorderMasterAfterUpdate','allDetails','created_by','discountWay'));
        }
        else
        {
            return redirect('/orderview');
        }


// dd($newOrderMasterUpdate);






        //
    }


    public function getLastOrderNumberOfBranch($branch_number)
    {

        $orderNumber = \DB::table('order_master')->where('branch_number',$branch_number)->latest('order_number')->first();
        if($orderNumber==null)
        {
            return 0;
        }
        return  $orderNumber->order_number;
    //    return $orderNumber= OrderMaster::select('order_number')->where('branch_number',$branch_number)->getPdo()->lastInsertId();

    }


    public function getLastCustomerNumberOfBranch($branch_number)
    {

        $customerNumber = \DB::table('customers')->where('branch_number',$branch_number)->latest('customer_number')->first();
        if($customerNumber==null)
        {
            return 0;
        }
        return  $customerNumber->customer_number;
    //    return $orderNumber= OrderMaster::select('order_number')->where('branch_number',$branch_number)->getPdo()->lastInsertId();

    }

    public function retrivedorderview()
    {
        $user=Auth::user();
        $created_by=$user->id;
        if($user->is_admin==1)
        { $branch_number=1;}
        else{
            $branch_number=2;
        }

        $allConfirmedOrders2=OrderMaster::select('order_number')->where('ref_order',0)->where('order_status', 1)->where('branch_number', $branch_number)->where('order_type',9)->get();
        $allConfirmedOrders =[];
        foreach($allConfirmedOrders2 as $key => $allConfirmedOrderss){
            //return $allConfirmedOrderss['order_number'];
            $findreforderintable = OrderMaster::where('ref_order',$allConfirmedOrderss['order_number'])->get();
            if(count($findreforderintable) > 0){

            }else{
                $findreforderintable2 = OrderMaster::where('order_number',$allConfirmedOrderss['order_number'])->with('details')->with('details.itemmaster')->get();
                array_push($allConfirmedOrders,$findreforderintable2[0]);
            }

        }
       $allConfirmedOrders;
    //     $order_numbers=[];
    //     foreach($allConfirmedOrders as $order)
    //   {
    //     array_push($order_numbers,$order->order_number);
    //   }
    //   $allConfirmedOrdersnotretrivedBefor=OrderMaster::where('order_status', 1)->where('branch_number', $branch_number)->where('order_type',9)->whereNotIn('ref_order',$order_numbers)->with('details')->get();


        //dd( $allConfirmedOrdersnotretrivedBefor);
        return view('retrive_order2',compact('allConfirmedOrders'));
    }


    public function  retrivedorder($order_number,Request $request)
    {
        $branch_number=$request->branch_number;
        $retrivedOrder=OrderMaster::where(['order_number'=> $order_number,'branch_number'=> $branch_number,'order_status'=>1])->with('details')->first();
    //   dd($retrivedOrder);
        $user=Auth::user();
        $created_by=$user->id;
        $runners=[100222882,100222884,100222890,100222892,100222900,100222901,100222907,100222908,100222917,100214366,100222727,100222729,100222730,100218359,100214367,100222731,100222732,100222745,100219310,100214359,100214368,100222746,100222747,100216376,100216378,100216380,100216375,100216382,100216383,100216384,100214193,100214192,100214191
        ,100216366
        ,100216367
        ,100216368
        ,100216370
        ,100216371
        ,100216372
        ,100222899
        ,100222918
        ,100219309
        ,100214358
        ,100222744
        ,100216392
        ,100216374
        ,100216379
        ,100216389
        ,100222919
        ,100214357
        ,100222893
        ,100222909
        ,100222885
        ,100222916];
if($request->partial !=null)
{

    $IDofSelectedItems=$request->iditem_details;
    $selectedItemsToRetrive=OrderDetails::wherein('order_details_id',$IDofSelectedItems)->get();

    $newordernumber=$this->getLastOrderNumberOfBranch($branch_number)+1;
    $order_type=10; //جزئي مرتجع

    $newOrderMaster=new OrderMaster;
    $newOrderMaster->order_type=$order_type;
    $newOrderMaster->ref_order=$retrivedOrder->order_number;
    $newOrderMaster->branch_number=$branch_number;
    $newOrderMaster->order_number=$newordernumber;
    $newOrderMaster->customer_number= $retrivedOrder->customer_number;
    $newOrderMaster->customer_name=$retrivedOrder->customer_name;
    $newOrderMaster->customer_phone=$retrivedOrder->customer_phone;
    $newOrderMaster->payment_type=$retrivedOrder->payment_type;
    $newOrderMaster->created_by=$created_by;
    $newOrderMaster->discount=0;
    $newOrderMaster->tax_amount=0;
    $newOrderMaster->order_status=1;
    $newOrderMaster->net_amount=$retrivedOrder->net_amount;
    $newOrderMaster->total_amount=$retrivedOrder->total_amount; //untill get all total amount from insert order details
    // dd($lastOrderNymber);
    $newOrderMaster->save();

    if($newOrderMaster)
    {
        $allDetails=[];
        $Iterator=0;
        $totalAmount=0;

        foreach ($selectedItemsToRetrive as $item) {

            // dd($newLength[$Iterator]);
           $existRunners= in_array($item->item_code, $runners);
        //    dd($existRunners);
            $newWidth=$item->item_width;
            $newLength=$item->item_length;
            $itemQuantity=$item->item_quantity;
            $itemTotalPrice=$item->total_price;
            $newOrderDetails=new OrderDetails;
            $newOrderDetails->order_number=$newOrderMaster->order_number;
            // $newOrderDetails->branch_number=$customer_branch_number;
            $newOrderDetails->branch_number=$branch_number;
            $newOrderDetails->item_code=$item->item_code;
            $newOrderDetails->ref_code=$item->ref_code;
            $newOrderDetails->item_serial=$item->item_serial;
            $newOrderDetails->item_price=$item->item_price;
            $newOrderDetails->item_width=$newWidth;
            $newOrderDetails->item_length=$newLength;
            $newOrderDetails->item_class=$item->item_class;

            $newOrderDetails->item_quantity=$itemQuantity;

            $newOrderDetails->total_price=$itemTotalPrice;

            // dd(count($selected_item_stock));
            $newOrderDetails->save();



            $itemStocktoupdate=ItemStock::where('item_serial', $item->item_serial)->where('branch_number',$branch_number)->first();
            // array_push($allDetails, $newOrderDetails);
            // dd($item->item_serial);
           //cut from length and quantity of item stock

                if($existRunners)
                {
                    $newitemStockRunners= new ItemStock;
                    $newitemStockRunners->item_code=$item->item_code;
                    $newitemStockRunners->ref_code=$item->ref_code;
                    $newitemStockRunners->item_serial=$item->item_serial;
                    $newitemStockRunners->item_width=$newWidth;
                    $newitemStockRunners->item_length=$newLength;
                    $newitemStockRunners->item_quantity=($newWidth * $newLength)/10000;
                    $newitemStockRunners->item_class=$item->item_class;
                    $newitemStockRunners->branch_number=$branch_number;
                    $newitemStockRunners->stock_doc_type=$itemStocktoupdate->stock_doc_type;
                    $newitemStockRunners->save();
                    // dd( $newitemStockRunners);

                }
                else{

                    $itemStocklengthAfterOrder=($itemStocktoupdate->item_length +$newLength);
                    $itemStockQuantityAfterOrder=($itemStocklengthAfterOrder * $itemStocktoupdate->item_width)/10000;
                    $newItemStockUpdate=ItemStock::where('item_stock_id', $itemStocktoupdate->item_stock_id)

                    ->update(['item_quantity' => $itemStockQuantityAfterOrder,'item_length'=>$itemStocklengthAfterOrder]);
                }

        }
    }
    return redirect('/retrivedorderview');

}






if($request->Confirm !=null)
        {
            $newordernumber=$this->getLastOrderNumberOfBranch($branch_number)+1;
            $order_type=10; //كلي مرتجع

            $newOrderMaster=new OrderMaster;
            $newOrderMaster->order_type=$order_type;
            $newOrderMaster->ref_order=$retrivedOrder->order_number;
            $newOrderMaster->branch_number=$branch_number;
            $newOrderMaster->order_number=$newordernumber;
            $newOrderMaster->customer_number= $retrivedOrder->customer_number;
            $newOrderMaster->customer_name=$retrivedOrder->customer_name;
            $newOrderMaster->customer_phone=$retrivedOrder->customer_phone;
            $newOrderMaster->payment_type=$retrivedOrder->payment_type;
            $newOrderMaster->created_by=$created_by;
            $newOrderMaster->discount=0;
            $newOrderMaster->tax_amount=0;
            $newOrderMaster->order_status=1;
            $newOrderMaster->net_amount=$retrivedOrder->net_amount;
            $newOrderMaster->total_amount=$retrivedOrder->total_amount; //untill get all total amount from insert order details
            // dd($lastOrderNymber);
            $newOrderMaster->save();
            if($newOrderMaster)
            {
                $allDetails=[];
                $Iterator=0;
                $totalAmount=0;
                foreach ($retrivedOrder->details as $item) {
                    // dd($newLength[$Iterator]);
                    $existRunners= in_array($item->item_code, $runners);
                    $newWidth=$item->item_width;
                    $newLength=$item->item_length;
                    $itemQuantity=$item->item_quantity;
                    $itemTotalPrice=$item->total_price;
                    $newOrderDetails=new OrderDetails;
                    $newOrderDetails->order_number=$newOrderMaster->order_number;
                    // $newOrderDetails->branch_number=$customer_branch_number;
                    $newOrderDetails->branch_number=$branch_number;
                    $newOrderDetails->item_code=$item->item_code;
                    $newOrderDetails->ref_code=$item->ref_code;
                    $newOrderDetails->item_serial=$item->item_serial;
                    $newOrderDetails->item_price=$item->item_price;
                    $newOrderDetails->item_width=$newWidth;
                    $newOrderDetails->item_length=$newLength;
                    $newOrderDetails->item_class=$item->item_class;

                    $newOrderDetails->item_quantity=$itemQuantity;

                    $newOrderDetails->total_price=$itemTotalPrice;

                    // dd(count($selected_item_stock));
                    $newOrderDetails->save();


                    $itemStocktoupdate=ItemStock::where('item_serial', $item->item_serial)->where('branch_number',$branch_number)->first();
                    // array_push($allDetails, $newOrderDetails);

                   //cut from length and quantity of item stock
                   if($existRunners)
                   {

                    $newitemStockRunners= new ItemStock;
                    $newitemStockRunners->item_code=$item->item_code;
                    $newitemStockRunners->ref_code=$item->ref_code;
                    $newitemStockRunners->item_serial=$item->item_serial;
                    $newitemStockRunners->item_width=$newWidth;
                    $newitemStockRunners->item_length=$newLength;
                    $newitemStockRunners->item_quantity=($newWidth * $newLength)/10000;
                    $newitemStockRunners->item_class=$item->item_class;
                    $newitemStockRunners->branch_number=$branch_number;
                    $newitemStockRunners->stock_doc_type=$itemStocktoupdate->stock_doc_type;
                    $newitemStockRunners->save();
                   }
                   else{

                    $itemStocklengthAfterOrder=($itemStocktoupdate->item_length +$newLength);
                    $itemStockQuantityAfterOrder=($itemStocklengthAfterOrder * $itemStocktoupdate->item_width)/10000;
                    $newItemStockUpdate=ItemStock::where('item_stock_id', $itemStocktoupdate->item_stock_id)

                    ->update(['item_quantity' => $itemStockQuantityAfterOrder,'item_length'=>$itemStocklengthAfterOrder]);


                   }





                }
            }
            return redirect('/retrivedorderview');
        }
    }


    public function getInvoice($orderNumber)
    {
        $branchAndUser=$this->getBranchNumberAndUser();
        $branch_number=$branchAndUser['branch_number'];
        $created_by=$branchAndUser['user_id'];
        $discountWay=0;
        $lastorderMasterAfterUpdate = OrderMaster::where('order_number',$orderNumber)->where('branch_number',$branch_number)->with('details')->with('details.itemmaster')->first();
       $allDetails=$lastorderMasterAfterUpdate->details;
//dd($allDetails[0]->ref_code);
        return view('invoice2',compact('lastorderMasterAfterUpdate','allDetails','created_by','discountWay'));

//        dd($orderNumber);
    }

    public function getItemStockBySerial(Request $request)
    {
    //    return($request->serial);
        $item = ItemStock::where('item_serial',$request->serial)->where('item_length', '>', 0)->get();
        if (count($item) > 0){
            return $item[0];
        }else{
            return $item = ["item_serial"=>"not found"];
        }
    }



    public function getAllSales()
    {
        $branchAndUser=$this->getBranchNumberAndUser();
        $branch_number=$branchAndUser['branch_number'];

        $allSales=OrderMaster::where('order_type', 9)->where('branch_number', $branch_number)->with('details')->get();
        return view('sales',compact('allSales'));

        //
    }
    public function getorderByDate(Request $request)
    {
        $order_date=$request->order_date;
        $branchAndUser=$this->getBranchNumberAndUser();
        $branch_number=$branchAndUser['branch_number'];
        $allConfirmedOrders2=OrderMaster::where('ref_order',0)->where('order_status', 1)->where('branch_number', $branch_number)->where('order_type',9)->where('payment_type',13)->where('cash_status',0)->where('order_date',$order_date)->get();
        $allConfirmedOrders =[];
        foreach($allConfirmedOrders2 as $key => $allConfirmedOrderss){
            //return $allConfirmedOrderss['order_number'];
            $findreforderintable = OrderMaster::where('ref_order',$allConfirmedOrderss['order_number'])->get();
            if(count($findreforderintable) > 0){

            }else{
                $findreforderintable2 = OrderMaster::where('order_number',$allConfirmedOrderss['order_number'])->with('details')->get();
                array_push($allConfirmedOrders,$findreforderintable2[0]);
            }

        }
        return $allConfirmedOrders;
    }


    public function getExportsByDate(Request $request)
    {
        $order_date=$request->order_date;
        $branchAndUser=$this->getBranchNumberAndUser();
        $branch_number=$branchAndUser['branch_number'];
        $allConfirmedOrders2=OrderMaster::where('ref_order',0)->where('order_status', 1)->where('branch_number', $branch_number)->where('order_type',9)->where('payment_type',13)->where('cash_status',1)->where('order_date',$order_date)->get();
        $allConfirmedOrders =[];
        foreach($allConfirmedOrders2 as $key => $allConfirmedOrderss){
            //return $allConfirmedOrderss['order_number'];
            $findreforderintable = OrderMaster::where('ref_order',$allConfirmedOrderss['order_number'])->get();
            if(count($findreforderintable) > 0){

            }else{
                $findreforderintable2 = OrderMaster::where('order_number',$allConfirmedOrderss['order_number'])->with('details')->get();
                array_push($allConfirmedOrders,$findreforderintable2[0]);
            }

        }
        return $allConfirmedOrders;
    }

    public function exports()
    {

        return view('exports');
        //
    }

    public function getExports()
    {

        return view('exportsOfDay');
        //
    }


    public function makeExport(Request $request)
    {

        // dd($request->idMaster);
        foreach ($request->idMaster as $orderMaster) {
            # code...

            $neworderMasterUpdate=OrderMaster::where('order_master_id',$orderMaster )

            ->update(['cash_status' => 1]);

        }
        return redirect('/exports');
        //
    }



    public function confirmReservedOrder($order_number,Request $request)
    {
        //

        if($request->collect !=null)
        {
            $update=OrderMaster::where('order_number',$order_number)->where('branch_number',$request->branch_number)->update(['collect'=>1]);
        }
        $runners=[100222882,100222884,100222890,100222892,100222900,100222901,100222907,100222908,100222917,100214366,100222727,100222729,100222730,100218359,100214367,100222731,100222732,100222745,100219310,100214359,100214368,100222746,100222747,100216376,100216378,100216380,100216375,100216382,100216383,100216384,100214193,100214192,100214191
        ,100216366
        ,100216367
        ,100216368
        ,100216370
        ,100216371
        ,100216372
        ,100222899
        ,100222918
        ,100219309
        ,100214358
        ,100222744
        ,100216392
        ,100216374
        ,100216379
        ,100216389
        ,100222919
        ,100214357
        ,100222893
        ,100222909
        ,100222885
        ,100222916];

        // dd($order_number);
        $order=OrderMaster::where('order_number',$order_number)->where('branch_number',$request->branch_number)->with('details')->first();
        foreach ($order->details as $item) {
            $existRunners= in_array($item->item_code, $runners);
            if($existRunners)
            {
                $item_stock=ItemStock::where('item_serial',$item->item_serial)->where('branch_number',$request->branch_number)->first();
                $length=$item->item_length;
                $newLength=$item_stock->item_length-$length;
                $newQuantity=($newLength * $item_stock->item_width)/10000;

                ItemStock::where('item_serial',$item->item_serial)->where('branch_number',$request->branch_number)
                ->update(['item_length' => $newLength,'item_quantity' =>$newQuantity]);
            }
            else{
                ItemStock::where('item_serial',$item->item_serial)->where('branch_number',$request->branch_number)
                ->update(['item_length' => 0,'item_quantity' =>0]);
            }
            if($order->payment_type==13 || $order->payment_type==14)
        {
            $update=OrderMaster::where('order_number',$order_number)->where('branch_number',$request->branch_number)->update(['order_status' => 1,'collect'=>1]);
        }
            else
            {
                $update=OrderMaster::where('order_number',$order_number)->where('branch_number',$request->branch_number)->update(['order_status' => 1]);
            }
           
           
            return redirect('/orderview');
            # code...
        }
    }


public function create_check(Request $request)
{
    //

   $url = \URL::to('/');
   $check_image = $this->saveImageCheck($request->check_image);
   $check_image_path=  $url. "/checks/" .$check_image;
   $check_number=$request->check_number;
   $check_cutomer=$request->check_cutomer;
   $bank_name=$request->bank_name;
   $check_value=$request->check_value;
   $check_date=$request->check_date;
   $newCheck=new check;
   $newCheck->customer_name=$check_cutomer;
   $newCheck->check_number=$check_number;
   $newCheck->bank_name=$bank_name;
   $newCheck->check_value=$check_value;
   $newCheck->check_image=$check_image_path;
   $newCheck->check_date=$check_date;
   $newCheck->save();

   return $newCheck->id;
}

protected function saveImageCheck($request_image)
{
   
    $path = public_path('checks');
    $file_data = substr($request_image, strpos($request_image, ",") + 1);
   
    //generating unique file name;
    $file_name = 'image_'.rand().'.png';
    $path = public_path() . "/checks/" . $file_name;
    move_uploaded_file($_FILES["check_image"]["tmp_name"], $path);
   
    return $file_name;
}
    public function index()
    {
        //
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
}

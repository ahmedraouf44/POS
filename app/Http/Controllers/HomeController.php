<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\OrderMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('branc-chart');
    }
    public function datatable(){
        return Auth::user()->getuserbranchwithstock();
        return view('datatables');
    }
    public function datatables(Request $request){

            if ($request->hasFile('file')) {
                $image = $request->file('file');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images');
                $image->move($destinationPath, $name);


                return back()->with('success','Image Upload successfully');
            }

    }

    public function charts(Request $request)
    {
        $branch_id = "";
        if (Auth::user()->is_admin == 1) {
            $branch_id = 1;
        } else {
            $branch_id = 2;
        }
        if ($request->chart == "sales") {
            $alldates = OrderMaster::select('order_date')
                ->where('order_type', 9)
                ->where('branch_number', $branch_id)
                ->get();
            $allamounts = OrderMaster::select('net_amount')
                ->where('order_type', 9)
                ->where('branch_number', $branch_id)
                ->get();
            $onlydates = [];
            $onlyamounts = [];
            foreach ($alldates as  $value) {
                array_push($onlydates,$value['order_date']);
            }
            foreach ($allamounts as  $value) {
                array_push($onlyamounts,$value['net_amount']);
            }

            $alldata = ["alldates"=>$onlydates,"allamounts"=>$onlyamounts];
            return $alldata;
        } elseif ($request->chart = "customer") {
            return "customer";
        } elseif ($request->chart = "docs") {
            return "docs";
        }

    }
}

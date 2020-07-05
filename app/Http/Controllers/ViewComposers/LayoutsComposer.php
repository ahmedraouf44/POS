<?php

namespace App\Http\ViewComposers;


use App\Models\Notifications;
use App\Models\Branches;
use  Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class LayoutsComposer
{
    public function branch_id()
    {
        $branch_number;

        if (Auth::user()) {
            if (Auth::user()->is_admin == 1) {
                $branch_number = 1;

                return 1;
            } else {
                $branch_number = 2;
                // $branchName=Branches::select('branch_name')->where('branch_number',$branch_number)->first();
                return 2;
            }
        }

    }

    public function compose(View $view)
    {

        // Return Projects In the footer of all pages

        //retrieve Projects in footer

        $nots = Notifications::where('branch_number', $this->branch_id())->where('is_read', 0)->get()->sortByDesc("notifications_id");
        $branch_number = $this->branch_id();
        $user = Auth::user();
        $branchName = Branches::select('branch_name')->where('branch_number', $branch_number)->first();
        $created_by = $user->id;
        $view->with(['nots' => $nots, 'branch_number' => $branch_number, 'created_by' => $created_by, 'branch_name' => $branchName->branch_name]);
    }
}

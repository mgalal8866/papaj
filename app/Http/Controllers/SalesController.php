<?php

namespace App\Http\Controllers;

use App\Models\branch;
use App\Models\sales;
use App\Models\times;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function index()
    {
        $times = times::whereActive(0)->get();
        $branches = branch::whereActive(0)->get();
        $sales = sales::whereDate('created_at', Carbon::today())->get();
    // dd($sales);
        return view('sales',compact('times','branches','sales'));
    }
    public function newsales()
    {
        // $now = Carbon::parse('4:00 AM')->format('h:i A');


        $times = times::whereActive(0)->get();
        // $timeadd = Carbon::now()->addHour(2)->format('h:i A');
        // $timesub = Carbon::now()->subHour(2)->format('h:i A');
        $s = '05:00 PM';
        $timeadd = Carbon::parse( $s )->addHour(1)->format('h:i A');
        $timesub = Carbon::parse( $s)->subHour(1)->format('h:i A');
       //  dd($timeadd,$timesub );
        $branches = branch::whereActive(0)->get();
        return view('newsales',compact('branches','times','timeadd','timesub'));
    }


}

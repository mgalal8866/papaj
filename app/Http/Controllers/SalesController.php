<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\sales;
use App\Models\times;
use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SalesController extends Controller
{
    public function time_sale()
    {
        $times    = times::whereActive(0)->get();
        $timenw   = Carbon::now()->format('H');

        foreach ($times as $index => $time){
            if( $timenw >= Carbon::parse($time->time_sales)->subHour(1)->format('H')&&
                $timenw <= Carbon::parse($time->time_sales)->addHour(1)->format('H'))
            {
                $timesales=['id'=>$time->id,'timesales'=>$time->time_sales];
                break;
            }
            else{
                if ($times->count() == $index + 1){
                    $timesales = null;
                    break;
                }
            }
        }
        return $timesales??null;
    }

    public function index()
    {
        $times = times::whereActive(0)->get();
        $branches = branch::whereActive(0)->get();
        $sales = sales::whereDate('created_at', Carbon::today())->get();
        return view('sales',compact('times','branches','sales'));
    }

    public function newsales()
    {
        $branches   = branch::whereActive(0)->get();
        $times      = times::whereActive(0)->get();
        $timesales  = $this->time_sale();
        return view('newsales',compact('branches','times','timesales'));
    }

    public function insertsales(Request $request)
    {
        $Sales = sales::whereDate('created_at', Carbon::today())->where('time_id',$request->time_sales)->where('branch_id',$request->branch)->get();
            if($Sales->count() > 0){

                $request->session()->flash('alert-success', 'User was successful added!');
                return Redirect::to('/new/sales');
            }else{
                sales::create([
                        'sales'     => $request->time_sales?$request->sales:null,
                        'time_id'   => $request->time_sales??null,
                        'branch_id' => $request->branch,
                        'close'     => $request->time_sales?null:$request->sales
                    ]);
                $request->session()->flash('alert-success', 'jl');
                return Redirect::to('/new/sales');
            }



    }
}

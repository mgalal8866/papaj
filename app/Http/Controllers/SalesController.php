<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use App\Models\fcm;
use App\Models\sales;
use App\Models\times;
use App\Models\branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SalesController extends Controller
{
    public function subHour($sub_time)
    {return Carbon::parse($sub_time)->subHour(1)->format('H'); }

    public function addHour($add_time)
    {return Carbon::parse($add_time)->addHour(1)->format('H'); }

    public function time_test()
    {
        $times    = times::whereActive(0)->get();
        $timenw   = Carbon::now()->format('H');
         $timenw   = '16';
        foreach ($times as $index => $time){
            switch(true)
                {
                    case $timenw >= $this->subHour($time->time_sales) && $timenw <= $this->addHour($time->time_sales):
                       return $timesales=['id'=>$time->id,'timesales'=>$time->time_sales];
                        break;
                    case $timenw >= $this->subHour($time->time_sales) && $this->addHour($time->time_sales) <= 1 ||  $timenw  <= 1:
                        return   $timesales=['id'=>$time->id,'timesales'=>$time->time_sales];
                        break;
                    case ($timenw >= 1) && ($timenw  <= 8) :
                        return   $timesales=['id'=> null,'timesales'=>'Close time'];
                         break;
                    case $times->count() == ($index + 1):
                        return $timesales =  null;
                        break;
                    default ;
                    // return $timesales = null;
                }
        }
         return $timesales;
    }


    // public function time_sale()
    // {
    //     $times    = times::whereActive(0)->get();
    //     $timenw   = Carbon::now()->format('H');
    //     //$timenw = '23';
    //     foreach ($times as $index => $time){


    //         if( $timenw >= Carbon::parse($time->time_sales)->subHour(1)->format('H') &&
    //             $timenw <= Carbon::parse($time->time_sales)->addHour(1)->format('H') || $timenw == Carbon::parse($time->time_sales)->format('H') )
    //         {
    //              $timesales=['id'=>$time->id,'timesales'=>$time->time_sales];
    //             break;
    //         }
    //         else{
    //             // dd( Carbon::parse('12:00 Am')->subHour(1)->format('H'));
    //             // $timenw >= Carbon::parse($time->time_sales)->subHour(1)->format('H') && ($timenw >= 23) ||
    //             // if($timenw == Carbon::parse($time->time_sales)->format('H') ||  $timenw > Carbon::parse($time->time_sales)->addHour(1)->format('H')){
    //             //     $timesales=['id'=>$time->id,'timesales'=>$time->time_sales,'s'=> Carbon::parse($time->time_sales)->addHour(1)->format('H')];
    //             //     break;
    //             // }elseif($times->count() == ($index + 1)){
    //             //     $timesales = null;
    //             //     break;

    //             // }
    //         }

    //     }

    //      return $timesales??null;
    // }
    public function index( )
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
        $timesales  = $this->time_test();
        return view('newsales',compact('branches','times','timesales'));
    }
    public function insertsales(Request $request)
    {
        $Sales = sales::whereDate('created_at', Carbon::today())->where('time_id',$request->time_sales)->where('branch_id',$request->branch)->get();
            if($Sales->count() > 0){
                toastr()->info('You have send sales before . Edit Seles is done','Edit');
                return Redirect::to('/new/sales');
            }else{
                sales::create([
                        'sales'     => $request->time_sales?$request->sales:null,
                        'time_id'   => $request->time_sales??null,
                        'branch_id' => $request->branch,
                        'close'     => $request->time_sales?null:$request->sales,
                        'tc'        => $request->ctc??null,
                        'created_at' => (date("H") >= 0 && date("H") <= 8)? date('Y-m-d', strtotime("-1 day")):Carbon::now()
                    ]);
                toastr()->success('Send Seles','New');
                return Redirect::to('/new/sales');
            }



    }
}

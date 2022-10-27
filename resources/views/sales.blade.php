@extends('layouts.master')
@section('title')
    Sales
@stop

@section('css')
<style>
.cc{
    /* background-image: url(/public/asset/vegetarian-black.jpg); */

    background-size: cover;
    height: 100vh;
}

</style>
@endsection

@section('content')
<div class=" cc " style="background-image: url({{url('asset/194.jpg')}})">
<div class="table-responsive-lg bg-light">

    <table class="table table-striped table-inverse table-responsive ">
        <thead class="thead-inverse">
            <tr class="bg-secondary text-white">
                <th>#</th>
                <th>Branch</th>
                @foreach ($times as $time)
                {{-- {{ $time->time_sales->format('H:i:s') ?? '' }}  --}}
                    <th>{{$time->time_sales}}</th>
                @endforeach
                <th>Close</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branches as $branch)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $branch->name }}</td>
                    @foreach ($times as $time)
                        <td>
                            @foreach ($sales as $sale)
                                    @if ($time->id == $sale->time_id && $branch->id == $sale->branch_id)
                                            <span class="text-success fw-bold">{{ $sale->sales }}</span>
                                        @break
                                    @else
                                        @if($sales->count() ==  $loop->index + 1)
                                            <span class="text-danger fw-bold">0</span>
                                        @endif
                                    @endif
                            @endforeach
                        </td>
                    @endforeach
                    <td>{{($sales->where('branch_id',$branch->id )->where('time_id',null )->first()->close??'0')}}</td>

                </tr>
            @endforeach
            <tr class="bg-secondary text-white">
                <td class="text-white fw-bold"> #</td>
                <td class="text-white fw-bold">Total</td>
                @foreach ($times as $time)
                <td>
                    @foreach ($sales as $sale)
                        @if ($time->id == $sale->time_id)
                            <span class="text-white fw-bold">{{$sale->whereDate('created_at', \Carbon\Carbon::today())->where('time_id', $time->id)->sum('sales') }}</span>
                            @break
                        @endif
                    @endforeach
                </td>
                @endforeach
                <td class="text-white fw-bold"> #</td>
            </tr>

        </tbody>
    </table>
</div>
</div>
@endsection

@section('js')
@endsection

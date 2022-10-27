@extends('layouts.master')
@section('title')
    Sales
@stop

@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="text-black  text-center fw-bold">  Selse </span>
                    @foreach ($times as $time)
                        @if (  \Carbon\Carbon::now()->format('H') >= \Carbon\Carbon::parse($time->time_sales)->subHour(1)->format('H') &&
                               \Carbon\Carbon::now()->format('H') <= \Carbon\Carbon::parse($time->time_sales)->addHour(1)->format('H'))
                              {{\Carbon\Carbon::parse($time->time_sales)->format('h:i A')}}
                              {{-- @break --}}
                        @else
                        {{-- <span class="text-danger text-center fw-bold">No Houre Sales</span> --}}
                        {{-- @break --}}
                        @endif

                    @endforeach
                </div>
                <form action="/insert/sales" method="POST">
                    @csrf
                        <div class="card-body">
                                <select  class="form-select" name="branch">
                                    <option selected >Choose Branch</option>
                                    @foreach ( $branches as  $branch)
                                    <option value="{{ $branch->id}}">  {{ $branch->name}} </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="card-footer">
                        <button type="submit" class="btn btn-success">Send</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
@endsection

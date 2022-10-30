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
                <th>Sales</th>
                <th>T.C</th>
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
                    <td>{{($sales->where('branch_id',$branch->id )->where('time_id',null )->first()->tc??'0')}}</td>
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
                <td class="text-white fw-bold"> #</td>
            </tr>

        </tbody>
    </table>
</div>
</div>
@endsection

@section('js')
<script>
var firebaseConfig = {
apiKey: "AIzaSyBreRvgcE1Kq2Mo8E4LSj9nEExRyGGMXW0",
authDomain: "papaj-ea7bd.firebaseapp.com",
projectId: "papaj-ea7bd",
storageBucket: "papaj-ea7bd.appspot.com",
messagingSenderId: "590651543681",
appId: "1:590651543681:web:4e05f52d8eab32c08cfd80",
measurementId: "G-TQEEHQQ296"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

function initFirebaseMessagingRegistration() {
    messaging.requestPermission().then(function () {
        return messaging.getToken()
    }).then(function(token,admin=1) {
    axios.post("{{ route('fcmToken') }}",{_method:"POST",token,admin
        }).then(({data})=>{
            console.log(data)
        }).catch(({response:{data}})=>{
            console.error(data)
        })

    }).catch(function (err) {
        console.log(`Token Error :: ${err}`);
    });
}

initFirebaseMessagingRegistration();

messaging.onMessage(function({data:{body,title}}){
    new Notification(title, {body});
});
</script>
@endsection

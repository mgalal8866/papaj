@extends('layouts.master')
@section('title')
    Sales
@stop

@section('css')
@endsection

@section('content')
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }} text-center d-flex align-items-center">
                    {{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert"
                        aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            @if ($timesales != null)
                <div class="card m-5 shadow border-secondary border-outline-success">
                    <div class="card-header text-center">
                        <span class="text-black  text-center fw-bold "> Selse </span>
                        @if ($timesales != null)
                            {{ $timesales['timesales'] }}
                        @else
                            <div class="alert alert-danger text-center d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                    aria-label="Danger:">
                                    <use xlink:href="#exclamation-triangle-fill" />
                                </svg>
                                <div>
                                    No Houre Sales / Close time
                                </div>
                            </div>
                        @endif
                    </div>

                    <form action="/insert/sales" method="POST">
                        @csrf
                        <div class="card-body">
                            <input type="number" hidden name="time_sales"
                                value="{{ $timesales != null ? $timesales['id'] : null }}">
                            <div class="mb-3">
                                <label for="selectbranch" class="form-label">Branch </label>
                                <select class="form-select" id="selectbranch" name="branch" required>
                                    <option selected value="">Choose Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"> {{ $branch->name }} -
                                            <span class="badge bg-info text-dark">Last: {{ $branch->close }} </span>
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="salestext" class="form-label">Sales</label>
                                <input type="number" step="any" class="form-control" id="salestext" name="sales" placeholder="" required>
                            </div>
                            @if ($timesales != null)
                                @if ($timesales['id'] == null )
                                <div class="mb-3">
                                    <label for="ctc" class="form-label">T.C C.Y (عمليات حالى):</label>
                                    <input type="number" step="any" class="form-control" id="ctc" name="ctc" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ltc" class="form-label">T.C L.Y (عمليات سابق):</label>
                                    <input type="number" step="any" class="form-control" id="ltc" name="ltc" placeholder="" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lys" class="form-label">Sales L.Y (مبيعات سابق):</label>
                                    <input type="number" step="any" class="form-control" id="lys" name="lys" placeholder="" required>
                                </div>
                                @endif
                            @endif

                        </div>
                        <div class="card-footer">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger btn-block">Send</button>
                            </div>
                        </div>
                    </form>

                </div>
            @else
                <div class="alert alert-danger text-center d-flex align-items-center m-5" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                        aria-label="Danger:">
                        <use xlink:href="#exclamation-triangle-fill" />
                    </svg>
                    <div>
                        No Houre Sales
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@section('js')

<script>
    // Your web app's Firebase configuration
    // var firebaseConfig = {
    //     apiKey: "XXXXXXXXXXXXXXXXXXXXXXXXXX",
    //     authDomain: "XXXXXXX.firebaseapp.com",
    //     projectId: "XXXXXXXXXX",
    //     storageBucket: "XXXXXXXXXX.appspot.com",
    //     messagingSenderId: "XXXXXXXXXX",
    //     appId: "1:XXXXXXXXX:web:XXXXXXXXXXXXX"
    // };
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

            axios.post("{{ route('fcmToken') }}",{_method:"POST",token
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

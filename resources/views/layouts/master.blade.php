<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.head')
</head>

<body>
    @include('layouts.main_headerbar')
    <div class="wrap">
        <section class="container1x main">
            @yield('content')
            @isset($slot)
                {{ $slot }}
            @endisset
        </section>
    </div>
    @include('layouts.footer')
    @include('layouts.footer_scripts')
</body>

</html>

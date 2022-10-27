<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.head')
</head>

<body >
    {{-- <div class="wrapper"> --}}
        @include('layouts.main_headerbar')
        {{-- @include('layouts.main_sidebar') --}}

        {{-- <div class="content-wrapper"> --}}
            <!-- Main content -->


            <section class="container1x">
                @yield('content')
                @isset($slot)
                    {{ $slot }}
                @endisset
            </section>
            <!-- /.content -->
        {{-- </div> --}}


        @include('layouts.footer')

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    {{-- </div> --}}
    @include('layouts.footer_scripts')
</body>

</html>

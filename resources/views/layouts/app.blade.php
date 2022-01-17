<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ settings('site.title') }} | @yield('title')</title>
    <meta content="Pronova" name="author" />
    <!-- Scripts -->

    <!-- Font Awesome - load everything-->
    <script defer src="{{ asset('js/font-awesome/all.min.js') }}"></script>

    <!-- Fonts -->
    <link href="{{ asset('fonts/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Styles -->
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('custom_js_head')

    <style media="screen">
        .bg-gradient-primary {
            @switch(env('APP_ENV')) @case('local') background-color: rgb(109, 108, 108 ); @break @case('testing') background-color: rgb(38, 83, 212); @break @case('production')@if (env('APP_DEBUG') == true)background-color: rgb(255, 0, 0);
            @endif@break;
        @endswitch background-image: none;
    }
    </style>
    </head>

    <body>
        <div id="wrapper">
            @include('partials.menu')
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    @include('partials.topbar')
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @foreach (['danger', 'warning', 'success', 'info'] as $key)
                            @if (session()->has($key))
                                <div class="alert alert-{{ $key }} alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {!! session()->get($key) !!}
                                </div>
                            @endif
                        @endforeach
                        @yield('content')
                    </div>
                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; {{ settings('site.title') }} {{ date('Y') }}</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
                integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
                crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
        </script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
        <script src="{{ asset('js/principal.js') }}"></script>
        @yield('custom_js')
    </body>

    </html>

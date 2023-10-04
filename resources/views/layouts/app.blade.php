<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @include ('components.navbar')
    <main class="py-4">
        @if(session('status'))
        <div class="container">
            <div class="row mt-5">
                <div class="col-sm-12 col-md-8 offset-md-2">
                    <div class="alert alert-warning" role="alert">
                        {{session('status')}}
                    </div>
                </div>
            </div>
        </div>


        @endif
        @yield('content')
    </main>
    </div>
</body>

</html>
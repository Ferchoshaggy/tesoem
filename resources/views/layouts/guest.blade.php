<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background: #193333;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <link rel="icon" type="image/jpg" href="{{url('favicon.ico')}}"/>
        
    </head>
    <div id="particles-js"  style="width: 100%; height: 100vh; position: fixed; z-index: -1;"></div>
    <body class="font-sans antialiased" style="background-color: rgba(0, 0, 0, 0);">
        {{ $slot }}
    </body>
    <script src="js/particles.min.js"></script>
    <script src="js/particulass.js"></script>
</html>
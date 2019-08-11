<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Simple 1</title>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <div id="app">
            <div id="main-header" :style="`height: ${ headerHeight }px`">
                Hi
            </div>
            @yield('content')
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
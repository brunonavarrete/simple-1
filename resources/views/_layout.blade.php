<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Simple 1</title>

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="/css/app.css">
    </head>
    <body>
        <div id="app" :style="`padding-top: ${ headerHeight }px`">
            <main-header 
            :header-height="headerHeight"
            :employees="employees"></main-header>
            @yield('content')
            @include('.partials.modals')
        </div>
        <script type="text/javascript" src="/js/app.js"></script>
    </body>
</html>
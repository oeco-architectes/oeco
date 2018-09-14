<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Metadata --}}
        <title>{{ config('app.name') }}</title>

        {{-- Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        {{-- Site navigation --}}
        <nav>
            {!! $navigationMenu->asUl() !!}
        </nav>

        <main>
            @yield('content')
        </main>
    </body>
</html>
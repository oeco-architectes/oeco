<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        {{-- Metadata --}}
        <title>{{ config('app.name') }}</title>

        {{-- Styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        {{-- Site navigation --}}
        <nav class="oe-nav">
            <h1 class="oe-nav__logo">
                <a href="/">
                    <img src="/img/oeco-logo.svg" alt="{{ config('app.name') }}">
                </a>
            </h1>
            {!! $navigationMenu->asUl(['class' => 'oe-nav__menu']) !!}
        </nav>

        <main class="@yield('main-class')">
            @yield('content')
        </main>
    </body>
</html>

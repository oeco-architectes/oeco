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
        <div class="oe-container">
            {{-- Site navigation --}}
            <nav class="oe-nav oe-nav--primary">
                <h1 class="oe-nav__header">
                    <a href="/">
                        <img src="/img/oeco-logo.svg" alt="{{ config('app.name') }}">
                    </a>
                </h1>
                {!! $navigationMenu->asUl(['class' => 'oe-menu']) !!}
            </nav>

            <main
                @hasSection('main-class')
                    class="@yield('main-class')"
                @endif
            >
                @yield('main')
            </main>
        </div>
    </body>
</html>

@extends('layouts.html5')

@section('content')
    <article class="@yield('article-class')">
        @yield('article')
    </article

    <aside>
        @yield('aside')
    </aside>
@endsection

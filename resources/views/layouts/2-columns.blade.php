@extends('layouts.html5')

@section('main')
    <article
        @hasSection('article-class')
            class="@yield('article-class')"
        @endif
    >
        @yield('article')
    </article

    <aside>
        @yield('aside')
    </aside>
@endsection

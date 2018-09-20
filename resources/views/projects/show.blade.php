@extends('layouts.html5')

@section('main-class', 'oe-article')
@section('main')
    @foreach ($sections as $section)
        @if (gettype($section) === 'string')
            <div class="oe-article__section">
                {!! @Markdown::convertToHtml($section) !!}
            </div>
        @else
            @include('partials/image', [
                'class' => 'oe-article__section',
                'href' => $section->href,
                'width' => $section->width,
                'height' => $section->height,
                'title' => $section->title,
                'color' => $section->color,
            ])
        @endif
    @endforeach


    <nav class="oe-nav oe-nav--links oe-menu oe-menu__item">
        <a href="/projects">▸ Retour</a>
    </nav>
@endsection

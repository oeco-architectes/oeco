@extends('layouts.html5')

@section('main-class', 'oe-project')
@section('main')
    @foreach ($sections as $section)
        @if (gettype($section) === 'string')
            {!! @Markdown::convertToHtml($section) !!}
        @else
            @include('partials/image', [
                'href' => $section->href,
                'width' => $section->width,
                'height' => $section->height,
                'title' => $section->title,
                'color' => $section->color,
            ])
        @endif
    @endforeach
    <a href="/projects">Retour</a>
@endsection

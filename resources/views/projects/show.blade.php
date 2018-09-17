@extends('layouts.html5')

@section('main-class', 'oe-project')
@section('main')
    @foreach ($sections as $section)
        @if (gettype($section) === 'string')
            {!! @Markdown::convertToHtml($section) !!}
        @else
            <img
                src="{{ $section->href }}"
                width="{{ $section->width }}"
                height="{{ $section->height }}"
                alt="{{ $section->title }}"
            />
        @endif
    @endforeach
    <a href="/projects">Retour</a>
@endsection

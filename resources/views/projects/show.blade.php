@extends('layouts.html5')

@section('content')
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
@endsection

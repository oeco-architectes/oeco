@extends('layouts.html5')

@section('main')
    <ul>
        @foreach ($news as $n)
            <li>
                <figure>
                    <img
                        src="{{ $n->image->href }}"
                        width="{{ $n->image->width }}"
                        height="{{ $n->image->height }}"
                        alt="{{ $n->title }}"
                    />
                    <figcaption>
                        <h2>{{ $n->title }}</h2>
                        <p>{{ $n->headline }}</p>
                    </figcaption>
                </figure>
            </li>
        @endforeach
    </ul>
@endsection

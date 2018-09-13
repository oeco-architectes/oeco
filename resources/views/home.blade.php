@extends('layouts.html5')

@section('content')
    <ul class="oe-news">
        @foreach ($news as $n)
            <li>
                <figure>
                    <img
                        src="{{ $n->image->href }}"
                        width="{{ $n->image->width }}"
                        height="{{ $n->image->height }}"
                        alt="{{ $n->title }}"
                        class="oe-news__image"
                    />
                    <figcaption>
                        <h2 class="oe-news__title">{{ $n->title }}</h2>
                        <p class="oe-news__headline">{{ $n->headline }}</p>
                    </figcaption>
                </figure>
            </li>
        @endforeach
    </ul>
@endsection

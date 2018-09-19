@extends('layouts.html5')

@section('main')
    <ul>
        @foreach ($news as $n)
            <li>
                <figure>
                    @include('partials/image', [
                        'href' => $n->image->href,
                        'width' => $n->image->width,
                        'height' => $n->image->height,
                        'title' => $n->title,
                        'color' => $n->image->color,
                    ])
                    <figcaption>
                        <h2>{{ $n->title }}</h2>
                        <p>{{ $n->headline }}</p>
                    </figcaption>
                </figure>
            </li>
        @endforeach
    </ul>
@endsection

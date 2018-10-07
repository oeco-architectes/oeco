@extends('layouts.html5')

@section('main')
    <ul class="oe-carousel">
        @foreach ($news as $n)
            <li class="oe-carousel__item">
                <figure>
                    @include('partials/image', [
                        'class' => 'oe-carousel__image',
                        'image' => $n->image,
                        'title' => $n->title,
                        'color' => $n->color,
                    ])
                    <figcaption>
                        <h2 class="oe-carousel__title">{{ $n->title }}</h2>
                        <p class="oe-carousel__headline">{{ $n->headline }}</p>
                    </figcaption>
                </figure>
            </li>
        @endforeach
    </ul>
@endsection

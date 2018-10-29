@extends('layouts.html5')

@section('main')
    <carousel
        class="oe-carousel"
        role="list"
        :per-page="1"
        easing="ease-out"
        autoplay
        :autoplay-timeout="4000"
        autoplay-hover-pause
        loop
        pagination-enabled
        pagination-color="#e9e9e9"
        pagination-active-color="#999"
    >
        @foreach ($news as $n)
            <slide class="oe-carousel__item" role="listitem">
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
            </slide>
        @endforeach
    </ul>
@endsection

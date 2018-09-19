@extends('layouts.2-columns')

@section('aside')
    @include('agency.contact')
@endsection

@section('article-class', 'oe-article')
@section('article')
    <h2 class="oe-article__title">
        Prix & publications
    </h2>

    @include('partials/image', [
        'class' => 'oe-article__section',
        'href' => '/img/oeco-publications.jpg',
        'width' => 661,
        'height' => 437,
        'title' => 'Prix & publications d\'Œco Architectes',
        'color' => 'bcbdbd',
    ])

    <nav class="oe-nav oe-menu oe-menu__item">
        <a class="oe-menu__item" href="/agency">▸ Retour</a>
    </nav>
@endsection

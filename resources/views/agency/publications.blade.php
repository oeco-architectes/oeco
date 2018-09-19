@extends('layouts.2-columns')

@section('aside')
    @include('agency.contact')
@endsection

@section('article')
    <h2>
        Prix & publications
    </h2>

    @include('partials/image', [
        'href' => '/img/oeco-publications.jpg',
        'width' => 661,
        'height' => 437,
        'title' => 'Prix & publications d\'Œco Architectes',
        'color' => 'bcbdbd',
    ])

    <a href="/agency">Retour</a>
@endsection

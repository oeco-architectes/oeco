@extends('layouts.app')

@section('content')
  @if (count($news) > 0)
    <ol class="oeco-news">
      @foreach ($news as $aNews)
        <li class="oeco-news__item">
          <figure>
            <img class="oeco-news__item-picture" src="{{ $aNews->getImageUrl() }}">
            <figcaption>
              <h2 class="oeco-news__item-title">{{ $aNews->title }}</h2>
              @if ($aNews->hasSummary())
                <p class="oeco-news__item-summary">{{ $aNews->summary }}</p>
              @endif
            </figcaption>
          </figure>
        </li>
      @endforeach
    </ol>
  @endif
@endsection

@extends('layouts.html5')

@section('main')
    <nav class="oe-nav oe-nav--secondary">
        <ul class="oe-menu">
            @foreach ($categories as $category)
                <li class="oe-menu__item">
                    <a href="#category/{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <ul class="oe-mozaic">
        @foreach ($projects as $project)
            <li data-category="{{ $project->category->id }}" class="oe-mozaic__item oe-mozaic__item--{{ $project->tileType }}">
                <a href="/projects/{{ $project->category->id }}">
                    <figure>
                        @include('partials/image', [
                            'class' => 'oe-mozaic__image',
                            'title' => $project->title,
                            'image' => $project->image,
                            'responsiveImages' => $project->responsiveImages,
                            'color' => $project->color,
                        ])
                        <figcaption>
                            <h3 class="oe-mozaic__title">{{ $project->title }}</h3>
                        </figcaption>
                    </figure>
                </a>
            </li>
        @endforeach
    </ul>
@endsection

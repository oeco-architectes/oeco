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
            <li data-category="{{ $project->category->id }}" class="oe-mozaic__item">
                <a href="/projects/{{ $project->category->id }}">
                    <figure>
                        @include('partials/image', [
                            'class' => 'oe-mozaic__image',
                            'href' => $project->image->href,
                            'width' => $project->image->width,
                            'height' => $project->image->height,
                            'title' => $project->title,
                            'color' => $project->image->color,
                        ])
                        <figcaption>
                            <h2>{{ $project->title }}</h2>
                        </figcaption>
                    </figure>
                </a>
            </li>
        @endforeach
    </ul>
@endsection

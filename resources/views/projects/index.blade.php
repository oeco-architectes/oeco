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

    <ul>
        @foreach ($projects as $project)
            <li data-category="{{ $project->category->id }}">
                <a href="/projects/{{ $project->category->id }}">
                    <figure>
                        <img
                            src="{{ $project->image->href }}"
                            width="{{ $project->image->width }}"
                            height="{{ $project->image->height }}"
                            alt="{{ $project->title }}"
                        />
                        <figcaption>
                            <h2>{{ $project->title }}</h2>
                        </figcaption>
                    </figure>
                </a>
            </li>
        @endforeach
    </ul>
@endsection

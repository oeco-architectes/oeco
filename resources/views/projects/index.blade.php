@extends('layouts.html5')

@section('content')
    <nav class="oe-subnav">
        <ul>
            @foreach ($categories as $category)
                <li>
                    <a href="#category/{{ $category->id }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <ul class="oe-projects">
        @foreach ($projects as $project)
            <li data-category="{{ $project->category->id }}">
                <a href="/projects/{{ $project->category->id }}"
                    <figure>
                        <img
                            src="{{ $project->image->href }}"
                            width="{{ $project->image->width }}"
                            height="{{ $project->image->height }}"
                            alt="{{ $project->title }}"
                        />
                        <figcaption>
                            <h2 class="oe-projects__title">{{ $project->title }}</h2>
                        </figcaption>
                    </figure>
                </figure>
            </li>
        @endforeach
    </ul>
@endsection

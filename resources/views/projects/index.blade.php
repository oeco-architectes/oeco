@extends('layouts.html5')

@section('content')
    <nav>
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

    <ul>
        @foreach ($projects as $project)
            <li data-category="{{ $project->category->id }}">
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
            </li>
        @endforeach
    </ul>
@endsection

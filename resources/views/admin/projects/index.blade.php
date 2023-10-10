@extends('layouts.app')

@section('title', 'I miei progetti')

@section('content')

    <div class="text-center mt-5">
        <h1>I miei progetti personali</h1>
    </div>

    <div class="container mt-5">

        <div class="row">

            @foreach ($projects as $project)

                <div class="col-4">

                    <div class="card">

                        <img src="{{ $project->thumb }}" class="card-img-top" alt="...">

                        <div class="card-body">

                            <h5 class="card-title">{{ $project->title }}</h5>

                            <p class="card-text">{{ $project->description }}</p>

                        </div>

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">{{ $project->published_date }}</li>
                            <li class="list-group-item">{{ $project->language }}</li>

                        </ul>

                        <div class="card-body">

                            <button class="btn btn-primary"><a href="{{ route('admin.projects.show', $project->slug) }}">Guarda progetto</a></button>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

@endsection

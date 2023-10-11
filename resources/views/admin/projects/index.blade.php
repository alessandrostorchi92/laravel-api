@extends('layouts.app')

@section('title', 'I miei progetti personali')

@section('content')

    <div class="text-center mt-5">
        <h1>I miei progetti personali</h1>
    </div>

    <div class="container mt-5">

        <div class="row row-cols-3">

            @foreach ($projects as $project)

                <div class="col d-flex justify-content-center">

                    <div class="card text-center" style="width: 18rem;">

                        <img src="{{ $project->thumb }}" class="card-img-top" alt="...">

                        <div class="card-body">

                            <h5 class="card-title">{{ $project->title }}</h5>
                            <p class="card-text">{{ $project->description }}</p>

                        </div>

                        <ul class="list-group list-group-flush">

                            <li class="list-group-item">{{ $project->published_date }}</li>
                            <li class="list-group-item fs-3 text">{{ $project->language }}</li>

                        </ul>

                        <div class="card-body">

                            <button class="btn btn-outline-light"><a class="text-decoration-none" href="{{ route('admin.projects.show', $project->slug) }}"><i class="fa-regular fa-eye"></i></button>

                        </div>

                    </div>

                </div>

            @endforeach

            <div class="container mt-5 text-center">

                <button class="btn btn-danger btn-lg border-0 rounded-50">
                    <a class="text-decoration-none text-light fw-medium" href="{{ route('admin.projects.create') }}" class="btn btn-link">AGGIUNGI PROGETTO</a>
                </button>
    
            </div>

        </div>

    </div>

@endsection

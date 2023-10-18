@extends('layouts.app')

@section('title', 'Progetto ' . $project->title)

@section('content')

    <div class="container mt-5">

        <div class="row">

            <div class="col-12 d-flex  justify-content-center">

                <div class="card text-center w-25">

                    <img src="{{ $project->thumb }}" class="card-img-top" alt="...">

                    <div class="card-body">

                        <h5 class="card-title">{{ $project->title }}</h5>

                        <p class="card-text">{{ $project->description }}</p>

                    </div>

                    <ul class="list-group list-group-flush">

                        <li class="list-group-item"><span class="badge"
                                style="background-color: rgb({{ $project->type->colour }})">{{ $project->type->name }}</span>
                        </li>

                        <li class="list-group-item">

                            @foreach ($project->technologies as $technology)
                                <div class="badge" style="background-color: rgb({{ $technology->colour }})">
                                    {{ $technology->name }}</div>
                            @endforeach

                        </li>

                        <li class="list-group-item">{{ $project->published_date }}</li>
                        <li class="list-group-item">{{ $project?->language }}</li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="mt-5 d-flex justify-content-center">
            <button type="button" class="btn btn-secondary btn-lg border-0 rounded-50 fw-medium"><a
            class="text-decoration-none text-light" href="{{ route('admin.projects.index') }}">BACK</a></button>
        </div>

    </div>

@endsection

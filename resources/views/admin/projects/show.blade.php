@extends('layouts.app')

@section("title", "Progetto ". $project->title)

@section('content')

<div class="container mt-5">

    <div class="row">

        <div class="col-6">

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

    </div>

</div>

@endsection
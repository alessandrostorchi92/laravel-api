@extends('layouts.app')

@section('title', 'I miei progetti personali')

@section('content')

    <div class="text-center mt-5">
        <h1>I miei progetti personali</h1>
    </div>

    <div class="container mt-5">

        <div class="row row-cols-3 justify-content-center g-4">

            @foreach ($projects as $project)

                <div class="col">

                    <div class="cards-container h-100 d-flex">

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
    
                            <div class="card-body d-flex flex-column gap-2">
    
                                {{-- CTA Mostra dettagli  --}}
                                <button class="btn btn-outline-info"><a class="text-decoration-none fw-bold"
                                        href="{{ route('admin.projects.show', $project->slug) }}">MOSTRA DETTAGLI</a></button>
    
                                {{-- CTA Modifica progetto  --}}
                                <button class="btn btn-outline-warning"><a class="text-decoration-none fw-bold"
                                        href="{{ route('admin.projects.edit', $project->slug) }}">MODIFICA</a></button>
    
                                {{-- CTA Elimina progetto  --}}
                                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                                    @csrf()
                                    @method("DELETE")
    
                                    <button class="btn btn-outline-danger w-100"><a class="text-decoration-none fw-bold"
                                        href="{{ route('admin.projects.index', $project->slug) }}">CANCELLA</a></button>
    
                                </form>
    
                            </div>
    
                        </div>

                    </div>

                </div>

            @endforeach
 
        </div>
        
    </div>
    
    <div class="container mt-5 text-center">

        <button class="btn btn-danger btn-lg border-0 rounded-50">
            <a class="text-decoration-none text-light fw-medium" href="{{ route('admin.projects.create') }}"
                class="btn btn-link">AGGIUNGI PROGETTO</a>
        </button>

    </div>

@endsection

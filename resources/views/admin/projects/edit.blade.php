@extends('layouts.app')

@section('title', 'Modifica progetto')

@section('content')

    <h1 class="mt-5 text-center">Modifica i dati di questo progetto</h1>

    <div class="container mt-5">

        <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST">
            @csrf()
            @method("PUT")

            {{-- Title --}}

            <div class="mb-4">

                <label for="title" class="form-label fw-medium">Titolo</label><input type="text"
                    class="form-control @error('title') is-invalid @enderror" id="title"
                    placeholder="Inserisci il titolo del nuovo progetto" name="title" value="{{ old("title", $project->title) }}">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Description --}}

            <div class="mb-4">

                <label for="description" class="form-label fw-medium">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    placeholder="Inserisci la descrizione del nuovo progetto" name="description" value="{{ old("description", $project->description) }}"></textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Thumb --}}

            <div class="mb-4">

                <label for="thumb" class="form-label fw-medium">Copertina</label><input type="text"
                    id="thumb" class="form-control @error('thumb') is-invalid @enderror"
                    placeholder="Inserisci l'immagine di copertina del fumetto" name="thumb" value="{{ old("thumb", $project->thumb) }}">

                @error('thumb')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Link --}}

            <div class="mb-4">

                <label for="link" class="form-label">Link</label>
                <input type="text" id="link" name="link" class="form-control @error("link") is-invalid                            
                @enderror" value="{{old("link", $project->link)}}">

                @error("link")
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

            </div>

            {{-- Type  --}}

            <div class="mb-4">

                <label class="form-label">Tipologia</label>

                <select class="form-select @error('type') is-invalid @enderror" name="type_id">

                    {{-- L'attributo hidden nel select permette di rendere visibile e inattiva un'option allo scopo di fornire una consegna all'utente --}}

                    {{-- L'attributo selected assieme all'if ternario permette di salvare la selected selezionata  --}}

                    @foreach ($types as $type)

                        <option hidden>Seleziona la tipologia</option>
                        <option value="{{$type->id}}" {{ $project->type_id === $type->id ? 'selected' : '' }}>{{ $type->name }}</option>

                    @endforeach

                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </select>

            </div>

            {{-- Published_date --}}

            <div class="mb-4">
                <label for="date" class="form-label fw-medium">Data</label>
                <input type="date" id="date" name="published_date"
                    class="form-control @error('published_date') is-invalid @enderror" value="{{ old("published_date", $project->published_date) }}">
            </div>

            @error('published_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- Language  --}}

            <div class="mb-4">

                <label for="language" class="form-label">Languages</label>
                <input type="text" class="form-control @error("language") is-invalid                            
                @enderror" id="language" name="language" value="{{old("language", $project->language)}}" >

                @error("language")
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
                
            </div>

            {{-- Buttons container  --}}

            <div class="mt-5
                    d-flex justify-content-center gap-3">
                <button type="button" class="btn btn-secondary btn-lg border-0 rounded-50 fw-medium"><a
                        class="text-decoration-none text-light"
                        href="{{ route('admin.projects.index') }}">BACK</a></button>
                <button type="submit" class="btn btn-danger btn-lg border-0 rounded-50 fw-medium">AGGIORNA</button>
            </div>

        </form>

    </div>

@endsection

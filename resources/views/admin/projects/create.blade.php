@extends('layouts.app')

@section('title', 'Aggiungi nuovo progetto')

@section('content')

    <h1 class="mt-5 text-center">Inserisci i dati del nuovo Progetto</h1>

    <div class="container mt-5">

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf()

            {{-- Title --}}

            <div class="mb-4">

                <label for="title" class="form-label fw-medium">Titolo</label><input type="text"
                    class="form-control @error('title') is-invalid @enderror" id="title"
                    placeholder="Inserisci il titolo del nuovo progetto" name="title" value="{{ old('title') }}">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Description --}}

            <div class="mb-4">

                <label for="description" class="form-label fw-medium">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                    placeholder="Inserisci la descrizione del nuovo progetto" name="description" value="{{ old('description') }}"></textarea>

                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Thumb --}}

            <div class="mb-4">

                <label for="thumb" class="form-label fw-medium">Copertina</label><input type="text" id="thumb"
                    class="form-control @error('thumb') is-invalid @enderror"
                    placeholder="Inserisci l'immagine di copertina del fumetto" name="thumb" value="{{ old('thumb') }}">

                @error('thumb')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Link --}}

            <div class="mb-4">

                <label for="link" class="form-label fw-medium">Link</label>
                <input type="text" id="link" name="link"
                    class="form-control @error('link') is-invalid                            
                @enderror"
                    value="{{ old('link') }}">

                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Type  --}}

            <div class="mb-4">

                <label for="type_id" class="form-label">Tipologia</label>

                <select class="form-select @error('type_id') is-invalid @enderror" id="type_id" name="type_id">

                    {{-- L'attributo hidden nel select permette di rendere visibile e inattiva un'option allo scopo di fornire una consegna all'utente --}}

                    {{-- L'attributo selected assieme all'if ternario permette di salvare la selected selezionata  --}}

                    @foreach ($types as $type)
                        <option hidden>Seleziona la tipologia</option>
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach

                </select>
                
                @error('type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
            </div>

            {{-- Technologies  --}}

            <div class="mb-4">

                <div>
                    <label class="form-label fw-medium">Technologies</label>
                </div>

                @foreach ($technologies as $technology)

                    <div class="form-check form-check-inline @error('technologies[]') is-invalid @enderror"">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="technologies[]"
                            value="{{ $technology->id }}">
                        <label class="form-check-label" for="inlineCheckbox1">{{ $technology->name }}</label>
                    </div>

                @endforeach

                @error('technologies[]')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Published_date --}}

            <div class="mb-4">
                <label for="date" class="form-label fw-medium">Data</label>
                <input type="date" id="date" name="published_date"
                    class="form-control @error('published_date') is-invalid @enderror" value="{{ old('published_date') }}">
            </div>

            @error('published_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            {{-- Language  --}}

            <div class="mb-4">

                <label for="language" class="form-label fw-medium">Languages</label>
                <input type="text"
                    class="form-control @error('language') is-invalid                            
                @enderror"
                    id="language" name="language" value="{{ old('language') }}">

                @error('language')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>

            {{-- Buttons container  --}}

            <div class="mt-5
                    d-flex justify-content-center gap-3">
                <button type="button" class="btn btn-secondary btn-lg border-0 rounded-50 fw-medium"><a
                        class="text-decoration-none text-light"
                        href="{{ route('admin.projects.index') }}">BACK</a></button>
                <button type="submit" class="btn btn-danger btn-lg border-0 rounded-50 fw-medium">SUBMIT</button>
            </div>

        </form>

    </div>

@endsection

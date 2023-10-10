@extends('layouts.app')

@section('title', 'Aggiungi nuovo progetto')

@section('content')

<h1 class="mt-5 text-center">Inserisci i dati del nuovo Progetto</h1>

<div class="container mt-5">

    <form action="{{ route('admin.projects.store') }}" @method("POST")
        @csrf

        {{-- Title  --}}
        
        <div class="mb-4 fw-bold">

            <label class="form-label fw-bold">Titolo</label><input type="text"
                class="form-control @error('title') is-invalid @enderror"
                placeholder="Inserisci il titolo del nuovo progetto" name="title" value="{{ old('title') }}">

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Thumb 

        <div class="mb-4 fw-bold">

            <label class="form-label">Immagine</label><input type="file" accept="image/*"
                class="form-control" placeholder="Inserisci l'immagine di copertina del nuovo progetto" name="thumb" value="{{old("thumb")}}">

        </div>

        {{-- Description --}}

        <div class="mb-4">

            <label class="form-label fw-bold">Descrizione</label>
            <textarea class="form-control" placeholder="Inserisci la descrizione del nuovo progetto" name="description" value="{{old("description")}}"></textarea>

        </div>

        {{-- Link --}}

        <div class="mb-4 fw-bold">

            <label class="form-label">Link</label><input type="url"
                class="form-control @error('link') is-invalid @enderror"
                placeholder="Inserisci il link del nuovo progetto" name="link" value="{{old("link")}}">

            @error('link')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>

        {{-- Date --}}

        <div class="mb-4 fw-bold">

            <label class="form-label">Data</label><input type="date" class="form-control" name="published_date" value="{{old("published_date")}}">

        </div>

        {{-- Language --}}

        <div class="mb-4 fw-bold">

            <label class="form-label">Lingua</label>
            <input type="text" class="form-control" placeholder="Inserisci la lingua del nuovo progetto" name="language" value="{{old("language")}}">

        </div>

        <div class="text-center mt-5">
            <button type="button" class="btn btn-secondary btn-lg border-0 rounded-50"><a
                class="text-decoration-none text-light" href="{{ route('admin.projects.index') }}">BACK</a></button>
            <button type="submit" class="btn btn-danger btn-lg border-0 rounded-50">CREATE</button>
        </div> 

    </form>

</div>





@endsection
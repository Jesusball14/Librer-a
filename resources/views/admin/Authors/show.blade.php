@extends('layouts.app')

@section('title', 'Autores')

@section('content')

    <div id="content">
        @if ($author->image)
            <img src="{{ asset('storage/' . $author->image) }}" alt="{{ $author->title }}" width="100">
        @else
            Sin imagen
        @endif

        <h1>{{ $author->name . '  ' . $author->lastname }}</h1>
        <p><strong>Descripción:</strong> {{ $author->description }}</p>
        
        <br>

        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Volver</a>
    </div>

@endsection
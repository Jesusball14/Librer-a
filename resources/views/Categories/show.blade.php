@extends('layouts.app')

@section('title', 'Producto')

@section('content')

    <div id="content">
        <h1>{{ $category->name }}</h1>
        <p><strong>Descripción:</strong> {{ $category->description }}</p>
        <br>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Volver</a>
    </div>

@endsection
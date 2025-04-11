@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')

<div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('categories.index')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Agregar Categoría</h1>
    </div>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf <!--Directiva de Blade para proteger el formulario-->

        <div class="form-group">
            <label for="name"><p>Categoría</p></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre de la Categoría" value="{{ old('name') }}">
        </div>

        <br>

        <div class="form-group">
            <label for="description"><p>Descripción</p></label>
            <textarea name="description" id="description" class="form-control" placeholder="Descripción de la Categoría">{{ old('description') }}</textarea>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Agregar Categoría</button>
    </form>

</div>

@endsection
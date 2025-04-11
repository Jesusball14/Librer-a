@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

<div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('categories.index')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Editar Categoría</h1>
    </div>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT') <!--Método PUT es necesario para enviar el formulario-->

        <div class="form-group">
            <label for="name"><p>Categoría</p></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $category->name) }}">
        </div>

        <br>

        <div class="form-group">
            <label for="description"><p>Descripción</p></label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Editar Categoría</button>
    </form>

</div>

@endsection
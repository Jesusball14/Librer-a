@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')
<div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('authors.index')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Editar Autor</h1>
    </div>

    <form action="{{ route('authors.update', $author) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!--Método PUT es necesario para enviar el formulario-->

        <div class="form-group">
            <label for="image"><p>Imagen del Autor</p></label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" value="{{ old('image', $author->image)}}">
        </div>

        <div class="form-group">
            <label for="name"><p>Nombre</p></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $author->name) }}">
        </div>

        <br>

        <div class="form-group">
            <label for="lastname"><p>Apellido</p></label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="{{ old('lastname', $author->lastname) }}">
        </div>

        <br>

        <div class="form-group">
            <label for="description"><p>Descripción</p></label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $author->description) }}</textarea>
        </div>

        <br>

        
        <button type="submit" class="btn btn-primary">Editar Autor</button>
    </form>

</div>

@endsection
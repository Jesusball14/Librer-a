@extends('layouts.app')

@section('title', 'Agregar Autor')

@section('content')
  <div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('authors.index')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Agregar Autor</h1>
    </div>

    <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <!--Directiva de Blade para proteger el formulario-->

        <div class="form-group">
            <label for="image">Agrega una imagen del Autor</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="name"><p>Nombre</p></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Nombre del Autor" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="lastname"><p>Apellido</p></label>
            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Apellido del Autor" value="{{ old('lastname') }}">
        </div>

        <br>

        <div class="form-group">
            <label for="description"><p>Descripción</p></label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Descripción del autor">
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Agregar Autor</button>
    </form>

            
  </div>
@endsection
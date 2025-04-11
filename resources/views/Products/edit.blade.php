@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

<div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('products.index')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Editar Libro</h1>
    </div>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!--Método PUT es necesario para enviar el formulario-->

        <div class="form-group">
            <label for="image"><p>Imagen del Producto</p></label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" value="{{ old('image', $product->image)}}">
        </div>

        <div class="form-group">
            <label for="title"><p>Título</p></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $product->title) }}">
        </div>

        <br>

        <!-- Campo para seleccionar Autor con selector -->
        <div class="form-label col-12 col-md-6 mb-4">
            <label for="authors_id" class="form-label"><p>Autor</p></label>
            <select class="form-select @error('authors_id') is-invalid @enderror" 
                    id="authors_id" 
                    name="authors_id" required>
                <option value="" selected disabled>Seleccione un autor</option>
                @forelse($authors as $authors)
                    <option value="{{ $authors->id }}" 
                        @selected(old('authors_id') == $authors->id)>
                        {{ $authors->name }} {{ $authors->lastname }}
                    </option>
                @empty
                    <option value="" disabled>No hay autores disponibles</option>
                @endforelse
            </select>
            @error('authors_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div class="form-group">
            <label for="description"><p>Descripción</p></label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <br>

        <!-- Campo para seleccionar Categoría con selector -->
        <div class="form-label col-12 col-md-6 mb-4">
            <label for="category_id" class="form-label"><p>Categoría</p></label>
            <select class="form-select @error('category_id') is-invalid @enderror" 
                    id="category_id" 
                    name="category_id" required>
                <option value="" selected disabled>Seleccione un categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        

        <div class="form-group">
            <label for="stock"><p>Stock</p></label>
            <input type="number" name="stock" id="stock" class="form-control" required value="{{ old('stock', $product->stock) }}"> <!--Old sirve para que si hay un error en el formulario, no se pierda la información-->
        </div>

        <br>

        <div class="form-group">
            <label for="price"><p>Precio</p></label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required value="{{ old('price', $product->price) }}">
        </div>

        <br>
        
        <button type="submit" class="btn btn-primary">Editar Producto</button>
    </form>

</div>

@endsection
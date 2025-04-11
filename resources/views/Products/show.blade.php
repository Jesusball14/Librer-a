@extends('layouts.app')

@section('title', 'Producto')

@section('content')

    <div id="content">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}" 
                 class="card-img-top img-fluid" 
                 alt="{{ $product->title }}"
                 style="height: 400px; object-fit: cover;">
        @else
            <div class="bg-light d-flex align-items-center justify-content-center" 
                 style="height: 400px;">
                <i class="fas fa-book fa-3x text-muted"></i>
            </div>    
        @endif
        <br>
        <h1>{{ $product->title }}</h1><br>
        <p><strong>Autor:</strong> {{ $product->author_full_name }}</p><br>
        <p><strong>Descripción:</strong> {{ $product->description }}</p><br>
        <p><strong>Categoría:</strong> {{ $product->category_name }}</p><br>
        @if (Auth::check() && Auth::user()->user_type == 2)
            <p><strong>Stock:</strong> {{ $product->stock }}</p><br>
        @endif
        <p><strong>Precio:</strong> {{ $product->price }}</p> <br>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
    </div>

@endsection
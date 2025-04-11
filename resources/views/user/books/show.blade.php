@extends('layouts.app')

@section ('title', 'Libros')

@section ('content')

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
        <p><strong>Stock:</strong> {{ $product->stock }}</p><br>
        <p><strong>Precio:</strong> {{ $product->price }}</p> <br><br>

        {{-- @if (Auth::check())
            <div class="d-flex justify-content-beetwen align-items-center"></div>
                <a class="btn btn-primary " href="{{ route('products.purchase', $product) }}">Comprar</a>
                <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Volver</a>
            </div>
        @else
            <div class="d-flex justify-content-beetwen align-items-center"></div>
                <button class="btn btn-primary" disabled title="Inicia sesión para comprar">
                    Comprar
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Volver</a>
                <small class="text-muted d-block mt-1"><p>Inicia sesión para realizar compras</p></small>
            </div>


            
        @endif --}}

        @if($product->stock > 0)
            @auth
                <a href="{{ route('products.purchase', $product) }}" class="btn btn-primary">
                    Comprar ({{ $product->stock }} disponibles)
                </a>
                <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Volver</a>
            @else
                <button class="btn btn-primary" disabled>
                    Comprar ({{ $product->stock }} disponibles)
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Volver</a>
                <small class="text-muted d-block"><p>Inicia sesión para comprar</p></small>
            @endauth
        @else
            <button class="btn btn-secondary" disabled>
                Agotado
            </button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Volver</a>
            <small class="text-muted d-block">Próximamente disponible</small>
        @endif

        
    </div>

@endsection
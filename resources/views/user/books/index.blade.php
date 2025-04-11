@extends('Layouts.app')

@section('title', 'Libros')

@section('content')

<div id="content">

    
    <a href="{{ route('home') }}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        
    <!-- Barra de búsqueda -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <form action="{{ route('books.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Buscar libros por nombre..." 
                           value="{{ $search ?? '' }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Mensaje cuando no hay resultados -->
    @if($products->isEmpty())
        <div class="alert alert-info text-center">
            No se encontraron libros @if($search)para "{{ $search }}"@endif
        </div>
    @endif

     <!-- Listado de libros -->
     <div class="row">
        @foreach($products as $product)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="row g-0 h-100">
                    <!-- Imagen del libro -->
                    <div class="col-md-4">
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 class="img-fluid rounded-start h-100" 
                                 alt="{{ $product->title }}"
                                 style="object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                <i class="fas fa-book fa-3x text-muted"></i>
                            </div>
                        @endif
                    </div>
                    <!-- Detalles del libro -->
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column h-100">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="card-text text-muted">
                                <small>Autor: {{ $product->author_full_name }}</small>
                            </p>
                            <p class="card-text">{{ Str::limit($product->description, 150) }}</p>
                            
                            <div class="mt-auto">
                                <p class="card-text">
                                    <span class="badge bg-primary">
                                        ${{ number_format($product->price, 2) }}
                                    </span>
                                </p>
                                <a href="{{ route('books.show', $product) }}" class="btn btn-sm btn-outline-primary">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
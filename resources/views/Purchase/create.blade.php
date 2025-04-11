@extends('layouts.app')

@section('title', 'Realizar Compra')

@section('content')

<div id="content">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Comprar Libro</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
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
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $product->title }}</h3>
                            <p class="text-muted">Autor: {{ $product->author_full_name }}</p> <br>
                            <p>{{ $product->description }}</p>
                            <h5 class="text-success">Precio: ${{ number_format($product->price, 2) }}</h5>
                            <p class="@if($product->stock > 0) text-success @else text-danger @endif">
                                Stock: {{ $product->stock > 0 ? $product->stock . ' disponibles' : 'Agotado' }}
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('cart.add', $product) }}">
                        @csrf
                        <div class="form-group">
                            <label for="quantity">Cantidad:</label>
                            <input type="number" id="quantity" name="quantity" 
                                   class="form-control @error('quantity') is-invalid @enderror" 
                                   value="1" min="1" max="10">
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-shopping-cart"></i> Confirmar Compra
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-block">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')

<div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('home')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1><center>Mi Carrito</center></h1>
    </div>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        @if($cartItems->isEmpty())
            <div class="alert alert-info">
                Tu carrito está vacío.
            </div>
            <a href="{{ route('home') }}" class="btn btn-primary">Seguir comprando</a>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio Unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" 
                                             class="img-thumbnail mr-3" 
                                             style="width: 50px; height: 70px; object-fit: cover;" 
                                             alt="{{ $item->product->title }}">
                                    @endif
                                    <div>
                                        <h6 class="mb-0">{{ $item->product->title }}</h6>
                                        <small class="text-muted">{{ $item->product->author_full_name }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="d-flex">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" 
                                           min="1" max="10" class="form-control form-control-sm" style="width: 60px;">
                                    <button type="submit" class="btn btn-sm btn-primary ml-2">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Total:</strong></td>
                            <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                        </tr>
                    </tfoot>
                    @if($item->quantity > $item->product->stock)
                        <div class="alert alert-warning mt-2">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Solo quedan {{ $item->product->stock }} unidades disponibles
                        </div>
                    @endif
                </table>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Seguir comprando
                </a>
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary">
                    Proceder al pago <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</div>

@endsection
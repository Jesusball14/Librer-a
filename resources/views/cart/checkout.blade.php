@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')

<div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('cart.index') }}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1><center>Finalizar Compra</center></h1>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Resumen de la Compra</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
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
                                        <td>{{ $item->quantity }}</td>
                                        <td>${{ number_format($item->product->price, 2) }}</td>
                                        <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                        <td><strong>${{ number_format($total, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Confirmar Compra</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cart.process-checkout') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="payment_method">Método de Pago</label>
                                <select class="form-control" id="payment_method" name="payment_method" required>
                                    <option value="">Seleccione un método</option>
                                    <option value="credit_card">Tarjeta de Crédito</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Transferencia Bancaria</option>
                                </select>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fas fa-check-circle"></i> Confirmar y Pagar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
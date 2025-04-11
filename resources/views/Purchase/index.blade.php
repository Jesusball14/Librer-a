@extends('layouts.app')

@section('title', 'Realizar Compra')

@section('content')

<div id="content">
    <div class="d-flex justify-content-start align-items-center">
        <a href="{{ route('home')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
        <h1> <center>Mis Compras</center></h1>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                    </div>
                @endif
    
                @if($purchases->isEmpty())
                    <div class="alert alert-info">
                        Aún no has realizado ninguna compra.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Libro</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($purchase->product->image)
                                                <img src="{{ asset('storage/' . $purchase->product->image) }}" 
                                                     class="img-thumbnail mr-3" 
                                                     style="width: 50px; height: 70px; object-fit: cover;" 
                                                     alt="{{ $purchase->product->title }}">
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $purchase->product->title }}</h6>
                                                <small class="text-muted">{{ $purchase->product->author_full_name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>${{ number_format($purchase->product->price, 2) }}</td>
                                    <td>${{ number_format($purchase->total_price, 2) }}</td>
                                    <td>{{ $purchase->created_at->format('d/m/Y H:i') }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @if($purchases->count() > 0)
                        <div class="d-flex justify-content-center mt-4">
                            {{ $purchases->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>

</div>

@endsection
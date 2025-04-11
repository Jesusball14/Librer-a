@extends('Layouts.app')

@section('title', 'Librería')

@section('content')


    <div class="container">

        {{-- <div id="content">
            <div class="row">
                <div class="col-lg-12">
                    <h1><center>Buscar por:</center></h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-5">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <a href="#" class="btn">
                                <h1 class="card-title">Autor</h1>
                            </a>
                        </center>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <div class="card">
                    <div class="card-body">
                        <center>
                            <a href="#" class="btn">
                                <h1 class="card-title">Categoría</h1>
                            </a>
                        </center>
                    </div>
                </div>
            </div>
        </div> --}}


        <div id="content">

            <h1><center>Libros más Vendidos</center></h1>
        </div>

        <div class="row">
            @foreach($topProducts as $product)
                <div class="col-6 col-md-3 col-sm-6 col-xm-6 mb-4 d-flex">
                    <div class="card w-100">
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
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->title }}</h5>
                            <p class="text-success">Vendidos: {{ $product->total_sold ?? ($product->totalSold->first()->total ?? 0) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('books.show', $product) }}" 
                                   class="btn btn-primary w-100">Ver</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        
              
          
    </div>

@endsection
@extends('layouts.app')

@section('title', 'Productos')

@section('content')

  <div id="content">
    
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-start align-items-center">
            <a href="{{ route('home')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
            <h1>Lista de Productos</h1>
        </div>
        <a href="{{ route('products.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>  Agregar Libro</a>
    </div>

    <table id="table" class="table mt-3 table-striped table-bordered table-responsive table-light"> 
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio</th>
                <th><center>Acciones</center></th>
            </tr>
        </thead>

        <tbody class="table-group-divider">
            @foreach ($products as $product)
                <tr>
                    <td>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}" width="100">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->author_full_name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.show', $product) }}" class="btn btn-info me-1"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                            {{-- <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-1"><i class="fa-solid fa-trash"></i></button>
                            </form> --}}
                            <button class="btn btn-danger me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmDeleteModal"
                                    data-id="{{ $product->id }}"
                                    data-title="{{ $product->title }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro que deseas eliminar este producto? Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    

  </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteModal = document.getElementById('confirmDeleteModal');
        const deleteForm = document.getElementById('deleteForm');
        const modalTitle = deleteModal.querySelector('.modal-title');
        const modalBody = deleteModal.querySelector('.modal-body');
        
        // Configurar el modal cuando se hace clic en eliminar
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Botón que activó el modal
            const productId = button.getAttribute('data-id');
            const productTitle = button.getAttribute('data-title');
            
            // Actualizar el contenido del modal
            modalTitle.textContent = `Eliminar Producto: ${productTitle}`;
            modalBody.innerHTML = `¿Estás seguro que deseas eliminar el producto <strong>${productTitle}</strong>? Esta acción no se puede deshacer.`;
            
            // Configurar la acción del formulario con la ruta correcta
            document.getElementById('deleteForm').action = "{{ route('products.destroy', ':id') }}".replace(':id', productId);
        });
        
        // Opcional: Mostrar mensaje de éxito después de eliminar
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
    });
  </script>
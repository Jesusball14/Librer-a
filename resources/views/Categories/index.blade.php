@extends('layouts.app')
    
@section('title', 'Categorías')

@section('content')

<div id="content">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex justify-content-start align-items-center">
            <a href="{{ route('home')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
            <h1>Lista de Categorías</h1> <br>
        </div>
        <a href="{{ route('categories.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>  Agregar Categoría</a>
    </div>

    <div class="row mt-3">
        <div class="col">
            <table class="table mt-3 table-striped table-bordered table-responsive table-light">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th><center>Acciones</center></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-warning me-1" href="{{ route('categories.edit', $category) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button class="btn btn-danger me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#confirmDeleteModal"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Enlaces de paginación -->
            <div class="mt-3 d-flex justify-content-end">
                {{ $categories->links() }}
            </div>
            
        </div>
    </div>

                    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro que deseas eliminar esta categoría? Esta acción no se puede deshacer.</p>
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
            const categoryId = button.getAttribute('data-id');
            const categoryName = button.getAttribute('data-name');
            
            // Actualizar el contenido del modal
            modalTitle.textContent = `Eliminar Categoría: ${categoryName}`;
            modalBody.innerHTML = `¿Estás seguro que deseas eliminar la categoría <strong>${categoryName}</strong>? Esta acción no se puede deshacer.`;
            
            // Configurar la acción del formulario con la ruta correcta
            document.getElementById('deleteForm').action = "{{ route('categories.destroy', ':id') }}".replace(':id', categoryId);
        });
        
        // Opcional: Mostrar mensaje de éxito después de eliminar
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
    });
</script>
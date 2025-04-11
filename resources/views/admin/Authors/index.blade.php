@extends('layouts.app')

@section('title', 'Autores')

@section('content')
    <div id="content">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex justify-content-start align-items-center">
                <a href="{{ route('home')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
                <h1>Lista de Autores</h1>
            </div>
            <a href="{{ route('authors.create')}}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>  Agregar Autor</a>
        </div>

        <table id="table" class="table mt-3 table-striped table-bordered table-responsive table-light"> 
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Descripción</th>
                    <th><center>Acciones</center></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($authors as $author)
                <tr>
                    <td>
                        @if ($author->image)
                            <img src="{{ asset('storage/' . $author->image) }}" alt="{{ $author->title }}" width="100">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->lastname }}</td>
                    <td>{{ $author->description }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('authors.show', $author) }}" class="btn btn-info me-1"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning me-1"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button class="btn btn-danger me-1" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#confirmDeleteModal"
                                    data-id="{{ $author->id }}"
                                    data-name="{{ $author->name }} {{ $author->lastname }}">
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
                    <p>¿Estás seguro que deseas eliminar este autor? Esta acción no se puede deshacer.</p>
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
            const authorId = button.getAttribute('data-id');
            const authorName = button.getAttribute('data-name');
            
            // Actualizar el contenido del modal
            modalTitle.textContent = `Eliminar Autor: ${authorName}`;
            modalBody.innerHTML = `¿Estás seguro que deseas eliminar el autor <strong>${authorName}</strong>? Esta acción no se puede deshacer.`;
            
            // Configurar la acción del formulario con la ruta correcta
            document.getElementById('deleteForm').action = "{{ route('authors.destroy', ':id') }}".replace(':id', authorId);
        });
        
        // Opcional: Mostrar mensaje de éxito después de eliminar
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif
    });
</script>
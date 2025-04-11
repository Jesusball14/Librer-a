<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'Librería')</title>

    <link rel="icon" href="{{ asset('img/libros.png')}}">

    {{-- Enlace DataTable --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.min.css')}}"/>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
    
    <header>

        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
                @if (Auth::check() && Auth::user()->user_type == 2)
                    <button id="sidebarToggle" class="btn btn-dark">☰</button>
                @endif
              <a class="navbar-brand" href="{{ route('home')}}">
                <h4 class="ms-2">Librería</h4>
              </a>

              <a class="navbar-brand ms-4" aria-current="page" href="{{ route('books.index')}}">Buscar Libros</a>

              <ul class="navbar-nav ms-auto">
                
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i>
                            @if(auth()->user()->cartItems()->count() > 0)
                                <span class="badge badge-pill badge-danger">
                                    {{ auth()->user()->cartItems()->count() }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <strong>{{ Auth::user()->email}}</strong>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configuración</a></li> --}}

                            @if (Auth::check() && Auth::user()->user_type == 1)
                                <li><a class="dropdown-item" href="{{ route('purchases.index')}}">Mis Compras</a></li>
                            @endif

                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <!-- Si el usuario no está autenticado, mostrar "Iniciar Sesión" -->
                    <li class="nav-item d-flex justify-content-end align-items-center">
                        <a class="nav-link btn btn-primary me-2" href="{{ route('login') }}">Iniciar Sesión</a>
                        <a class="nav-link btn btn-secondary" href="{{ route('register')}}">Registrarse</a>
                    </li>
                @endauth
              </ul>

              
              
            </div>
          </nav>

        <!-- Contenedor principal -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @if (Auth::check() && Auth::user()->user_type == 2)
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home')}}">
                                <i class="fas fa-home"></i>
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index')}}">
                                <i class="fas fa-book"></i>
                                Libros
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('authors.index')}}">
                                <i class="fa-solid fa-user-tie"></i>
                                Autores
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categories.index')}}">
                                <i class="fa-solid fa-filter"></i>
                                Categorías
                            </a>
                        </li>
                        
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-sack-dollar"></i>
                                Compras
                            </a>
                        </li> --}}

                        

                    </ul>
                </div>
            </nav>
            @endif

          <main class="main-content">

            <div class="container">
              @yield('content')
            </div>

          </main>

          </header>

        </div>
    </div>
    

    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    
    
    {{-- Jquery requerido por DataTable --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS combinado -->
    <script type="text/javascript" src="{{ asset('js/datatables.min.js')}}"></script>
    <!-- Apexcharts -->
    <script src="{{ asset('js/apexcharts.js') }}"></script>
    @stack('scripts') <!-- Para gráficas específicas en otras vistas -->

    
    {{-- Script DataTable --}}
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                // paging: false, //Desactiva paginación
                dom: 'Bfrtip', // Define la posición de los botones
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa-solid fa-file-pdf"></i>',
                        className: 'btn btn-danger',
                        exportOptions: {
                            columns: ':not(:last-child)' //excluye la última columna
                        }
                    },

                    {
                        extend: 'print',
                        text: '<i class="fa-solid fa-print"></i>',
                        className: 'btn btn-secondary',
                        exportOptions: {
                            
                            columns: ':not(:last-child)' //excluye la última columna
                        }
                    },

                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa-solid fa-file-excel"></i>',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: ':not(:last-child)' //excluye la última columna
                        }
                    },
                     // Botones de exportación
                ],
                language: {
                    url: null, // Español
                    search: 'Buscar:',
                    searchPlaceholder: 'Ingrese un término...'
                }
            });
        });
    </script>

    

    {{-- Script para sidebar  --}}
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const sidebar = document.getElementById('sidebar');
          const sidebarToggle = document.getElementById('sidebarToggle');

          sidebarToggle.addEventListener('click', function() {
              sidebar.classList.toggle('active');
              sidebarToggle.classList.toggle('active');

              if (sidebarToggle.classList.contains('active')) {
                  sidebarToggle.innerHTML = '✕';
              } else {
                  sidebarToggle.innerHTML = '☰';
              }
          });

          document.addEventListener('click', function(event) {
              const isClickInsideSidebar = sidebar.contains(event.target);
              const isClickInsideSidebarToggle = sidebarToggle.contains(event.target);

              if (!isClickInsideSidebar && !isClickInsideSidebarToggle) {
                  sidebar.classList.remove('active');
                  sidebarToggle.classList.remove('active');
                  sidebarToggle.innerHTML = '☰';
              }
          });
      });
  </script>

  
    


</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'Librería')</title>

    <link rel="icon" href="{{ asset('img/libros.png')}}">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}"> <!--Bootstrap-->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css')}}"> <!--Iconos-->
    <link rel="stylesheet" href="{{ asset('css/app.css')}}"> <!--Estilos-->
</head>
<body>
    
    <header>

        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" data-bs-theme="dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <h4 class="ms-2">Librería</h4>
              </a>

            </div>
        </nav>

        <main class="main-content">

            <div class="container">
              @yield('content')
            </div>

        </main>

    </header>

    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
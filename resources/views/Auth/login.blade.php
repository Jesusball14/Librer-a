@extends('Layouts.app-login')

@section('title', 'Iniciar Sesión')

@section('content')

<form action="{{ route('login')}}" method="POST">
    @csrf

    <div class="col-lg-4 offset-lg-4">

        @if ($errors->any())

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        
        @endif

        <div id="content-login">
            
            <div class="d-flex justify-content-start align-items-start">
                <a href="{{ route('home')}}" class="btn btn-secondary me-3"><i class="fa-solid fa-arrow-left"></i></a>
                <h1>Iniciar Sesión</h1>
            </div>

            <div class="form-group">
                <label for="email"><p>E-mail</p></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" value="{{ old('email') }}"> <!--Old sirve para que si hay un error en el formulario, no se pierda la información-->
            </div>
    
            <br>
    
            <div class="form-group">
                <label for="password"><p>Contraseña</p></label>
                <input type="password" name="password" id="password" class="form-control mb-2" placeholder="Contraseña" required>
                
                {{-- <p>¿Te olvidaste de tu contraseña? <a href="#">Recupérala</a></p>                 --}}
    
                <button type="submit" class="btn btn-primary" id="btn-login">Iniciar Sesión</button>
                <p>O crea una cuenta <a href="{{ route('register')}}">Aquí</a></p>

                


            </div>
        </div>
    </div>

    <br>

    

</form>

@endsection
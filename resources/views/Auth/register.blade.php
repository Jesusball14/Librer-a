@extends('Layouts.app-login')

@section('title', 'Iniciar Sesión')

@section('content')

<form action="{{ route('register')}}" method="POST">
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
                <h1>Registrarse</h1>
            </div>

            <div class="form-group">
                <label for="name"><p>Nombre y Apellido</p></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}"> <!--Old sirve para que si hay un error en el formulario, no se pierda la información-->
            </div>

            <div class="form-group">
                <label for="email"><p>E-mail</p></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" value="{{ old('email') }}"> <!--Old sirve para que si hay un error en el formulario, no se pierda la información-->
            </div>

            <br>
    
            <div class="form-group">
                <label for="password"><p>Contraseña</p></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
            </div>

            <br>

            <div class="form-group">
                <label for="password_confirmation"><p>Confirme la Contraseña</p></label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirme la Contraseña" required>
                
                <button type="submit" class="btn btn-primary" id="btn-login">Registrarse</button>

                <p>¿Ya tienes una cuenta? <a href="{{ route('login')}}">Inicia Sesión</a></p>
            </div>

        </div>
    </div>

    <br>

    

</form>

@endsection
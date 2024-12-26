@extends('home')

@section('title', 'Iniciar Sesión')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@section('content')
    <div class="login-container">
        <h3 class="text-center mb-4 text-primary">Iniciar sesión</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Ingresa tu usuario" required>
                @error('username')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                        <i class="bi bi-eye-slash"></i>
                    </button>
                </div>
                @error('password')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3 text-center">
                <a href="#" class="text-primary">¿Has olvidado tu contraseña?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>
        <div class="text-center mt-3">
            <p>¿Aún no tienes una cuenta? <a href="#" class="text-primary">Regístrate Aquí</a></p>
        </div>
    </div>
@endsection
    
@push('scripts')
    <script src="{{ asset('js/login.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
@endpush

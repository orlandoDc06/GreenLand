@extends('layouts.app')

@section('title', 'Iniciar Sesión - GreenLand Residencial')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endpush

@section('content')
<section class="login-section min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-card">
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <img src="{{ asset('images/GREEN LAND COLOR.png') }}" alt="Logo GreenLand" style="height: 100px; width: auto;">
                        </div>
                        <h3 class="mb-0" style="color: #18332c;">Bienvenido a Green Land</h3>
                        <p class="text-muted mt-2">Inicia sesión para continuar</p>
                    </div>
                    
                    <div class="card-body px-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="username" class="form-label">Usuario</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-person text-muted me-2"></i>
                                    </span>
                                    <input type="text" id="name" name="name" class="form-control border-start-0 ps-0" placeholder="Ingresa tu usuario" required>
                                </div>
                                @error('username')
                                    <div class="text-danger mt-2 small">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group password-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-lock text-muted me-2"></i>
                                    </span>
                                    <input type="password" id="password" name="password" class="form-control border-start-0 ps-0" placeholder="Contraseña" required>
                                    <button type="button" class="btn btn-light" id="togglePassword">
                                        <i class="bi bi-eye-slash"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="text-danger mt-2 small">
                                        <i class="bi bi-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                        <label class="form-check-label" for="remember">Recordarme</label>
                                    </div>
                                    <!-- <a href="#" class="text-decoration-none small" style="color: #003D2B;">¿Olvidaste tu contraseña?</a> -->
                                </div>
                            </div>
                            
                            <button type="submit" class="btn w-100 mb-3 py-2" style="background-color: #18332c; color: white;">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar sesión
                            </button>
                        </form>
                    </div>
                    
                    <!-- <div class="card-footer text-center py-3">
                        <p class="mb-0">¿Aún no tienes una cuenta? 
                            <a href="{{ route('register') }}" class="text-decoration-none" style="color: #003D2B;">
                                Regístrate Aquí
                            </a>
                        </p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('js/login.js') }}"></script>
@endpush
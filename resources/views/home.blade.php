<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <title>@yield('title', 'Inicio')</title> 
    @stack('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container">
              <a class="navbar-brand" href="#">
                <img src="logo.png" alt=""> 
                GreenLand
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="#">NOSOTROS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">BENEFICIOS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('edit') }}">EDITAR</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('mapa') }}">MAPA</a>
                  </li>
                  <li class="nav-item">
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">LOGIN</a>
                    @endguest
                </li>
                <li class="nav-item">
                    @guest
                        <a class="nav-link" href="#">REGISTRARSE</a>
                    @endguest
                </li>
                <li class="nav-item">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link" style="background:none; border:none;">SALIR</button>
                        </form>
                    @endauth
                </li>
                <li class="nav-item">
                    @auth
                        <span class="nav-link">{{ auth()->user()->name }}</span>
                    @endauth
                </li>
                            
                </ul>
              </div>
            </div>
          </nav>
    </header>

    <main>
        @yield('content') 
    </main>

    <footer>
        <p class="text-center py-3">© 2024 GreenLand. Todos los derechos reservados.</p>
    </footer>
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'GreenLand - Residencial Ecológico')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/GREEN LAND LOGO COLOR.png') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <!-- Meta tags para SEO -->
    <meta name="description" content="Residencial GreenLand. Comunidad residencial en Morazan Sur, El Salvador.">
    <meta name="keywords" content="residencial, naturaleza, casas, Morazan, El Salvador, verde">
    <meta name="author" content="GreenLand Residencial">

    @stack('styles')
</head>

<body>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg fixed-top" style="background: rgba(0, 61, 43, 0.08) !important;">
            <div class="container">
                <!-- Brand -->

                <a class="navbar-brand" href="{{ route('home') }}">
                    @if(file_exists(public_path('images/GREEN LAND LOGO COLOR.png')))
                    <img src="{{ asset('images/GREEN LAND LOGO COLOR.png') }}" alt="GreenLand Logo" style="height: 40px; width: auto;">
                    @else
                    <i class="bi bi-tree-fill me-2" style="color: #A7956B;"></i>
                    <span style="color: #be9c64;">GreenLand</span>
                    @endif
                </a>

                <!-- Mobile toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Menu -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#inicio">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#nosotros">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#servicios">Servicios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#mapa">Ubicación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('maps') }}">Mapa</a>
                        </li>
                        @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if(auth()->user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('edit') }}">Editar</a>
                                </li>
                                <li class="nav-item">
                                    <hr class="dropdown-divider">
                                </li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success ms-2" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="{{ Request::is('/') ? '' : 'internal' }}">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer style="background: #1a1a1a; color: #fff; padding: 3rem 0 1.5rem 0;">
        <div class="container">
            <div class="row gy-4 align-items-start">
                <!-- Logo y descripción -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="d-flex align-items-center mb-3">
                        @if(file_exists(public_path('images/GREEN LAND LOGO COLOR.png')))
                        <img src="{{ asset('images/GREEN LAND LOGO COLOR.png') }}" alt="GreenLand Logo" height="48" class="me-2">
                        @else
                        <i class="bi bi-tree-fill me-2" style="font-size: 1.7rem; color: #BE9C64;"></i>
                        @endif
                        <h5 class="mb-0" style="color: #BE9C64; font-weight: 800; letter-spacing: 1px;">Green Land</h5>
                    </div>
                    <p class="opacity-75 mb-3" style="color: #e0f7f3;">
                        Residencial donde la naturaleza y el confort se encuentran para crear tu hogar ideal en Morazán.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="hover-opacity-100" style="color: #BE9C64; font-size: 1.4rem;"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="hover-opacity-100" style="color: #BE9C64; font-size: 1.4rem;"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="hover-opacity-100" style="color: #BE9C64; font-size: 1.4rem;"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Contacto -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5 class="mb-4" style="color: #BE9C64;">Contacto</h5>
                    <ul class="list-unstyled ps-1">
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="background:rgba(190,156,100,0.12); width:36px; height:36px;"><i class="bi bi-geo-alt-fill" style="color: #BE9C64; font-size:1.3rem;"></i></span>
                            <span class="lh-sm">Morazán Sur, El Salvador</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="background:rgba(190,156,100,0.12); width:36px; height:36px;"><i class="bi bi-telephone-fill" style="color: #BE9C64; font-size:1.3rem;"></i></span>
                            <span class="lh-sm">+503 1111-1111</span>
                        </li>
                        <li class="mb-3 d-flex align-items-start gap-2">
                            <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="background:rgba(190,156,100,0.12); width:36px; height:36px;"><i class="bi bi-envelope-fill" style="color: #BE9C64; font-size:1.3rem;"></i></span>
                            <span class="lh-sm">greenlandsv2023@gmail.com</span>
                        </li>
                    </ul>
                </div>

                <!-- Sección de suscripción -->
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5 class="mb-4" style="color: #BE9C64;">¿Quieres mas información?</h5>
                    <p class="text-light mb-4" style="font-size: 0.95rem;">Mantente informado sobre las últimas noticias y ofertas de GreenLand Residencial.</p>
                    <form class="newsletter-form">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Tu correo electrónico" required>
                            <button class="btn" type="submit">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">

            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0 opacity-75">© {{ now()->year }} GreenLand Residencial. Todos los derechos reservados.</p>
                </div>
                <!-- <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-decoration-none me-3 hover-opacity-100" style="color: #BE9C64;">Política de Privacidad</a>
                <a href="#" class="text-decoration-none hover-opacity-100" style="color: #BE9C64;">Términos de Servicio</a>
            </div> -->
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 800) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Active nav link
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');
        const sections = document.querySelectorAll('section[id]');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (window.pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
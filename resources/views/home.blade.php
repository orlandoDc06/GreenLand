@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/scrollGaleria.css') }}">
@section('title', 'Green Land - Residencial')

@section('content')
<!-- Inicio -->
<section id="inicio" class="hero position-relative" style="height: 100vh; overflow: hidden;">
    <!-- Carousel de fondo -->
    <div id="backgroundCarousel" class="carousel slide carousel-fade position-absolute w-100 h-100" data-bs-ride="carousel" data-bs-interval="9000">
        <div class="carousel-inner h-100">
            <div class="carousel-item active h-100">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/renders/7.jpg') }}');"></div>
            </div>
            <div class="carousel-item h-100">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/renders/11.jpg') }}');"></div>
            </div>
            <div class="carousel-item h-100">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/renders/13.jpg') }}');"></div>
            </div>
            <div class="carousel-item h-100">
                <div class="carousel-bg" style="background-image: url('{{ asset('images/renders/15.jpg') }}');"></div>
            </div>
        </div>
    </div>

    <!-- blur -->
    <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100" style="background: rgba(56, 83, 75, 0.35); backdrop-filter: blur(5px); z-index: 1;"></div>

    <!-- Contenido encima -->
    <div class="container position-relative text-white h-100 d-flex align-items-center justify-content-center" style="z-index: 2;">
        <div class="text-center">
            <div class="animate-fade-up">
                <div class="mb-4">
                    <img src="{{ asset('images/GREEN LAND COLOR.png') }}" alt="GreenLand Logo" style="height: 240px; width: auto;">
                </div>
                <h2 class="display-3 fw-bold mb-4">
                    En la <span style="color: #be9c64;">naturaleza</span>, se vive mejor
                </h2>
                <p class="lead mb-4">
                    Descubre GreenLand Residencial, donde la arquitectura moderna
                    y la naturaleza se combinan para crear tu hogar ideal
                </p>
                <a href="#nosotros" class="hero-btn">
                    <i class="bi bi-arrow-down-circle"></i>
                    Conocer Más
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Nosotros -->
<section id="nosotros" class="section about-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title animate-fade-up">Sobre nosotros</h2>
                <p class="section-subtitle animate-fade-up">
                    Nuestro compromiso es ofrecer un estilo de vida equilibrado, rodeado de
                    áreas verdes, arquitectura consciente y un entorno pensado para el bienestar de tu familia y del planeta
                </p>
            </div>
        </div>

        <div class="row g-4 mt-3">
            <div class="col-lg-4 col-md-6">
                <div class="about-card animate-fade-left">
                    <div class="text-center mb-3">
                        <i class="bi bi-eye-fill service-icon" style="font-size: 3rem; color: #be9c64;"></i>
                    </div>
                    <h5 style="color: #be9c64;">Visión</h5>
                    <p>
                        Ser la referencia en el desarrollo de comunidades residenciales
                        que promuevan un estilo de vida sostenible y tranquilo.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="about-card animate-fade-up">
                    <div class="text-center mb-3">
                        <i class="bi bi-bullseye service-icon" style="font-size: 3rem; color: #be9c64;"></i>
                    </div>
                    <h5 style="color: #be9c64;">Misión</h5>
                    <p>
                        Diseñar y construir una comunidad que integra
                        tecnología, bienestar y conexión natural para mejorar la vida de las familias.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="about-card animate-fade-right">
                    <div class="text-center mb-3">
                        <i class="bi bi-heart-fill service-icon" style="font-size: 3rem; color: #be9c64;"></i>
                    </div>
                    <h5 style="color: #be9c64;">Valores</h5>
                    <p>
                        Compromiso ambiental, diseño funcional, calidad humana
                        y respeto por el entorno natural.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Renders -->
<section id="renders" class="section bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title animate-fade-up">Explora nuestros espacios</h2>
            <p class="section-subtitle animate-fade-up">
                Visualiza cómo será tu nuevo hogar en Residencial Green Land
            </p>
        </div>

        <div class="row g-4">
            @foreach (['7.jpg', '11.jpg', '13.jpg', '15.jpg'] as $img)
            <div class="col-md-6 animate-fade-up">
                <div class="render-card shadow rounded overflow-hidden">
                    <img src="{{ asset('images/renders/' . $img) }}" alt="Render {{ $img }}" class="img-fluid w-100">
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Servicios/Beneficios -->
<section id="servicios" class="section services-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title animate-fade-up">Nuestros beneficios</h2>
                <p class="section-subtitle animate-fade-up">
                    Aquí no solo encuentras un lugar para construir tu casa, encuentras un lugar donde
                    crecer, compartir y vivir mejor.
                </p>
            </div>
        </div>

        <div class="row g-4 mt-3">
            <div class="col-lg-4 col-md-6">

                <div class="service-card animate-fade-left">
                    <i class="bi bi-house-door service-icon" style="color: #18332c;"></i>
                    <h5 style="color: #18332c;">Generales</h5>
                    <p>
                        Calles adoquinadas, luz electrica y alumbrado publico, agua potable, muro perimentral y
                        servicios de recolección de basura.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-card animate-fade-up">
                    <i class="bi bi-tree service-icon"></i>
                    <h5 style="color: #18332c;">Áreas verdes</h5>
                    <p>
                        Senderos naturales diseñados para que disfrutes del aire puro y te relajes en un ambiente natural.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-card animate-fade-right">
                    <i class="bi bi-shield-check service-icon"></i>
                    <h5>Seguridad 24/7</h5>
                    <p>
                        Sistema integral de seguridad con accesos controlados,
                        videovigilancia constante y personal capacitado para tu tranquilidad total.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-card animate-fade-right">
                    <i class="bi bi-building service-icon" style="color: #18332c;"></i>
                    <h5 style="color: #18332c;">Lotes</h5>
                    <p>
                        Lotes desde 200 m², con acceso a servicios básicos y áreas comunes.
                        Espacios diseñados para tu comodidad y tranquilidad.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-card animate-fade-left">
                    <i class="bi bi-water service-icon" style="color: #18332c;"></i>
                    <h5 style="color: #18332c;">Amenidades</h5>
                    <p>
                        Areas de juegos, casa club, area de picnic, piscina, cancha mixta, gimnasio y areas verdes.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="service-card animate-fade-right">
                    <i class="bi bi-geo-alt service-icon" style="color: #18332c;"></i>
                    <h5 style="color: #18332c;">Ubicación estratégica</h5>
                    <p>
                        Fácil acceso a comercios, escuelas, iglesias
                        y vías principales, manteniendo la tranquilidad del entorno natural.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Ubicacion -->
<section id="mapa" class="section map-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title animate-fade-up">Ubicación</h2>
                <p class="section-subtitle animate-fade-up">
                    Estamos estratégicamente ubicados para ofrecerte lo mejor de ambos mundos:
                    tranquilidad natural y accesibilidad urbana.
                </p>
            </div>
        </div>

        <!-- Mapa Interactivo -->
        <div class="row mt-4">
            <div class="col-12 animate-fade-up">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/d/u/0/embed?mid=1LHZf15Zn3f1gsGisE4hEuyhVeBtlf9I&ehbc=2E312F&noprof=1"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>



        <!-- Info adicional de ubicación -->
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <i class="bi bi-clock service-icon" style="font-size: 2.5rem; color: #be9c64;"></i>
                    <h6 class="mt-3 fw-bold">Menos de 5min desde el centro</h6>
                    <p class="text-muted mb-0">Acceso rápido al centro de la ciudad y a 10min de San Francisco Gotera</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <i class="bi bi-building service-icon" style="font-size: 2.5rem; color: #be9c64;"></i>
                    <h6 class="mt-3 fw-bold">Cerca de todo</h6>
                    <p class="text-muted mb-0">Escuelas, iglesias, diferentes comercios y puntos turisticos como Perkin</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="text-center">
                    <i class="bi bi-car-front service-icon" style="font-size: 2.5rem; color: #be9c64;"></i>
                    <h6 class="mt-3 fw-bold">Fácil acceso</h6>
                    <p class="text-muted mb-0">Conectado a las principales vías</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Renders -->
<section id="renders" class="section bg-light">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title animate-fade-up">Galería de imagenes</h2>
            <p class="section-subtitle animate-fade-up">
                Desliza para explorar cómo se verá tu nuevo hogar
            </p>
        </div>

        <div class="render-scroll-container animate-fade-up">
            <div class="render-scroll d-flex gap-3">
                @foreach ([
                '1.png','2.jpg','3.png','4.png','5.jpg','7.jpg',
                '8.jpg','9.jpg','11.jpg','12.jpg','15.jpg','17.jpg'
                ] as $img)
                <div class="render-item">
                    <img src="{{ asset('images/renders/' . $img) }}" alt="Render {{ $img }}" class="img-fluid rounded shadow-sm" style="height: 250px; width: auto;">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- Ultima Section -->
<section class="section" style="background: #18332c; color: white;">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold mb-4 animate-fade-up">
                    ¿Te gustaria vivir en la Residencial Green Land?
                </h2>
                <p class="lead mb-4 animate-fade-up">
                    Conoce nuestras lotificaciones disponibles y descubre un nuevo estilo de vida
                    donde la naturaleza y el confort se encuentran
                </p>
                <div class="animate-fade-up">
                    <a href="{{ route('maps') }}" class="hero-btn me-3 mb-4">
                        <i class="bi bi-geo-alt-fill"></i>
                        Ver Mapa
                    </a>
                    <a href="#nosotros" class="btn btn-outline-light btn-lg rounded-pill px-4 ">
                        <i class="bi bi-info-circle me-2"></i>
                        Más Información
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // scrolling para los enlaces del navbar
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Animaciones al hacer scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observar elementos con animación
    document.querySelectorAll('.animate-fade-up, .animate-fade-left, .animate-fade-right').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.8s ease-out';
        observer.observe(el);
    });
</script>
@endpush
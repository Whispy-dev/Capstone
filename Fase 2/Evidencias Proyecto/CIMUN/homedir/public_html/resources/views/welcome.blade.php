<!DOCTYPE html>
<html lang="es">
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Sistema integral para gestión municipal, incidencias ciudadanas y agenda de alcaldía"
          name="description">
    <meta content="sistema municipal, gestión incidencias, agenda alcalde, ci-mun, municipalidad, administración pública"
          name="keywords">
    <meta content="CI-MUN" name="author">

    <link rel="shortcut icon" href="{{('../assets/images/logo/favicon.png')}}" type="image/x-icon">
    <title>CI-MUN | Sistema Municipal de Gestión de Incidencias</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d9488;
            --secondary-color: #0f766e;
            --accent-color: #ef4444;
            --success-color: #10b981;
            --municipal-teal: #134e4a;
            --municipal-cyan: #0891b2;
            --light-teal: #5eead4;
            --dark-teal: #042f2e;
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .municipal-gradient {
            background: linear-gradient(135deg, var(--dark-teal) 0%, var(--municipal-teal) 25%, var(--primary-color) 50%, var(--municipal-cyan) 75%, var(--light-teal) 100%);
        }
        
        .landing-navbar {
            background: rgba(13, 148, 136, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(94, 234, 212, 0.3);
            transition: all 0.3s ease;
        }
        
        .landing-navbar.scrolled {
            background: rgba(13, 148, 136, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .landing-section {
            background: linear-gradient(135deg, var(--dark-teal) 0%, var(--municipal-teal) 25%, var(--primary-color) 50%, var(--municipal-cyan) 75%, var(--light-teal) 100%);
            min-height: 100vh;
            position: relative;
            overflow: hidden;
        }
        
        .landing-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
        }
        
        .btn-municipal {
            background: linear-gradient(45deg, var(--municipal-teal), var(--primary-color));
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 148, 136, 0.3);
            color: white;
        }
        
        .btn-municipal:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(13, 148, 136, 0.4);
            background: linear-gradient(45deg, var(--primary-color), var(--municipal-cyan));
            color: white;
        }
        
        .btn-municipal-outline {
            border: 2px solid #ffffff;
            background: transparent;
            color: #ffffff;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-municipal-outline:hover {
            background: #ffffff;
            color: var(--municipal-teal);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, var(--municipal-teal), var(--primary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
        }
        
        .stats-counter {
            font-size: 3rem;
            font-weight: 800;
            color: var(--accent-color);
        }
        
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 3rem;
        }
        
        .navbar-brand {
            font-size: 1.8rem;
            font-weight: bold;
            color: white !important;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: var(--light-teal) !important;
        }
        
        .landing-heading h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 2rem;
            line-height: 1.2;
        }
        
        .landing-heading p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
        }
        
        .highlight-text {
            background: linear-gradient(45deg, var(--accent-color), #fca5a5);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .floating-img {
            animation: float 6s ease-in-out infinite;
        }
        
        .rounded-animation {
            animation: rotate 8s linear infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .home-bg-icon {
            list-style: none;
            padding: 0;
            margin: 0;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        .home-bg-icon li {
            position: absolute;
        }
        
        .home-bg-icon li:nth-child(1) {
            top: 20%;
            left: 10%;
        }
        
        .home-bg-icon li:nth-child(2) {
            top: 30%;
            right: 10%;
        }
        
        .home-bg-icon li:nth-child(3) {
            top: 60%;
            left: 15%;
        }
        
        .home-bg-icon li:nth-child(4) {
            bottom: 20%;
            right: 20%;
        }
        
        .home-bg-icon li:nth-child(5) {
            bottom: 40%;
            left: 20%;
        }
        
        .home-bg-icon li:nth-child(6) {
            top: 10%;
            right: 30%;
        }
        
        .home-bg-icon li:nth-child(7) {
            bottom: 10%;
            right: 40%;
        }
        
        .landing-content {
            position: relative;
            z-index: 2;
            padding-top: 150px;
            padding-bottom: 100px;
        }
        
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
            
            .landing-heading h1 {
                font-size: 2.5rem;
            }
            
            .stats-counter {
                font-size: 2rem;
            }
        }
        
        .municipal-stats {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            padding: 40px;
            margin-top: 60px;
        }
        
        .landing-footer {
            background: var(--municipal-teal);
            color: white;
            padding: 80px 0;
        }
        
        .features-section {
            background: #f8fafc;
            padding: 100px 0;
        }
        
        .language-box {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: -30px 0 50px 0;
            position: relative;
            z-index: 10;
        }
        
        .language-box-item a {
            transition: all 0.3s ease;
        }
        
        .language-box-item a:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-white landing-page">

<div class="app-wrapper flex-column">
    <!-- cursor  -->
    <div class="circle-cursor"></div>

    <div class="landing-wrapper">
        <!-- Header start -->
        <nav class="navbar navbar-expand-lg sticky-top landing-navbar px-3 w-100">
            <div class="container-fluid">
                <!-- Logo a la izquierda -->
                <a class="navbar-brand d-flex align-items-center" href="#home">
                    <i class="fas fa-city me-2 fs-4"></i>
                    <span class="fw-bold">CI-MUN</span>
                </a>
        
                <!-- Botón hamburguesa en móviles -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#landing_nav" 
                        aria-controls="landing_nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="landing_nav">
                    <!-- Links centrados -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#funcionalidades">Funcionalidades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#beneficios">Beneficios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Features">Características</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contacto">Contacto</a>
                        </li>
                    </ul>
        
                    <!-- Login/Register a la derecha -->
                    @if (Route::has('login'))
                        <nav class="d-flex align-items-center gap-2">
                            @auth
                                <a href="{{ route('dashboard.index') }}" class="btn btn-municipal">
                                    <i class="fas fa-tachometer-alt me-2"></i>Panel de Control
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-municipal-outline">
                                    <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-municipal">
                                        <i class="fas fa-user-plus me-2"></i>Registrarse
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
            </div>
        </nav>
        <!-- Header end -->



        <!-- Hero Section -->
        <section class="landing-section d-flex align-items-center" id="home">
            <div class="container-fluid">
                <ul class="home-bg-icon">
                    <li><i class="fas fa-city text-teal-300 floating-img" style="font-size: 3rem; opacity: 0.3; color: var(--light-teal);"></i></li>
                    <li><i class="fas fa-calendar-alt text-red-400 floating-img" style="font-size: 2.5rem; opacity: 0.3; color: var(--accent-color);"></i></li>
                    <li><i class="fas fa-exclamation-triangle text-teal-300 rounded-animation" style="font-size: 2rem; opacity: 0.3; color: var(--light-teal);"></i></li>
                    <li><i class="fas fa-users text-cyan-300 rounded-animation" style="font-size: 3rem; opacity: 0.3; color: var(--municipal-cyan);"></i></li>
                    <li><i class="fas fa-chart-pie text-red-400 floating-img" style="font-size: 2.5rem; opacity: 0.3; color: var(--accent-color);"></i></li>
                    <li><i class="fas fa-mobile-alt text-teal-300 rounded-animation" style="font-size: 2rem; opacity: 0.3; color: var(--light-teal);"></i></li>
                    <li><i class="fas fa-shield-alt text-cyan-300 floating-img" style="font-size: 2.5rem; opacity: 0.3; color: var(--municipal-cyan);"></i></li>
                </ul>
                
                <div class="row landing-content align-items-center">
                    <div class="col-lg-6">
                        <div class="landing-heading">
                            <div class="mb-4">
                                <span class="badge bg-danger text-white px-4 py-2 rounded-pill fw-bold">
                                    <i class="fas fa-star me-1"></i>Sistema Municipal Integral
                                </span>
                            </div>
                            <h1>Gestión Municipal <br>
                                <span class="highlight-text">Inteligente y Eficaz</span>
                            </h1>
                            <p>
                                CI-MUN revoluciona la administración municipal con herramientas avanzadas para 
                                gestionar incidencias ciudadanas, organizar la agenda del alcalde y optimizar 
                                los procesos administrativos.
                            </p>
                        </div>

                        <div class="d-flex gap-3 justify-content-start my-5 flex-wrap">
                            @guest
                                <a class="btn btn-danger btn-lg px-5 py-3 rounded-pill fw-bold" href="{{ route('register') }}">
                                    <i class="fas fa-rocket me-2"></i>Comenzar Ahora
                                </a>
                                <a class="btn btn-municipal-outline btn-lg px-5 py-3" href="{{ route('login') }}">
                                    <i class="fas fa-play me-2"></i>Acceder al Sistema
                                </a>
                            @else
                                <a class="btn btn-danger btn-lg px-5 py-3 rounded-pill fw-bold" href="{{ url('/dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Ir al Dashboard
                                </a>
                            @endguest
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="text-center">
                            <div class="municipal-stats">
                                <div class="row g-4">
                                    <div class="col-6">
                                        <div class="text-center text-white">
                                            <div class="stats-counter">1,250+</div>
                                            <p class="mb-0">Incidencias Resueltas</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center text-white">
                                            <div class="stats-counter">50+</div>
                                            <p class="mb-0">Municipalidades</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center text-white">
                                            <div class="stats-counter">95%</div>
                                            <p class="mb-0">Satisfacción</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center text-white">
                                            <div class="stats-counter">24/7</div>
                                            <p class="mb-0">Disponibilidad</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Features Section -->
    <section class="features-section" id="funcionalidades">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto text-center mb-5">
                    <span class="badge bg-primary text-white px-4 py-2 rounded-pill fw-bold mb-3">
                        <i class="fas fa-cogs me-1"></i>Funcionalidades
                    </span>
                    <h2 class="section-title text-dark">
                        Herramientas <span style="color: var(--primary-color);">Poderosas</span>
                    </h2>
                    <p class="section-subtitle text-muted">
                        Descubre todas las funcionalidades que hacen de CI-MUN la mejor solución 
                        para la gestión municipal moderna.
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <h4 class="fw-bold mb-3 text-dark">Gestión de Incidencias</h4>
                        <p class="text-muted">
                            Sistema completo para recibir, categorizar, asignar y dar seguimiento 
                            a todas las incidencias reportadas por los ciudadanos.
                        </p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4 class="fw-bold mb-3 text-dark">Agenda del Alcalde</h4>
                        <p class="text-muted">
                            Herramienta avanzada para programar, gestionar y optimizar la agenda 
                            del alcalde con recordatorios automáticos.
                        </p>
                    </div>
                </div>
                
                
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="fw-bold mb-3 text-dark">Portal Ciudadano</h4>
                        <p class="text-muted">
                            Plataforma intuitiva donde los ciudadanos pueden reportar incidencias, 
                            consultar el estado y recibir notificaciones.
                        </p>
                    </div>
                </div>
                
                
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-5 municipal-gradient" id="beneficios">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto text-center mb-5">
                    <span class="badge bg-danger text-white px-4 py-2 rounded-pill fw-bold mb-3">
                        <i class="fas fa-trophy me-1"></i>Beneficios
                    </span>
                    <h2 class="section-title text-white">
                        ¿Por qué elegir <span style="color: var(--accent-color);">CI-MUN?</span>
                    </h2>
                    <p class="section-subtitle text-white">
                        Transforma tu municipalidad con tecnología de vanguardia y mejora 
                        la calidad de vida de tus ciudadanos.
                    </p>
                </div>
            </div>
            
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="text-white">
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger text-white rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-check fw-bold"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Eficiencia Operativa</h5>
                            </div>
                            <p class="ms-5 opacity-90">
                                Automatiza procesos y reduce tiempos de respuesta hasta en un 70%.
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger text-white rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-check fw-bold"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Transparencia Total</h5>
                            </div>
                            <p class="ms-5 opacity-90">
                                Proporciona visibilidad completa de todas las gestiones municipales.
                            </p>
                        </div>
                        
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger text-white rounded-circle p-2 me-3" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-check fw-bold"></i>
                                </div>
                                <h5 class="mb-0 fw-bold">Satisfacción Ciudadana</h5>
                            </div>
                            <p class="ms-5 opacity-90">
                                Mejora la comunicación y eleva la satisfacción de los ciudadanos.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="text-center">
                        <div class="bg-white bg-opacity-10 rounded-4 p-5" style="backdrop-filter: blur(10px);">
                            <i class="fas fa-city" style="font-size: 8rem; color: var(--accent-color);"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light" id="contacto">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 mx-auto text-center">
                    <h2 class="section-title text-dark mb-4">
                        ¿Listo para <span style="color: var(--primary-color);">Modernizar</span> tu Municipalidad?
                    </h2>
                    <p class="section-subtitle text-muted mb-5">
                        Únete a las municipalidades que ya confían en CI-MUN para mejorar 
                        sus procesos y brindar un mejor servicio a sus ciudadanos.
                    </p>
                    
                    @guest
                        <div class="d-flex gap-3 justify-content-center flex-wrap">
                            <a href="{{ route('register') }}" class="btn btn-danger btn-lg px-5 py-3 rounded-pill fw-bold">
                                <i class="fas fa-rocket me-2"></i>Comenzar Gratis
                            </a>
                            <a href="mailto:contacto@ci-mun.com" class="btn" style="background: var(--primary-color); color: white; padding: 12px 40px; border-radius: 50px; font-weight: 600;">
                                <i class="fas fa-envelope me-2"></i>Contactar Ventas
                            </a>
                        </div>
                    @elseauth
                        <a href="{{ route('dashboard.index') }}" class="btn btn-danger btn-lg px-5 py-3 rounded-pill fw-bold">
                            <i class="fas fa-tachometer-alt me-2"></i>Acceder al Sistema
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="landing-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-city me-2 fs-3"></i>
                        <h3 class="mb-0 fw-bold">CI-MUN</h3>
                    </div>
                    <p class="text-white-75 mb-4">
                        Sistema integral para la gestión municipal moderna. 
                        Conectando gobiernos locales con sus ciudadanos.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white-75 hover-text-white">
                            <i class="fab fa-facebook fa-lg"></i>
                        </a>
                        <a href="#" class="text-white-75 hover-text-white">
                            <i class="fab fa-twitter fa-lg"></i>
                        </a>
                        <a href="#" class="text-white-75 hover-text-white">
                            <i class="fab fa-linkedin fa-lg"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold mb-3">Producto</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#funcionalidades" class="text-white-75 text-decoration-none hover-text-white">Funcionalidades</a></li>
                        <li class="mb-2"><a href="#beneficios" class="text-white-75 text-decoration-none hover-text-white">Beneficios</a></li>
                        <li class="mb-2"><a href="#" class="text-white-75 text-decoration-none hover-text-white">Demo</a></li>
                        <li class="mb-2"><a href="#" class="text-white-75 text-decoration-none hover-text-white">API</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold mb-3">Soporte</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white-75 text-decoration-none hover-text-white">Documentación</a></li>
                        <li class="mb-2"><a href="#" class="text-white-75 text-decoration-none hover-text-white">Centro de Ayuda</a></li>
                        <li class="mb-2"><a href="#contacto" class="text-white-75 text-decoration-none hover-text-white">Contacto</a></li>
                        <li class="mb-2"><a href="#" class="text-white-75 text-decoration-none hover-text-white">Estado del Servicio</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Contacto</h5>
                    <div class="mb-3">
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:contacto@ci-mun.com" class="text-white-75 text-decoration-none">contacto@ci-mun.com</a>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-phone me-2"></i>
                        <span class="text-white-75">+56 2 2345 6789</span>
                    </div>
                    <div>
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span class="text-white-75">Santiago, Chile</span>
                    </div>
                </div>
            </div>
            
            <hr class="my-4 border-secondary">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-white-75 mb-0">&copy; 2024 CI-MUN. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white-75 text-decoration-none me-3">Términos de Uso</a>
                    <a href="#" class="text-white-75 text-decoration-none">Política de Privacidad</a>
                </div>
            </div>

            <!-- Call to Action Footer -->
            <div class="text-center mt-5 pt-4 border-top border-secondary">
                <div class="bg-white bg-opacity-10 rounded-4 p-4 d-inline-block">
                    <i class="fas fa-city text-warning" style="font-size: 4rem;"></i>
                </div>
                <h2 class="mt-4 mb-3">Tu viaje hacia la modernización municipal comienza aquí</h2>
                <p class="text-white-75 mb-4">
                    Únete a CI-MUN y transforma tu municipalidad con tecnología de vanguardia. 
                    Si disfrutas de nuestra plataforma, ayúdanos calificando nuestro servicio.
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    @guest
                        <a class="btn btn-warning btn-lg px-5 py-3 rounded-pill fw-bold" href="{{ route('register') }}">
                            <i class="fas fa-rocket me-2"></i>Comenzar Ahora
                        </a>
                    @else
                        <a class="btn btn-warning btn-lg px-5 py-3 rounded-pill fw-bold" href="{{ url('/dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Acceder al Dashboard
                        </a>
                    @endguest
                    <a class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill" href="mailto:contacto@ci-mun.com">
                        <i class="fas fa-envelope me-2"></i>¿Necesitas Ayuda?
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- tap on top -->
<div class="go-top" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <span class="btn btn-municipal rounded-circle p-3" style="cursor: pointer;">
        <i class="fas fa-arrow-up"></i>
    </span>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.landing-navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
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

    // Counter animation
    const counters = document.querySelectorAll('.stats-counter');
    let hasAnimated = false;
    
    const animateCounters = () => {
        if (hasAnimated) return;
        hasAnimated = true;
        
        counters.forEach(counter => {
            const target = parseInt(counter.innerText.replace(/[^\d]/g, ''));
            const suffix = counter.innerText.replace(/[\d]/g, '');
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.innerText = Math.ceil(current) + suffix;
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target + suffix;
                }
            };
            
            updateCounter();
        });
    };

    // Trigger counter animation when in viewport
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
            }
        });
    }, { threshold: 0.5 });

    const statsSection = document.querySelector('.municipal-stats');
    if (statsSection) {
        observer.observe(statsSection);
    }

    // Go to top button
    const goTopBtn = document.querySelector('.go-top');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            goTopBtn.style.display = 'block';
        } else {
            goTopBtn.style.display = 'none';
        }
    });

    goTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Initialize tooltips if Bootstrap is loaded
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Cursor effect (simple version)
    document.addEventListener('mousemove', function(e) {
        const cursor = document.querySelector('.circle-cursor');
        if (cursor) {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        }
    });

    // Highlight text animation
    const highlightText = document.getElementById('highlight-text');
    if (highlightText) {
        const words = ['Gestión', 'Eficiencia', 'Innovación', 'Transparencia'];
        let currentIndex = 0;
        
        setInterval(() => {
            currentIndex = (currentIndex + 1) % words.length;
            highlightText.textContent = words[currentIndex];
        }, 3000);
    }
</script>

<style>
    .circle-cursor {
        position: fixed;
        width: 20px;
        height: 20px;
        background: rgba(245, 158, 11, 0.5);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transition: all 0.1s ease;
        transform: translate(-50%, -50%);
    }
    
    .text-white-75 {
        color: rgba(255, 255, 255, 0.75) !important;
    }
    
    .hover-text-white:hover {
        color: white !important;
    }
    
    .go-top {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .go-top:hover {
        transform: translateY(-5px);
    }
</style>

</body>
</html>
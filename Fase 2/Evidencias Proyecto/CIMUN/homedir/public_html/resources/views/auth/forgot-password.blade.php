<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    @include('layout.head')
    @include('layout.css')
    <!-- phosphor-icon css-->
    <link href="{{asset('../assets/vendor/phosphor/phosphor-bold.css')}}" rel="stylesheet">
</head>

<body class="sign-in-bg">
    <div class="app-wrapper d-block">
        <div class="container main-container">
            <div class="row main-content-box">
                <!-- Sección de imagen (solo visible en pantallas grandes) -->
                <div class="col-lg-7 image-content-box d-none d-lg-block">
                    <div class="form-container">
                        <div class="signup-content mt-4">
                            <span>
                                <img alt="Logo" class="img-fluid" src="../assets/images/login/LOGOCIMUN1.png">
                            </span>
                        </div>
                        <div class="signup-bg-img">
                            <img alt="Imagen de recuperación" class="img-fluid" src="../assets/images/login/02.png">
                        </div>
                    </div>
                </div>

                <!-- Sección del formulario -->
                <div class="col-lg-5 form-content-box">
                    <div class="form-container">
                        <!-- Mensaje de estado de la sesión -->
                        @if (session('status'))
                            <div class="alert alert-success mb-4" role="alert">
                                <i class="ph-bold ph-check-circle me-2"></i>
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" class="app-form" action="{{ route('password.email') }}">
                            @csrf
                            <div class="row">
                                <!-- Título y descripción -->
                                <div class="col-12">
                                    <div class="mb-4 text-center text-lg-start">
                                        <h2 class="text-white f-w-600">
                                            ¿Olvidaste tu <span class="text-dark">contraseña?</span>
                                        </h2>
                                        <p class="f-s-16 mt-3 text-muted">
                                            <i class="ph-bold ph-info me-2"></i>
                                            No te preocupes. Simplemente ingresa tu dirección de correo electrónico 
                                            y te enviaremos un enlace para restablecer tu contraseña que te permitirá 
                                            elegir una nueva.
                                        </p>
                                    </div>
                                </div>

                                <!-- Campo de Email -->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input 
                                            class="form-control @error('email') is-invalid @enderror" 
                                            id="email" 
                                            name="email"
                                            placeholder="Ingrese su correo electrónico"
                                            type="email" 
                                            value="{{ old('email') }}"
                                            required 
                                            autofocus 
                                            autocomplete="email"
                                        >
                                        <label for="email">
                                            <i class="ph-bold ph-envelope me-2"></i>
                                            Correo Electrónico
                                        </label>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                <i class="ph-bold ph-warning-circle me-1"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Botón de envío -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary btn-lg w-100" type="submit">
                                        <i class="ph-bold ph-paper-plane-right me-2"></i>
                                        Enviar Enlace de Recuperación
                                    </button>
                                </div>

                                <!-- Enlaces de navegación -->
                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a class="text-dark f-w-500 text-decoration-underline d-flex align-items-center" 
                                           href="{{ route('login') }}">
                                            <i class="ph-bold ph-arrow-left me-2"></i>
                                            Volver al inicio de sesión
                                        </a>
                                        
                                        <a class="text-white-800 text-decoration-underline d-flex align-items-center" 
                                           href="{{ route('register') }}">
                                            <i class="ph-bold ph-user-plus me-2"></i>
                                            Crear cuenta
                                        </a>
                                    </div>
                                </div>

                                <!-- Información adicional -->
                                <div class="col-12 mt-4">
                                    <div class="alert alert-light" role="alert">
                                        <i class="ph-bold ph-lightbulb text-warning me-2"></i>
                                        <strong>Consejo:</strong> Revisa tu carpeta de spam si no recibes el correo en unos minutos.
                                    </div>
                                </div>

                                <!-- Divisor -->
                                <div class="app-divider-v light justify-content-center py-lg-4 py-3">
                                    <p>¿Necesitas ayuda?</p>
                                </div>

                                <!-- Enlaces de soporte -->
                                <div class="col-12">
                                    <div class="text-center">
                                        <div class="d-flex gap-3 justify-content-center align-items-center">
                                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                                <i class="ph-bold ph-question me-2"></i>
                                                Centro de Ayuda
                                            </a>
                                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                                <i class="ph-bold ph-chat-circle me-2"></i>
                                                Contactar Soporte
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="{{ asset('assets/vendor/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- Script para mostrar mensaje de confirmación -->
    <script>
        // Auto-ocultar alertas después de 5 segundos
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>

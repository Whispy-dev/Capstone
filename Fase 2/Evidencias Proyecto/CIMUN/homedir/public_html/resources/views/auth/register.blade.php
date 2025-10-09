<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
                                <img alt="Logo" class="img-fluid" src="../assets/images/logo/LOGOCIMUN.png">
                            </span>
                        </div>
                        <div class="signup-bg-img">
                            <img alt="Imagen de registro" class="img-fluid" src="../assets/images/login/04.png">
                        </div>
                    </div>
                </div>

                <!-- Sección del formulario -->
                <div class="col-lg-5 form-content-box">
                    <div class="form-container">
                        <form method="POST" class="app-form" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <!-- Título de bienvenida -->
                                <div class="col-12">
                                    <div class="mb-5 text-center text-lg-start">
                                        <h2 class="text-white f-w-600">
                                            ¡Únete a <span class="text-dark">CI-MUN!</span>
                                        </h2>
                                        <p class="f-s-16 mt-2">
                                            Crea tu cuenta y comienza a disfrutar de nuestros servicios
                                        </p>
                                    </div>
                                </div>

                                <!-- Campo de Nombre -->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input 
                                            class="form-control @error('name') is-invalid @enderror" 
                                            id="name" 
                                            name="name"
                                            placeholder="Ingrese su nombre completo"
                                            type="text" 
                                            value="{{ old('name') }}"
                                            required 
                                            autofocus 
                                            autocomplete="name"
                                        >
                                        <label for="name">Nombre Completo</label>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                            autocomplete="username"
                                        >
                                        <label for="email">Correo Electrónico</label>
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Campo de Contraseña -->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input 
                                            class="form-control @error('password') is-invalid @enderror" 
                                            id="password" 
                                            name="password"
                                            placeholder="Ingrese su contraseña"
                                            type="password"
                                            required 
                                            autocomplete="new-password"
                                        >
                                        <label for="password">Contraseña</label>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Campo de Confirmar Contraseña -->
                                <div class="col-12">
                                    <div class="form-floating mb-3">
                                        <input 
                                            class="form-control @error('password_confirmation') is-invalid @enderror" 
                                            id="password_confirmation" 
                                            name="password_confirmation"
                                            placeholder="Confirme su contraseña"
                                            type="password"
                                            required 
                                            autocomplete="new-password"
                                        >
                                        <label for="password_confirmation">Confirmar Contraseña</label>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Checkbox de términos y condiciones (opcional) -->
                                <div class="col-12">
                                    <div class="form-check d-flex align-items-center gap-2 mb-3">
                                        <input 
                                            class="form-check-input w-25 h-25" 
                                            id="terms" 
                                            name="terms"
                                            type="checkbox"
                                            required
                                        >
                                        <label class="form-check-label text-dark mt-2 f-s-16" for="terms">
                                            Acepto los 
                                            <a href="#" class="text-decoration-underline">términos y condiciones</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Botón de registro -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary btn-lg w-100" type="submit">
                                        Crear Cuenta
                                    </button>
                                </div>

                                <!-- Enlace de inicio de sesión -->
                                <div class="col-12 mt-4">
                                    <div class="text-center text-lg-start f-w-500">
                                        ¿Ya tienes una cuenta?
                                        <a class="text-white-800 text-decoration-underline" 
                                           href="{{ route('login') }}">
                                            Inicia sesión
                                        </a>
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
</body>
</html>
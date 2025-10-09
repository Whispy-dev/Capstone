<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    @include('layout.head')
    @include('layout.css')
    <!-- phosphor-icon css-->
    <link href="{{ asset('../assets/vendor/phosphor/phosphor-bold.css') }}" rel="stylesheet">
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
                            <img alt="Imagen de login" class="img-fluid" src="../assets/images/login/01.png">
                        </div>
                    </div>
                </div>

                <!-- Sección del formulario -->
                <div class="col-lg-5 form-content-box">
                    <div class="form-container">
                        <form method="POST" class="app-form" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                
                                <!-- Título de bienvenida -->
                                <div class="col-12">
                                    <div class="mb-5 text-center text-lg-start">
                                        <h2 class="text-white f-w-600">
                                            ¡Bienvenido a <span class="text-dark">CI-MUN!</span>
                                        </h2>
                                        <p class="f-s-16 mt-2">
                                            Inicia sesión con los datos que ingresaste durante tu registro
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
                                            autocomplete="current-password"
                                        >
                                        <label for="password">Contraseña</label>
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <!-- Enlace de contraseña olvidada -->
                                    <div class="text-end">
                                        @if (Route::has('password.request'))
                                            <a class="text-dark f-w-500 text-decoration-underline" 
                                               href="{{ route('password.request') }}">
                                                ¿Olvidaste tu contraseña?
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <!-- Checkbox Recordarme -->
                                <div class="col-12">
                                    <div class="form-check d-flex align-items-center gap-2 mb-3">
                                        <input 
                                            class="form-check-input w-25 h-25" 
                                            id="remember_me" 
                                            name="remember"
                                            type="checkbox"
                                        >
                                        <label class="form-check-label text-dark f-s-16" for="remember_me">
                                            Recordarme
                                        </label>
                                    </div>
                                </div>

                                <!-- Botón de inicio de sesión -->
                                <div class="col-12 mt-3">
                                    <button class="btn btn-primary btn-lg w-100" type="submit">
                                        Iniciar Sesión
                                    </button>
                                </div>

                                <!-- Enlace de registro -->
                                <div class="col-12 mt-4">
                                    <div class="text-center text-lg-start f-w-500">
                                        ¿Aún no tienes una cuenta?
                                        <a class="text-white-800 text-decoration-underline" 
                                           href="{{ route('register') }}">
                                            Regístrate
                                        </a>
                                    </div>
                                </div>

                                <!-- Divisor -->
                                <div class="app-divider-v light justify-content-center py-lg-5 py-3 d-none">
                                    <p>O</p>
                                </div>

                                <!-- Botones de redes sociales -->
                                <div class="col-12 d-none">
                                    <div class="d-flex gap-3 justify-content-center text-center">
                                        <button class="btn btn-light-white icon-btn w-45 h-45 b-r-15" 
                                                type="button" 
                                                title="Iniciar sesión con Facebook">
                                            <i class="ph-bold ph-facebook-logo f-s-20"></i>
                                        </button>
                                        <button class="btn btn-light-white icon-btn w-45 h-45 b-r-15" 
                                                type="button" 
                                                title="Iniciar sesión con Google">
                                            <i class="ph-bold ph-google-logo f-s-20"></i>
                                        </button>
                                        <button class="btn btn-light-white icon-btn w-45 h-45 b-r-15" 
                                                type="button" 
                                                title="Iniciar sesión con Twitter">
                                            <i class="ph-bold ph-twitter-logo f-s-20"></i>
                                        </button>
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

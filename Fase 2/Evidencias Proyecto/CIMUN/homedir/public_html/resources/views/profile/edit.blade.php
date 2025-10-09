@extends('layout.master')
@section('title', 'Configuración')
@section('css')
    <!-- glight css -->
    <link rel="stylesheet" href="{{asset('assets/vendor/glightbox/glightbox.min.css')}}">

    <!-- apexcharts css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/apexcharts/apexcharts.css')}}">

    <!-- Select2 css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/select/select2.min.css')}}">
@endsection
@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumb start -->
    <div class="row m-1">
        <div class="col-12">
            <h4 class="main-title">Configuración</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li>
                    <a href="#" class="f-s-14 f-w-500">
                        <span><i class="ph-duotone ph-stack f-s-16"></i> Aplicaciones</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="f-s-14 f-w-500">Perfil</a>
                </li>
                <li class="active">
                    <a href="#" class="f-s-14 f-w-500">Configuración</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb end -->

    <!-- setting-app start -->
    <div class="row">
        <div class="col-lg-8 col-xxl-9">
            <div class="tab-content">

                <!-- Información del Perfil -->
                <div class="tab-pane fade active show" id="profile-tab-pane" role="tabpanel"
                     aria-labelledby="profile-tab" tabindex="0">
                    <div class="card setting-profile-tab mb-4">
                        <div class="card-header">
                            <h5>Información del Perfil</h5>
                        </div>
                        <div class="card-body">
                            <div class="profile-tab profile-container">

                                <!-- FORMULARIO DE INFORMACIÓN DEL PERFIL -->
                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <<!-- Avatar / Profile Picture -->
                                    <div class="image-details mb-4">
                                        <!-- Imagen de fondo fija -->
                                        <div class="profile-image"></div>
                                    
                                        <!-- Avatar editable -->
                                        <div class="profile-pic">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type="file" id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg"
                                                           data-url="{{ route('profile.update.avatar') }}">
                                                    <label for="imageUpload"><i class="ti ti-photo-heart"></i></label>
                                                </div>

                                                <div class="avatar-preview">
                                                    <div id="imgPreview"
                                                         style="background-image: url('{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('assets/images/avatar/woman.jpg') }}')">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>





                                    <!-- Person Details -->
                                    <div class="person-details mb-4">
                                        <h5 class="f-w-600">{{ Auth::user()->name ?? 'Nombre de Usuario' }}
                                            <img width="20" height="20" src="{{ asset('assets/images/profile-app/01.png') }}" alt="marca-verificacion">
                                        </h5>
                                        <p>{{ Auth::user()->role ?? 'Diseñador Web y Desarrollador' }}</p>
                                    </div>

                                    <!-- Formulario de Información del Perfil -->
                                    <div class="profile-form-section">
                                        @include('profile.partials.update-profile-information-form')
                                    </div>

                                    <!-- Botón Guardar -->
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actualizar Contraseña -->
                <div class="card setting-profile-tab mb-4">
                    <div class="card-header">
                        <h5>Actualizar Contraseña</h5>
                    </div>
                    <div class="card-body">
                        <div class="profile-tab profile-container">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Eliminar Cuenta -->
                <div class="card setting-profile-tab">
                    <div class="card-header">
                        <h5>Eliminar Cuenta</h5>
                    </div>
                    <div class="card-body">
                        <div class="profile-tab profile-container">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- setting-app end -->
</div>

<style>
    /* Estilos adicionales para mejorar la apariencia */
    .profile-form-section {
        margin-top: 1rem;
    }
    
    .setting-profile-tab .card-body {
        padding: 1.5rem;
    }
    
    .profile-container {
        width: 100%;
    }
    
    .space-y-6 > * + * {
        margin-top: 1.5rem;
    }
    
    /* Estilos para que los formularios de Laravel se vean bien */
    .profile-tab .form-group,
    .profile-tab .mb-3 {
        margin-bottom: 1rem;
    }
    
    .profile-tab label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .profile-tab input[type="text"],
    .profile-tab input[type="email"],
    .profile-tab input[type="password"] {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #ddd;
        border-radius: 0.375rem;
        font-size: 0.875rem;
    }
    
    .profile-tab .btn {
        padding: 0.75rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
    }
    
    .profile-tab .btn-primary {
        background-color: #3b82f6;
        color: white;
    }
    
    .profile-tab .btn-danger {
        background-color: #ef4444;
        color: white;
    }
    
    .profile-tab .text-danger {
        color: #ef4444 !important;
    }
    
    .profile-tab .text-gray-600 {
        color: #6b7280;
    }
    
    .profile-tab .alert {
        padding: 1rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.375rem;
    }
    
    .profile-tab .alert-danger {
        background-color: #fef2f2;
        border-color: #fecaca;
        color: #dc2626;
    }
    .profile-image {
        background-image: url('{{ asset('assets/images/profile-app/fondo.png') }}');
        background-size: cover;
        background-position: center;
        height: 200px;
        border-radius: 0.5rem;
    }
    
    .avatar-preview #imgPreview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        overflow: hidden;
    }


</style>

@endsection

@section('script')
    <!-- apexcharts-->
    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Glight js -->
    <script src="{{asset('assets/vendor/glightbox/glightbox.min.js')}}"></script>

    <!-- sweetalert js-->
    <script src="{{asset('assets/vendor/sweetalert/sweetalert.js')}}"></script>

    <!-- select2 -->
    <script src="{{asset('assets/vendor/select/select2.min.js')}}"></script>

    <!--js-->
    <script src="{{asset('assets/js/touchspin.js')}}"></script>

    <!--setting js  -->
    <script src="{{asset('assets/js/setting.js')}}"></script>
    
    <script>
    document.getElementById("imageUpload").addEventListener("change", function () {
        const input = this;
        const file = input.files[0];
        const url = input.dataset.url;
    
        if (file) {
            // Mostrar preview inmediato
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("imgPreview").style.backgroundImage = "url(" + e.target.result + ")";
            };
            reader.readAsDataURL(file);
    
            // Subir automáticamente al servidor
            const formData = new FormData();
            formData.append("avatar", file);
    
            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    swal({
                        title: "¡Éxito!",
                        text: "Tu avatar fue actualizado correctamente.",
                        icon: "success",
                        button: "Ok"
                    });
                } else {
                    swal({
                        title: "Error",
                        text: "Hubo un problema al actualizar el avatar.",
                        icon: "error",
                        button: "Intentar de nuevo"
                    });
                }
            })
            .catch(err => {
                console.error("Error:", err);
                swal({
                    title: "Error",
                    text: "No se pudo subir la imagen.",
                    icon: "error",
                    button: "Ok"
                });
            });
        }
    });
    </script>


    
@endsection
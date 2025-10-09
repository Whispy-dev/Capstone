<!-- Header Section starts -->
<header class="header-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 col-sm-6 d-flex align-items-center header-left p-0">
                           <span class="header-toggle ">
                             <i class="ph ph-squares-four"></i>
                           </span>

                <div class="header-searchbar w-100">
                    <form action="#" class="mx-sm-3 app-form app-icon-form ">
                        <div class="position-relative">
                            <input aria-label="Search" class="form-control" placeholder="Search..."
                                   type="search">
                            <i class="ti ti-search text-dark"></i>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-4 col-sm-6 d-flex align-items-center justify-content-end header-right p-0">

                <ul class="d-flex align-items-center">

                    <li class="header-language d-none">
                        <div class="flex-shrink-0 dropdown" id="lang_selector">
                            <a aria-expanded="false" class="d-block head-icon ps-0"
                               data-bs-toggle="dropdown"
                               href="#">
                                <div class="lang-flag lang-en ">
                                                <span class="flag rounded-circle overflow-hidden">
                                                    <i class=""></i>
                                                </span>
                                </div>
                            </a>
                            <ul class="dropdown-menu language-dropdown header-card border-0">
                                <li class="lang lang-en selected dropdown-item p-2" data-bs-placement="top"
                                    data-bs-toggle="tooltip" title="US">
                                                <span class="d-flex align-items-center">
                                                    <i class="flag-icon flag-icon-usa flag-icon-squared rounded-circle f-s-20"></i>
                                                    <span class="ps-2">US</span>
                                                </span>
                                </li>
                                <li class="lang lang-pt dropdown-item p-2" title="FR">
                                                <span class="d-flex align-items-center">
                                                    <i class="flag-icon flag-icon-fra flag-icon-squared rounded-circle f-s-20"></i>
                                                    <span class="ps-2">France</span>
                                                </span>
                                </li>
                                <li class="lang lang-es dropdown-item p-2" title="UK">
                                                <span class="d-flex align-items-center">
                                                    <i class="flag-icon flag-icon-gbr flag-icon-squared rounded-circle f-s-20"></i>
                                                    <span class="ps-2">UK</span>
                                                </span>
                                </li>
                                <li class="lang lang-es dropdown-item p-2" title="IT">
                                                <span class="d-flex align-items-center">
                                                    <i class="flag-icon flag-icon-ita flag-icon-squared rounded-circle f-s-20"></i>
                                                    <span class="ps-2">Italy</span>
                                                </span>
                                </li>
                            </ul>
                        </div>

                    </li>

                    <li class="header-apps">
                        <a aria-controls="appscanvasRights"
                           class="d-block head-icon bg-light-dark rounded-circle f-s-22 p-2"
                           data-bs-target="#appscanvasRights" data-bs-toggle="offcanvas"
                           href="#" role="button">
                            <i class="ph ph-bounding-box"></i>
                        </a>
                    
                        <div aria-labelledby="appscanvasRightsLabel"
                             class="offcanvas offcanvas-end header-apps-canvas"
                             id="appscanvasRights"
                             tabindex="-1">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="appscanvasRightsLabel">Accesos Directos</h5>
                                <div class="app-dropdown flex-shrink-0">
                                    <a aria-expanded="false" class="p-1" data-bs-auto-close="outside"
                                       data-bs-toggle="dropdown"
                                       href="#"
                                       role="button">
                                        <i class="ph-bold ph-faders-horizontal f-s-20"></i>
                                    </a>
                                    <ul class="dropdown-menu mb-3">
                                        <li class="dropdown-item">
                                            <a href="{{route('setting')}}" target="_blank">
                                                Configuración de Privacidad
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('setting')}}" target="_blank">
                                                Configuración de la Cuenta
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a href="{{route('setting')}}" target="_blank">
                                                Accesibilidad
                                            </a>
                                        </li>
                                        <li class="dropdown-divider"></li>
                                        <li class="dropdown-item border-0">
                                            <a aria-expanded="false" data-bs-toggle="dropdown" href="#"
                                               role="button">
                                                Más Configuraciones
                                            </a>
                                            <ul class="dropdown-menu sub-menu">
                                                <li class="dropdown-item">
                                                    <a href="{{route('setting')}}" target="_blank">
                                                        Copia de Seguridad y Restaurar
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="{{route('setting')}}" target="_blank">
                                                        Uso de Datos
                                                    </a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="{{route('setting')}}" target="_blank">
                                                        Tema
                                                    </a>
                                                </li>
                                                <li class="dropdown-item d-flex align-items-center justify-content-between">
                                                    <a href="#">
                                                        <p class="mb-0">Notificaciones</p>
                                                    </a>
                                                    <div class="flex-shrink-0">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input form-check-primary"
                                                                   id="notificationSwitch"
                                                                   type="checkbox">
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="offcanvas-body app-scroll">
                                <div class="row row-cols-3 g-2">
                                    <div class="d-flex-center text-center  d-none">
                                        <a class="text-light-danger w-100 rounded-3 py-3 px-2"
                                           href="{{route('email')}}"
                                           target="_blank">
                                            <span>
                                                <i class="ph-light ph-envelope f-s-30"></i>
                                            </span>
                                            <p class="mb-0 f-w-500 text-dark">Correo</p>
                                        </a>
                                    </div>
                    
                                    <div class="d-flex-center text-center">
                                        <a class="text-light-danger w-100 rounded-3 py-3 px-2"
                                           href="{{ route('calendar.index') }}"
                                           target="_blank">
                                            <span>
                                                <i class="ph-light ph-calendar f-s-30"></i>
                                            </span>
                                            <p class="mb-0 f-w-500 text-dark">Calendario</p>
                                        </a>
                                    </div>
                    
                                    <div class="d-flex-center text-center  d-none">
                                        <a class="text-light-warning w-100 rounded-3 py-3 px-2"
                                           href="{{route('file_manager')}}"
                                           target="_blank">
                                            <span>
                                                <i class="ph-light ph-folder-open f-s-30"></i>
                                            </span>
                                            <p class="mb-0 f-w-500 text-dark txt-ellipsis-1">Gestor de Archivos</p>
                                        </a>
                                    </div>
                    
                                    <div class="d-flex-center text-center  d-none">
                                        <a class="text-light-primary w-100 rounded-3 py-3 px-2"
                                           href="{{route('gallery')}}"
                                           target="_blank">
                                            <span>
                                                <i class="ph-light ph-google-photos-logo f-s-30"></i>
                                            </span>
                                            <p class="mb-0 f-w-500 text-dark">Galería</p>
                                        </a>
                                    </div>
                    
                                    <div class="d-flex-center text-center ">
                                        <a class="text-light-success w-100 rounded-3 py-3 px-2"
                                           href="{{route('profile.index')}}"
                                           target="_blank">
                                            <span>
                                                <i class="ph-light ph-users-three f-s-30"></i>
                                            </span>
                                            <p class="mb-0 f-w-500 text-dark">Perfil</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    <li class="header-dark">
                        <div class="sun-logo head-icon bg-light-dark rounded-circle f-s-22 p-2">
                            <i class="ph ph-moon-stars"></i>
                        </div>
                        <div class="moon-logo head-icon bg-light-dark rounded-circle f-s-22 p-2">
                            <i class="ph ph-sun-dim"></i>
                        </div>
                    </li>
                    
                    <li class="header-notification d-none">
                        <a aria-controls="notificationcanvasRight"
                           class="d-block head-icon position-relative bg-light-dark rounded-circle f-s-22 p-2"
                           data-bs-target="#notificationcanvasRight"
                           data-bs-toggle="offcanvas"
                           href="#"
                           role="button">
                            <i class="ph ph-bell"></i>
                            <span class="position-absolute translate-middle p-1 bg-primary border border-light rounded-circle animate__animated animate__fadeIn animate__infinite animate__slower"></span>
                        </a>
                        <div aria-labelledby="notificationcanvasRightLabel"
                             class="offcanvas offcanvas-end header-notification-canvas"
                             id="notificationcanvasRight" tabindex="-1">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="notificationcanvasRightLabel">
                                    Notificaciones</h5>
                                <button aria-label="Cerrar" class="btn-close" data-bs-dismiss="offcanvas"
                                        type="button"></button>
                            </div>
                            <div class="offcanvas-body app-scroll p-0">
                                <div class="head-container">
                                    <div class="notification-message head-box">
                                        <div class="message-content-box flex-grow-1 pe-2">
                                            <a class="f-s-15 text-dark mb-0"
                                               href="#"><span class="f-w-500 text-dark">Gene Hart</span> quiere editar <span class="f-w-500 text-dark">Report.doc</span></a>
                                            <div>
                                                <a class="d-inline-block f-w-500 text-success me-1" href="#">Aprobar</a>
                                                <a class="d-inline-block f-w-500 text-danger" href="#">Denegar</a>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                                            <div>
                                                <span class="badge text-light-primary">23 sep</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="notification-message head-box">
                                        <div class="message-content-box flex-grow-1 pe-2">
                                            <a class="f-s-15 text-dark mb-0" href="#">Hola <span class="f-w-500 text-dark">Emery McKenzie</span>, prepárate: tu pedido de <span class="f-w-500 text-dark">@Shopper.com</span></a>
                                        </div>
                                        <div class="text-end">
                                            <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                                            <div>
                                                <span class="badge text-light-primary">23 sep</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="notification-message head-box">
                                        <div class="message-content-box flex-grow-1 pe-2">
                                            <a class="f-s-15 text-dark mb-0" href="#"><span class="f-w-500 text-dark">Simon Young</span> compartió un archivo llamado <span class="f-w-500 text-dark">Dropdown.pdf</span></a>
                                        </div>
                                        <div class="text-end">
                                            <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                                            <div>
                                                <span class="badge text-light-primary">Hace 30 min</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="notification-message head-box">
                                        <div class="message-content-box flex-grow-1 pe-2">
                                            <a class="f-s-15 text-dark mb-0" href="#"><span class="f-w-500 text-dark">Becky G. Hayes</span> agregó un comentario a <span class="f-w-500 text-dark">Final_Report.pdf</span></a>
                                        </div>
                                        <div class="text-end">
                                            <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                                            <div>
                                                <span class="badge text-light-primary">Hace 45 min</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="notification-message head-box">
                                        <div class="message-content-box flex-grow-1 pe-2">
                                            <a class="f-s-15 text-dark mb-0" href="#"><span class="f-w-600 text-dark">@Romaine</span> te invitó a una reunión</a>
                                            <div>
                                                <a class="d-inline-block f-w-500 text-success me-1" href="#">Unirse</a>
                                                <a class="d-inline-block f-w-500 text-danger" href="#">Rechazar</a>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                                            <div>
                                                <span class="badge text-light-primary">Hace 1 hora</span>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="hidden-massage py-4 px-3">
                                        <div>
                                            <i class="ph-duotone ph-bell-ringing f-s-50 text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">No se encontraron notificaciones</h6>
                                            <p class="text-dark">Cuando tengas notificaciones aquí, aparecerán en este lugar.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Header Section ends -->

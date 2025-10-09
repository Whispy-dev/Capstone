<!-- Menu Navigation starts -->
<nav>
    <div class="app-logo">
        <a class="logo d-inline-block" href="/">
            <img alt="Logo CIMUN" src="{{asset('../assets/images/logo/LOGOCIMUN.png')}}">
        </a>

        <span class="bg-light-primary toggle-semi-nav d-flex-center">
            <i class="ti ti-chevron-right"></i>
        </span>
        
        @php
            $hasMunicipality = !is_null(auth()->user()->municipality_id) && auth()->user()->municipality_id > 0;
        @endphp

        <div class="d-flex align-items-center nav-profile p-3">
          <span class="h-45 w-45 d-flex-center b-r-10 position-relative bg-danger m-auto">
            <span class="d-block w-100 h-100 overflow-hidden b-r-10">
              @if(Auth::user()->avatar)
                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                     alt="avatar" class="w-100 h-100" style="object-fit: cover;">
              @else
                <i class="ph ph-user-circle text-white f-s-28"></i>
              @endif
            </span>
            <span class="position-absolute top-0 end-0 p-1 bg-success border border-light rounded-circle"></span>
          </span>
        
          <div class="flex-grow-1 ps-2">
            <h6 class="text-primary mb-0">{{ Auth::user()->name }}</h6>
            <p class="text-muted f-s-12 mb-0">{{ Auth::user()->email }}</p>
            <p class="text-muted f-s-12 mb-0">
              {{ auth()->user()->municipality->name ?? 'No hay municipalidad asignada' }}
            </p>
          </div>
        
          <!-- aquí tu dropdown -->
          <div class="dropdown profile-menu-dropdown ms-2">
              <a class="dropdown-toggle" href="#" id="profileDropdown"
                 data-bs-toggle="dropdown"
                 data-bs-display="static"
                 data-bs-offset="0,10"
                 aria-expanded="false">
                <i class="ti ti-settings fs-5"></i>
              </a>
            
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li>
                  <a class="dropdown-item f-w-500" href="{{ route('profile.index') }}">
                    <i class="ph-duotone ph-user-circle pe-1 f-s-20"></i> 
                    Detalles del Perfil
                  </a>
                </li>
            
                <li>
                  <a class="dropdown-item f-w-500" href="{{ route('profile.index') }}">
                    <i class="ph-duotone ph-gear pe-1 f-s-20"></i> 
                    Configuración
                  </a>
                </li>
            
                <li>
                  <div class="dropdown-item d-flex align-items-center justify-content-between">
                    <div>
                      <a class="f-w-500 text-decoration-none" href="#">
                        <i class="ph-duotone ph-detective pe-1 f-s-20"></i> 
                        Incógnito
                      </a>
                    </div>
                    <div class="flex-shrink-0">
                      <div class="form-check form-switch">
                        <input class="form-check-input form-check-primary" id="incognitoSwitch" type="checkbox">
                      </div>
                    </div>
                  </div>
                </li>
            
                <li>
                  <a class="dropdown-item mb-0 text-secondary f-w-500" href="{{ route('register') }}">
                    <i class="ph-bold ph-plus pe-1 f-s-20"></i> 
                    Añadir cuenta
                  </a>
                </li>
            
                <li><hr class="dropdown-divider"></li>
            
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="dropdown-item mb-0 text-danger border-0 bg-transparent w-100 text-start">
                      <i class="ph-duotone ph-sign-out pe-1 f-s-20"></i> 
                      Cerrar Sesión 
                    </button>
                  </form>
                </li>
              </ul>
            </div>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <div class="app-nav" id="app-simple-bar">
        <ul class="main-nav p-0 mt-2">
            <li class="menu-title">
                <span>Menu Principal</span>
            </li>
            
            @if ($hasMunicipality)
                <!-- Dashboard Menu Item -->
                <li class="no-sub">
                    <a class="nav-link" href="{{route('dashboard.index')}}">
                        <svg stroke="currentColor" stroke-width="1.5" class="me-2">
                            <use xlink:href="../assets/svg/_sprite.svg#home"></use>
                        </svg>
                       Dashboard
                    </a>
                </li>
    
                <!-- Incidencias Menu Item -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#incidencias" 
                       role="button" aria-expanded="false" aria-controls="incidencias">
                        <svg stroke="currentColor" stroke-width="1.5" class="me-2">
                            <use xlink:href="../assets/svg/_sprite.svg#stack"></use>
                        </svg>
                        <span>Incidencias</span>
                    </a>
                
                    <ul class="collapse" id="incidencias">
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Lista Incidencias
                            </a>
                        </li>
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Gestión Documental
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Eventos Menu Item -->
                <li>
                    <a aria-expanded="false" data-bs-toggle="collapse" href="#events">
                        <svg stroke="currentColor" stroke-width="1.5" class="me-2">
                            <use xlink:href="../assets/svg/_sprite.svg#rectangle"></use>
                        </svg>
                        Eventos
                    </a>
                    <ul class="collapse" id="events">
                        <li>
                            <a href="{{route('calendar.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Calendario
                            </a>
                        </li>
                        <li>
                            <a href="{{route('calendar.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Actividades
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Tramites Menu Item -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#tramites" 
                       role="button" aria-expanded="false" aria-controls="tramites">
                        <i class="ti ti-file-text me-2 fs-4 mb-2"></i>
                        <span>Tramites en linea</span>
                    </a>
                
                    <ul class="collapse" id="tramites">
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Solicitudes Ciudadanas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Estado de trámite
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Correspondencia Menu Item -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#correspondencia" 
                       role="button" aria-expanded="false" aria-controls="correspondencia">
                        <i class="ti ti-mail me-2 fs-4 mb-1"></i>
                        <span>Correspondencia</span>
                    </a>
                
                    <ul class="collapse" id="correspondencia">
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Recibida
                            </a>
                        </li>
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Enviada
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Seccion Gestion Interna -->
                <li class="menu-title">
                    <span>Gestión Interna</span>
                </li>
                
                <!-- RR.HH Menu Item -->
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#rrhh" 
                       role="button" aria-expanded="false" aria-controls="rrhh">
                        <i class="ti ti-users me-2 fs-4 mb-1"></i>
                        <span>Recursos Humanos</span>
                    </a>
                
                    <ul class="collapse" id="rrhh">
                        <li>
                            <a href="{{route('workers.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Funcionarios
                            </a>
                        </li>
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Contratos
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Vehiculos Menu Item -->
                
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#vehiculos" 
                       role="button" aria-expanded="false" aria-controls="vehiculos">
                        <i class="ti ti-car me-2 fs-4 mb-1"></i>
                        <span>Viajes, vehículos y cometidos</span>
                    </a>
                
                    <ul class="collapse" id="vehiculos">
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Solicitudes
                            </a>
                        </li>
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Autorizaciones
                            </a>
                        </li>
                        <li>
                            <a href="{{route('incidents.index')}}">
                                <i class="ti ti-point me-2"></i>
                                Reportes
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Marcacion Menu Item -->
                <li class="no-sub">
                    <a class="nav-link" href="{{route('records.index')}}">
                        <i class="ti ti-fingerprint me-2 fs-4 mb-1"></i>
                        Marcacion
                    </a>
                </li>
                
                <li class="menu-title">
                    <span>Configuraciones</span>
                </li>
                
                <!-- Areas Menu Item -->
                <li class="no-sub">
                    <a class="nav-link" href="{{route('areas.index')}}">
                        <svg stroke="currentColor" stroke-width="1.5" class="me-2">
                            <use xlink:href="../assets/svg/_sprite.svg#squares"></use>
                        </svg>
                       Areas
                    </a>
                </li>
                
                <!-- Posiciones Menu Item -->
                <li class="no-sub">
                    <a class="nav-link" href="{{route('positions.index')}}">
                        <svg stroke="currentColor" stroke-width="1.5" class="me-2">
                            <use xlink:href="../assets/svg/_sprite.svg#briefcase"></use>
                        </svg>
                        Posiciones (cargos)
                    </a>
                </li>
                
            @else
                <li class="menu-title">
                    <span class="text-danger">⚠ No tienes municipalidad asignada</span>
                </li>
            
            @endif

            
        </ul>
    </div>

    <div class="menu-navs">
        <span class="menu-previous"><i class="ti ti-chevron-left"></i></span>
        <span class="menu-next"><i class="ti ti-chevron-right"></i></span>
    </div>
</nav>

<!-- CSS adicional para mejorar la navegación -->
<style>
.nav-submenu {
    padding-left: 1rem;
    background-color: rgba(0,0,0,0.05);
}

.nav-profile { 
  overflow: visible !important; 
}

.profile-menu-dropdown { 
  position: relative; 
  overflow: visible; 
}

.profile-menu-dropdown .dropdown-menu { 
  z-index: 1080; 
}

.nav-submenu .nav-link {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    color: var(--bs-secondary);
}

.nav-submenu .nav-link:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background-color: rgba(var(--bs-primary-rgb), 0.1);
    color: var(--bs-primary);
}

.nav-link svg {
    width: 18px;
    height: 18px;
}

.menu-title {
    padding: 1rem 1rem 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: var(--bs-secondary);
    letter-spacing: 0.5px;
}

.collapsed .ti-chevron-down {
    transform: rotate(-90deg);
    transition: transform 0.3s ease;
}

.nav-link[aria-expanded="true"] .ti-chevron-down {
    transform: rotate(0deg);
}

/* Fuerza un pequeño margen inferior respecto al toggle */
#profileDropdown + .dropdown-menu { margin-top: .5rem; }



</style>

<!-- JavaScript para mejorar la funcionalidad -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mejorar el comportamiento del collapse
    const collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
    
    collapseElements.forEach(element => {
        element.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('href'));
            const icon = this.querySelector('.ti-chevron-down');
            
            if (target.classList.contains('show')) {
                icon.style.transform = 'rotate(-90deg)';
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        });
    });

    // Marcar el item activo basado en la URL actual
    const currentUrl = window.location.href;
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        if (link.href && currentUrl.includes(link.href)) {
            link.classList.add('active');
            // Si es un submenu, expandir el padre
            const parentCollapse = link.closest('.collapse');
            if (parentCollapse) {
                parentCollapse.classList.add('show');
                const parentToggle = document.querySelector(`[href="#${parentCollapse.id}"]`);
                if (parentToggle) {
                    parentToggle.setAttribute('aria-expanded', 'true');
                    const icon = parentToggle.querySelector('.ti-chevron-down');
                    if (icon) {
                        icon.style.transform = 'rotate(0deg)';
                    }
                }
            }
        }
    });
});
</script>
<!-- Menu Navigation ends -->
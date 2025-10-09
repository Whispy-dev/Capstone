@extends('layout.master')
@section('title', 'Panel de Control')
@section('css')
    <!-- Bootstrap CSS ya incluido en master -->
@endsection

@section('main-content')
    <div class="container-fluid">
        <!-- Alerta de Bienvenida -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-primary alert-dismissible" role="alert">
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-0">
                            <i class="ti ti-info-circle me-2"></i>
                            ¡Bienvenido al Panel de Control! Aquí puedes monitorear todos tus incidentes y actividades.
                        </p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Columna Principal Izquierda -->
            <div class="col-lg-8">
                <!-- Resumen de Incidentes -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card overview-details-box b-s-3-primary">
                            <div class="card-body">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <span class="bg-primary h-60 w-60 d-flex-center flex-column rounded-3 text-white">
                                        <span class="f-w-500">Inc</span>
                                        <span>{{ $incidentesAbiertos }}</span>
                                    </span>
                                    <div>
                                        <p class="text-dark f-w-600 txt-ellipsis-1">Incidentes Abiertos</p>
                                        <span class="badge bg-primary b-r-50">
                                            Total: {{ $incidentesAbiertos }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-dark f-w-500 txt-ellipsis-1 mb-1">Estado</p>
                                        <h6 class="mb-0 text-primary">Activos</h6>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-dark f-w-500 txt-ellipsis-1 mb-1">Prioridad</p>
                                        <h6 class="mb-0 text-primary">Alta</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card overview-details-box b-s-3-success">
                            <div class="card-body">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <span class="bg-success h-60 w-60 d-flex-center flex-column rounded-3 text-white">
                                        <span class="f-w-500">Res</span>
                                        <span>{{ $incidentesResueltos }}</span>
                                    </span>
                                    <div>
                                        <p class="text-dark f-w-600 txt-ellipsis-1">Incidentes Resueltos</p>
                                        <span class="badge bg-success b-r-50">
                                            Total: {{ $incidentesResueltos }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-dark f-w-500 txt-ellipsis-1 mb-1">Tiempo Promedio</p>
                                        <h6 class="mb-0 text-success">
                                            {{ $tiempoPromedioResolucion ? round($tiempoPromedioResolucion) . 'min' : 'N/A' }}
                                        </h6>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-dark f-w-500 txt-ellipsis-1 mb-1">Eficiencia</p>
                                        <h6 class="mb-0 text-success">{{ $incidentesResueltos > 0 ? round(($incidentesResueltos / ($incidentesAbiertos + $incidentesResueltos + $incidentesPendientes)) * 100) . '%' : '0%' }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <div class="card overview-details-box b-s-3-warning">
                            <div class="card-body">
                                <div class="d-flex gap-3 align-items-center mb-3">
                                    <span class="bg-warning h-60 w-60 d-flex-center flex-column rounded-3 text-dark">
                                        <span class="f-w-500">Pen</span>
                                        <span>{{ $incidentesPendientes }}</span>
                                    </span>
                                    <div>
                                        <p class="text-dark f-w-600 txt-ellipsis-1">Incidentes Pendientes</p>
                                        <span class="badge bg-warning b-r-50">
                                            Total: {{ $incidentesPendientes }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <p class="text-dark f-w-500 txt-ellipsis-1 mb-1">En Revisión</p>
                                        <h6 class="mb-0 text-warning">{{ $incidentesPendientes }}</h6>
                                    </div>
                                    <div class="col-6">
                                        <p class="text-dark f-w-500 txt-ellipsis-1 mb-1">Esperando</p>
                                        <h6 class="mb-0 text-warning">Respuesta</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Segunda Fila - Gráficos y Estadísticas -->
                <div class="row">
                    <!-- Incidentes por Prioridad -->
                    <div class="col-md-8 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Incidentes por Prioridad</h6>
                                </div>
                                <div class="row">
                                    @forelse($incidentesPorTipo as $tipo)
                                    <div class="col-sm-4 mb-3">
                                        <div class="project-status-card 
                                            @if(in_array(strtolower($tipo->priority), ['high', 'alta', 'crítica', 'critica'])) bg-danger 
                                            @elseif(in_array(strtolower($tipo->priority), ['medium', 'media', 'normal'])) bg-warning 
                                            @else bg-success @endif 
                                            text-center w-100 rounded p-3 shadow">
                                            <span class="bg-white h-45 w-45 d-flex-center b-r-50 status-icon">
                                                <i class="ti ti-alert-triangle f-s-20 
                                                    @if(in_array(strtolower($tipo->priority), ['high', 'alta', 'crítica', 'critica'])) text-danger 
                                                    @elseif(in_array(strtolower($tipo->priority), ['medium', 'media', 'normal'])) text-warning 
                                                    @else text-success @endif"></i>
                                            </span>
                                            <p class="text-white mb-0 txt-ellipsis-1 mt-2">
                                                {{ $tipo->priority ? ucfirst($tipo->priority) : 'Sin prioridad' }}
                                            </p>
                                            <h4 class="text-white">{{ $tipo->total }}</h4>
                                        </div>
                                    </div>
                                    @empty
                                    <div class="col-12 text-center">
                                        <p class="text-muted">No hay datos de prioridad disponibles</p>
                                    </div>
                                    @endforelse
                                </div>

                                <div class="mt-4">
                                    <h6>Resumen de Actividades</h6>
                                    <ul class="list-unstyled">
                                        <li class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary-200 d-flex-center p-1 w-30 h-30 b-r-8 flex-shrink-0">
                                                    <i class="ti ti-plus text-primary"></i>
                                                </div>
                                                <p class="text-dark-800 mb-0 f-w-500 f-s-15 txt-ellipsis-1 ms-2">Nuevos Incidentes Hoy</p>
                                            </div>
                                            <span class="badge bg-primary">{{ $incidentesAbiertos }}</span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-success-200 d-flex-center p-1 w-30 h-30 b-r-8 flex-shrink-0">
                                                    <i class="ti ti-check text-success"></i>
                                                </div>
                                                <p class="text-dark-800 mb-0 f-w-500 f-s-15 txt-ellipsis-1 ms-2">Resueltos Esta Semana</p>
                                            </div>
                                            <span class="badge bg-success">{{ $incidentesResueltos }}</span>
                                        </li>
                                        <li class="d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-warning-200 d-flex-center p-1 w-30 h-30 b-r-8 flex-shrink-0">
                                                    <i class="ti ti-clock text-warning"></i>
                                                </div>
                                                <p class="text-dark-800 mb-0 f-w-500 f-s-15 txt-ellipsis-1 ms-2">En Proceso</p>
                                            </div>
                                            <span class="badge bg-warning">{{ $incidentesPendientes }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estadísticas Generales -->
                    <div class="col-md-4 mb-4">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="card project-profit-card">
                                    <div class="card-body">
                                        <div class="profit-arrow">
                                            <span class="bg-white text-primary h-45 w-45 d-flex-center">
                                                <i class="ti ti-trending-up f-s-18"></i>
                                            </span>
                                        </div>
                                        <span class="bg-primary h-45 w-45 d-flex-center b-r-50">
                                            <i class="ti ti-chart-line f-s-24"></i>
                                        </span>
                                        <div class="mt-3">
                                            <h4 class="text-dark">{{ $incidentesResueltos + $incidentesAbiertos + $incidentesPendientes }}</h4>
                                            <p class="f-w-500 mb-0 txt-ellipsis-1">Total de Incidentes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card bg-primary">
                                    <div class="card-body">
                                        <i class="ti ti-clock icon-bg"></i>
                                        <span class="bg-white h-50 w-50 d-flex-center b-r-50">
                                            <i class="ti ti-clock text-primary f-s-24"></i>
                                        </span>
                                        <div class="mt-3">
                                            <h4 class="text-white">{{ round($tiempoPromedioResolucion ?? 0) }}</h4>
                                            <p class="f-w-500 mb-0 txt-ellipsis-1 text-white">Minutos Promedio</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Lateral Derecha -->
            <div class="col-lg-4">
                <!-- Próximas Reuniones -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-3">Próximas Reuniones</h5>
                        @if($proximasReuniones->count() > 0)
                            @foreach($proximasReuniones->take(3) as $reunion)
                            <div class="meeting-details-box d-flex align-items-center mb-3">
                                <div class="h-40 w-40 d-flex-center b-r-50 overflow-hidden bg-primary text-white flex-shrink-0">
                                    {{ substr($reunion->title, 0, 2) }}
                                </div>
                                <div class="flex-grow-1 ps-2 text-start">
                                    <div class="fw-medium txt-ellipsis-1">{{ $reunion->title }}</div>
                                    <div class="text-muted f-s-12 txt-ellipsis-1">
                                        {{ \Carbon\Carbon::parse($reunion->start)->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                                <span class="badge bg-primary">Programada</span>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center text-muted">
                                <p>No hay reuniones programadas</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Distribución por Áreas -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 txt-ellipsis-1">Incidentes por Área</h6>
                        </div>
                        <div>
                            @forelse($incidentesPorArea as $area)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <p class="mb-0 txt-ellipsis-1">
                                    <i class="ti ti-circle-filled text-primary f-s-10"></i> 
                                    {{ $area->user->name ?? 'Usuario ' . $area->user_id }}
                                </p>
                                <p class="text-secondary txt-ellipsis-1 mb-0 flex-grow-1 mx-2"> 
                                    ------------------------ 
                                </p>
                                <span>{{ $area->total }}</span>
                            </div>
                            @empty
                            <div class="text-center text-muted">
                                <p>No hay datos por área disponibles</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-3 text-center">Acciones Rápidas</h6>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#incidentModal">
                                    <i class="ti ti-plus mb-2"></i><br>
                                    Nuevo Incidente
                                </button>
                            </div>
                            <div class="col-6 mb-3">
                                <a href="{{ route('incidents.index') ?? '#' }}" class="btn btn-success w-100">
                                    <i class="ti ti-list mb-2"></i><br>
                                    Ver Incidentes
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('events.create') ?? '#' }}" class="btn btn-info w-100">
                                    <i class="ti ti-calendar mb-2"></i><br>
                                    Nueva Reunión
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="" class="btn btn-warning w-100">
                                    <i class="ti ti-chart-bar mb-2"></i><br>
                                    Reportes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para crear incidente -->
        <div class="modal fade" id="incidentModal" tabindex="-1" aria-labelledby="incidentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('incidents.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="incidentModalLabel">Nueva Incidencia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="title" class="form-label">Título</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Categoría</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled selected>— Selecciona una categoría —</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="assigned_id" class="form-label">Asignar a <span class="text-danger">*</span></label>
                                <select name="assigned_id" id="assigned_id" class="form-select" required>
                                    <option value="" disabled selected>— Selecciona un usuario —</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label><button type="button" class="btn btn-secondary btn-sm" onclick="consultarIA()" style="float: right;">Consultar IA</button>
                                <div class="spinner-border text-primary" role="status" id="spinner" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <textarea name="description" id="description" class="form-control" rows="6" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Estado</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="open">Abierto</option>
                                    <option value="pending">Pendiente</option>
                                    <option value="resuelto">Resuelto</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="priority" class="form-label">Prioridad</label>
                                <select name="priority" id="priority" class="form-control">
                                    <option value="low">Baja</option>
                                    <option value="medium">Media</option>
                                    <option value="high">Alta</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Crear Incidencia</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Bootstrap JS ya incluido en master -->
<script>
    function consultarIA() {
        const spinner = document.getElementById("spinner");
        // Variable que contiene la consulta
        const ask = document.getElementById('title').value;
        
        // Mostrar spinner
        spinner.style.display = "block";

        // Realizar la solicitud AJAX GET
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `https://www.cimun.cl/ia?ask=${encodeURIComponent(ask)}`, true);
        
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                spinner.style.display = "none";
              // Éxito: procesar la respuesta
              document.getElementById('description').value = xhr.responseText;
              console.log("Respuesta del servidor:", xhr.responseText);
            } else {
              // Error: manejar el fallo
              console.error("Error en la solicitud:", xhr.status);
            }
          }
        };
        
        xhr.send();
    }
</script>
    
@endsection
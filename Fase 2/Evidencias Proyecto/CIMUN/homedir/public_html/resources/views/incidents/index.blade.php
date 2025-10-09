@extends('layout.master')
@section('title', 'Sistema de Incidencias Municipales')
@section('css')
    <!-- slick css -->
    <link rel="stylesheet" href="{{asset('assets/vendor/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/slick/slick-theme.css')}}">
    
    <!-- Data Table css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatable/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatable/datatable2/buttons.dataTables.min.css')}}">
    
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        .priority-high { color: #dc3545 !important; font-weight: bold; }
        .priority-medium { color: #ffc107 !important; font-weight: bold; }
        .priority-low { color: #28a745 !important; font-weight: bold; }
        
        .status-open { 
            background-color: #007bff; 
            color: white; 
            padding: 0.25rem 0.5rem; 
            border-radius: 0.375rem; 
            font-size: 0.75rem;
        }
        .status-pending { 
            background-color: #ffc107; 
            color: #212529; 
            padding: 0.25rem 0.5rem; 
            border-radius: 0.375rem; 
            font-size: 0.75rem;
        }
        .status-closed { 
            background-color: #6c757d; 
            color: white; 
            padding: 0.25rem 0.5rem; 
            border-radius: 0.375rem; 
            font-size: 0.75rem;
        }
        
        .incident-card {
            transition: transform 0.2s;
        }
        
        .incident-card:hover {
            transform: translateY(-2px);
        }
        
        .stats-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .action-buttons {
            white-space: nowrap;
        }

        .action-buttons .btn {
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
        }

        #incidentsTable {
            font-size: 0.875rem;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .toast-container { z-index: 1080; }
    </style>
@endsection

@section('main-content')
    <div class="container-fluid">
        <!-- Breadcrumb start -->
        <div class="row m-1">
            <div class="col-12">
                <h4 class="main-title">Sistema de Incidencias Municipales</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li>
                        <a href="{{ route('dashboard.index') }}" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-house f-s-16"></i> Dashboard</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Incidencias</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb end -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif



        <!-- Statistics Cards -->
        <div class="row ticket-app mb-4">
            <div class="col-lg-3 col-sm-6">
                <div class="card incident-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-icon bg-white bg-opacity-20">
                                    <i class="ph-bold ph-ticket f-s-25 text-white"></i>
                                </div>
                                <h6 class="mb-1">Total Incidencias</h6>
                                <h3 class="mb-0">{{ $statistics['all_tickets'] ?? 0 }}</h3>
                                <small class="opacity-75">Total registradas</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-primary">Total</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <div class="card incident-card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-icon bg-white bg-opacity-20">
                                    <i class="ph-bold ph-folder-open f-s-25 text-white"></i>
                                </div>
                                <h6 class="mb-1">Abiertas</h6>
                                <h3 class="mb-0">{{ $statistics['open_tickets'] ?? 0 }}</h3>
                                <small class="opacity-75">Sin asignar</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-info">Nuevas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <div class="card incident-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-icon bg-white bg-opacity-20">
                                    <i class="ph-bold ph-clock-countdown f-s-25 text-white"></i>
                                </div>
                                <h6 class="mb-1">En Proceso</h6>
                                <h3 class="mb-0">{{ $statistics['pending_tickets'] ?? 0 }}</h3>
                                <small class="opacity-75">En progreso</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-warning">Activas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <div class="card incident-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-icon bg-white bg-opacity-20">
                                    <i class="ph-bold ph-check-circle f-s-25 text-white"></i>
                                </div>
                                <h6 class="mb-1">Cerradas</h6>
                                <h3 class="mb-0">{{ $statistics['closed_tickets'] ?? 0 }}</h3>
                                <small class="opacity-75">Completadas</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-success">Resueltas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Create Incident Card -->
            <div class="col-lg-6">
                <div class="card create-ticket-card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-sm-7">
                                <div class="ticket-create">
                                    <h5 class="mb-2">Gestión de Incidencias</h5>
                                    <p class="mb-4 text-secondary">
                                        Registra, asigna y da seguimiento a los incidentes municipales. 
                                        Coordina la respuesta entre departamentos y mantén informados a los ciudadanos.
                                    </p>
                                    <button type="button" class="btn btn-primary me-2" id="create_incident_btn" data-bs-toggle="modal" data-bs-target="#incidentModal">
                                        <i class="ph-duotone ph-plus me-1"></i>
                                        Nueva Incidencia
                                    </button>

                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#bulkImportModal">
                                        <i class="ph-duotone ph-upload me-1"></i>
                                        Importar
                                    </button>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <img src="{{asset('../assets/images/icons/ticket.png')}}" alt="" class="img-fluid w-100 d-block m-auto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Resumen por Prioridad</h5>
                        <small class="text-muted">Distribución actual</small>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <div class="mb-3">
                                    <i class="ph-duotone ph-warning-circle f-s-30 text-danger mb-2"></i>
                                    <h4 class="mb-0 text-danger">{{ $statistics['high_priority'] ?? 0 }}</h4>
                                    <small class="text-muted">Alta Prioridad</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <i class="ph-duotone ph-info f-s-30 text-warning mb-2"></i>
                                    <h4 class="mb-0 text-warning">{{ $statistics['medium_priority'] ?? 0 }}</h4>
                                    <small class="text-muted">Media Prioridad</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <i class="ph-duotone ph-check-circle f-s-30 text-success mb-2"></i>
                                    <h4 class="mb-0 text-success">{{ $statistics['low_priority'] ?? 0 }}</h4>
                                    <small class="text-muted">Baja Prioridad</small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0">Listado de Incidencias</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex gap-2 justify-content-md-end">
                                    <select class="form-select form-select-sm" id="statusFilter" style="width: auto;">
                                        <option value="">Todos los estados</option>
                                        <option value="open">Abierto</option>
                                        <option value="pending">En Proceso</option>
                                        <option value="closed">Cerrado</option>
                                    </select>
                                    <select class="form-select form-select-sm" id="priorityFilter" style="width: auto;">
                                        <option value="">Todas las prioridades</option>
                                        <option value="high">Alta</option>
                                        <option value="medium">Media</option>
                                        <option value="low">Baja</option>
                                    </select>
                                    <button class="btn btn-sm btn-outline-primary" id="exportBtn">
                                        <i class="ph-duotone ph-download me-1"></i>
                                        Exportar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive app-scroll app-datatable-default">
                            <table id="incidentsTable" class="table table-striped table-hover w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;">
                                            <div class="checkbox-wrapper">
                                                <label class="check-box m-0">
                                                    <input type="checkbox" id="select-all">
                                                    <span class="checkmark outline-secondary"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th style="width: 60px;">ID</th>
                                        <th style="width: 80px;">Usuario</th>
                                        <th style="width: 300px;">Título</th>
                                        <th style="width: 100px;">Estado</th>
                                        <th style="width: 90px;">Prioridad</th>
                                        <th style="width: 120px;">Creado</th>
                                        <th style="width: 120px;">Actualizado</th>
                                        <th style="width: 180px;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incidents as $incident)
                                    <tr id="incident-{{ $incident->id }}">
                                        <td>
                                            <div class="checkbox-wrapper">
                                                <label class="check-box m-0">
                                                    <input type="checkbox" value="{{ $incident->id }}">
                                                    <span class="checkmark outline-secondary"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">#{{ $incident->id }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title bg-primary rounded-circle">
                                                        {{ strtoupper(substr($incident->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 f-s-14">{{ $incident->user->name ?? 'Sin asignar' }}</h6>
                                                    <small class="text-muted">{{ $incident->user->email ?? '' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <h6 class="mb-1 f-s-14">{{ Str::limit($incident->title, 50) }}</h6>
                                                @if($incident->description)
                                                <small class="text-muted">{{ Str::limit($incident->description, 80) }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td data-search="{{ $incident->status }}">
                                            <span class="badge status-{{ $incident->status }}">
                                                @switch($incident->status)
                                                    @case('open')    🔵 Abierto @break
                                                    @case('pending') 🟡 En Proceso @break
                                                    @case('closed')  ⚫ Cerrado @break
                                                    @default         {{ ucfirst($incident->status) }}
                                                @endswitch
                                            </span>
                                        </td>
                                        <td data-search="{{ $incident->priority }}">
                                            <span class="priority-{{ $incident->priority }}">
                                                @switch($incident->priority)
                                                    @case('high')   🔴 Alta @break
                                                    @case('medium') 🟡 Media @break
                                                    @case('low')    🟢 Baja @break
                                                    @default        {{ ucfirst($incident->priority) }}
                                                @endswitch
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $incident->created_at ? $incident->created_at->format('d/m/Y H:i') : 'N/A' }}
                                            </small>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $incident->updated_at ? $incident->updated_at->format('d/m/Y H:i') : 'N/A' }}
                                            </small>
                                        </td>
                                        <td>
                                           
                                            <div class="action-buttons">
                                                <a href="{{ route('incidents.show', $incident->id) }}" class="btn btn-sm btn-info" title="Ver detalles">
                                                    <i class="ph-duotone ph-eye"></i>
                                                </a>
                                                     @if(Auth::check() && Auth::user()->is_manager)
    
                                                    <button class="btn btn-sm btn-warning edit-incident" data-id="{{ $incident->id }}" title="Editar">
                                                        <i class="ph-duotone ph-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success change-status" data-id="{{ $incident->id }}" data-status="{{ $incident->status }}" title="Cambiar estado">
                                                        <i class="ph-duotone ph-arrows-clockwise"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger delete-incident" data-id="{{ $incident->id }}" title="Eliminar">
                                                        <i class="ph-duotone ph-trash"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </td>   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para crear/editar incidencia -->
    <div class="modal fade" id="incidentModal" tabindex="-1" aria-labelledby="incidentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-white" id="incidentModalLabel">Nueva Incidencia</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="incidentForm">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Título <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Describe brevemente la incidencia" required>
                                </div>
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


                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label><button type="button" class="btn btn-secondary btn-sm" onclick="consultarIA()" style="float: right;">Consultar IA</button>
                                    <div class="spinner-border text-primary" role="status" id="spinner" style="display: none;">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <textarea name="description" id="description" class="form-control" rows="6" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Prioridad <span class="text-danger">*</span></label>
                                    <select class="form-select" name="priority" id="priority" required>
                                        <option value="">Seleccionar Prioridad</option>
                                        <option value="low">🟢 Baja</option>
                                        <option value="medium" selected>🟡 Media</option>
                                        <option value="high">🔴 Alta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Estado <span class="text-danger">*</span></label>
                                    <select class="form-select" name="status" id="status" required>
                                        <option value="">Seleccionar Estado</option>
                                        <option value="open" selected>🔵 Abierto</option>
                                        <option value="pending">🟡 Pendiente</option>
                                        <option value="closed">⚫ Cerrado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ph-duotone ph-floppy-disk me-1"></i>
                            <span id="submitBtnText">Crear Incidencia</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para importación masiva -->
    <div class="modal fade" id="bulkImportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Importar Incidencias Masivamente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Archivo CSV/Excel</label>
                        <input type="file" class="form-control" accept=".csv,.xlsx,.xls">
                    </div>
                    <div class="alert alert-info">
                        <small>
                            <strong>Formato requerido:</strong> Título, Descripción, Prioridad (low/medium/high), Estado (open/pending/closed)
                        </small>
                    </div>
                    <div class="text-center">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="ph-duotone ph-download me-1"></i>
                            Descargar Plantilla
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Importar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmación de eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="ph-duotone ph-warning-circle f-s-48 text-danger"></i>
                    </div>
                    <h5 class="text-danger">¿Eliminar Incidencia?</h5>
                    <p class="text-muted">Esta acción no se puede deshacer. La incidencia se eliminará permanentemente del sistema.</p>
                    <div class="mt-4">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">
                            <i class="ph-duotone ph-trash me-1"></i>
                            Sí, Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para cambio de estado rápido -->
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Estado de Incidencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="statusForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nuevo Estado</label>
                            <select class="form-select" name="status" id="newStatus" required>
                                <option value="open">🔵 Abierto</option>
                                <option value="pending">🟡 En Proceso</option>
                                <option value="closed">⚫ Cerrado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Comentario (Opcional)</label>
                            <textarea class="form-control" name="comment" rows="3" placeholder="Agrega un comentario sobre el cambio de estado..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Estado</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- slick-file -->
    <script src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
    
    <!-- data table js-->
    <script src="{{asset('assets/vendor/datatable/jquery.dataTables.min.js')}}"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
    <!-- SweetAlert2 para notificaciones -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.32/sweetalert2.min.js"></script>


    <script>
    $(document).ready(function() {
        let currentIncidentId = null;
        
        // Inicializar DataTable
        let table = $('#incidentsTable').DataTable({
            responsive: true,
            pageLength: 25,
            order: [[1, 'desc']], // Ordenar por ID descendente
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            columnDefs: [
                { orderable: false, targets: [0, 8] }, // Deshabilitar ordenamiento en checkbox y acciones
                { className: "text-center", targets: [0, 1, 4, 5, 8] }
            ]
        });

        // Filtros
        (function () {
          let table = $.fn.dataTable.isDataTable('#incidentsTable')
            ? $('#incidentsTable').DataTable()
            : $('#incidentsTable').DataTable({
                pageLength: 10,
                order: [[1, 'desc']], // por ID
                language: { url: '//cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json' }
              });
        
          // 2) Filtro global (solo para esta tabla) leyendo data-search de las celdas
          if (!window._incidentsFilterFn) {
            window._incidentsFilterFn = function (settings, data, dataIndex) {
              // Aplica solo a #incidentsTable
              if (settings.nTable.getAttribute('id') !== 'incidentsTable') return true;
        
              const statusVal   = $('#statusFilter').val();   // open|pending|closed|''
              const priorityVal = $('#priorityFilter').val(); // high|medium|low|''
        
              const rowNode = table.row(dataIndex).node();
              // Estado = col 4, Prioridad = col 5 (0-based)
              const statusRaw   = $('td:eq(4)', rowNode).attr('data-search') || '';
              const priorityRaw = $('td:eq(5)', rowNode).attr('data-search') || '';
        
              const statusOK   = !statusVal   || statusRaw   === statusVal;
              const priorityOK = !priorityVal || priorityRaw === priorityVal;
        
              return statusOK && priorityOK;
            };
            $.fn.dataTable.ext.search.push(window._incidentsFilterFn);
          }
        
          // 3) Handlers de cambios (namespaced para no duplicar)
          $('#statusFilter').off('change.dtfilter').on('change.dtfilter', function () {
            table.draw();
          });
          $('#priorityFilter').off('change.dtfilter').on('change.dtfilter', function () {
            table.draw();
          });
        })();


    
        // Crear incidencia
        $('#create_incident_btn').on('click', function() {
            $('#incidentModalLabel').text('Nueva Incidencia Municipal');
            $('#submitBtnText').text('Crear Incidencia');
            $('#incidentForm')[0].reset();
            $('#priority').val('medium');
            $('#status').val('open');
            currentIncidentId = null;
            enableIncidentForm();
        });
    
        // Envío del formulario
        $('#incidentForm').on('submit', function(e) {
          e.preventDefault();
        
          // Candado anti doble envío
          if ($(this).data('submitting')) return;
          $(this).data('submitting', true);
        
          const form = this;
          const formData = new FormData(form);
          const url = currentIncidentId 
              ? `{{ url('/incidencias') }}/${currentIncidentId}` 
              : '{{ route("incidents.store") }}';
          if (currentIncidentId) formData.append('_method', 'PUT');
        
          const submitBtn = $('#incidentForm button[type="submit"]');
          const originalText = submitBtn.html();
          submitBtn.html('<i class="ph-duotone ph-circle-notch ph-spin me-1"></i> Guardando...')
                   .prop('disabled', true);
        
          $.ajax({
            url, method: 'POST', data: formData, processData: false, contentType: false
          }).done(function(response){
            // cierra modal y feedback
            $('#incidentModal').modal('hide');
            $('#incidentModal').on('hidden.bs.modal', function () {
              restoreScroll();
            });

            Swal.fire({ title: '¡Éxito!', text: response.message, icon: 'success', timer: 2500, showConfirmButton: false, didClose: () => restoreScroll() });
            // refresca tabla según tu lógica actual
          }).fail(function(xhr){
            const msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Error al crear la incidencia';
            Swal.fire({ title: 'Error', text: msg, icon: 'error' });
          }).always(function(){
            // liberar candado y botón
            $(form).data('submitting', false);
            submitBtn.prop('disabled', false).html(originalText);
            // limpieza defensiva por si queda backdrop
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css({ overflow: '', paddingRight: '' });
            $('.loader-wrapper').hide();
            restoreScroll();
          });
        });

    
        // Ver incidencia
        $(document).on('click', '.view-incident', function() {
            const id = $(this).data('id');
            $.get(`{{ url('/incidencias') }}/${id}`, function(response) {
                const incident = response.data;
                fillIncidentForm(incident, true);
                $('#incidentModalLabel').text('Ver Incidencia #' + incident.id);
                $('#submitBtnText').text('Cerrar');
                $('#incidentModal').modal('show');
            }).fail(function() {
                Swal.fire({ title: 'Error', text: 'No se pudo cargar la incidencia', icon: 'error' });
            });
        });
    
        // Editar incidencia
        $(document).on('click', '.edit-incident', function() {
            const id = $(this).data('id');
            $.get(`{{ url('/incidencias') }}/${id}`, function(response) {
                const incident = response.data;
                fillIncidentForm(incident, false);
                $('#incidentModalLabel').text('Editar Incidencia #' + incident.id);
                $('#submitBtnText').text('Actualizar Incidencia');
                $('#incidentModal').modal('show');
                currentIncidentId = incident.id;
            }).fail(function() {
                Swal.fire({ title: 'Error', text: 'No se pudo cargar la incidencia', icon: 'error' });
            });
        });
    
        // Eliminar incidencia
        $(document).on('click', '.delete-incident', function() {
            currentIncidentId = $(this).data('id');
            $('#deleteModal').modal('show');
        });
    
        $('#confirmDelete').on('click', function() {
            const btn = $(this);
            const originalText = btn.html();
            btn.html('<i class="ph-duotone ph-circle-notch ph-spin me-1"></i> Eliminando...').prop('disabled', true);
    
            $.ajax({
                url: `{{ url('/incidencias') }}/${currentIncidentId}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function(response) {
                    $('#deleteModal').modal('hide');
                    table.row($(`#incident-${currentIncidentId}`)).remove().draw();
                    Swal.fire({ 
                        title: 'Eliminado', 
                        text: response.message, 
                        icon: 'success', 
                        timer: 2000, 
                        showConfirmButton: false 
                    });
                },
                error: function() {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar la incidencia', icon: 'error' });
                },
                complete: function() {
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });
    
        // Cambio rápido de estado
        $(document).on('click', '.change-status', function() {
            currentIncidentId = $(this).data('id');
            $('#newStatus').val($(this).data('status'));
            $('#statusModal').modal('show');
        });
    
        $('#statusForm').on('submit', function(e) {
            e.preventDefault();
            const btn = $(this).find('button[type="submit"]');
            const originalText = btn.html();
            btn.html('<i class="ph-duotone ph-circle-notch ph-spin me-1"></i> Actualizando...').prop('disabled', true);
    
            $.ajax({
                url: `{{ url('/incidencias') }}/${currentIncidentId}/status`,
                method: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: $('#newStatus').val(),
                    comment: $('textarea[name="comment"]').val()
                },
                success: function(response) {
                    $('#statusModal').modal('hide');
                    
                    // Recargar la fila actualizada
                    $.get(`{{ url('/incidencias') }}/${currentIncidentId}`, function(incidentResponse) {
                        const incident = incidentResponse.data;
                        table.row($(`#incident-${currentIncidentId}`)).remove().draw();
                        table.row.add($(generateRowHTML(incident))).draw();
                    });
                    
                    Swal.fire({ 
                        title: 'Estado Actualizado', 
                        text: response.message, 
                        icon: 'success', 
                        timer: 2000, 
                        showConfirmButton: false 
                    });
                    $('#statusForm')[0].reset();
                },
                error: function() {
                    Swal.fire({ title: 'Error', text: 'No se pudo actualizar el estado', icon: 'error' });
                },
                complete: function() {
                    btn.html(originalText).prop('disabled', false);
                }
            });
        });
    
        // Exportar datos
        $('#exportBtn').on('click', function() {
            const btn = $(this);
            const originalText = btn.html();
            btn.html('<i class="ph-duotone ph-circle-notch ph-spin me-1"></i> Exportando...').prop('disabled', true);
            
            setTimeout(() => {
                window.location.href = '{{ route("incidents.export") }}';
                btn.html(originalText).prop('disabled', false);
            }, 1000);
        });
    
        // Select all checkboxes
        $('#select-all').on('change', function() {
            const isChecked = $(this).is(':checked');
            $('#incidentsTable tbody input[type="checkbox"]').prop('checked', isChecked);
        });

        // Individual checkbox change
        $(document).on('change', '#incidentsTable tbody input[type="checkbox"]', function() {
            const totalCheckboxes = $('#incidentsTable tbody input[type="checkbox"]').length;
            const checkedCheckboxes = $('#incidentsTable tbody input[type="checkbox"]:checked').length;
            
            $('#select-all').prop('checked', totalCheckboxes === checkedCheckboxes);
        });
    
        // Funciones auxiliares
        function fillIncidentForm(incident, readOnly = false) {
            $('#title').val(incident.title).prop('readonly', readOnly);
            $('#description').val(incident.description || '').prop('readonly', readOnly);
            $('#priority').val(incident.priority).prop('disabled', readOnly);
            $('#status').val(incident.status).prop('disabled', readOnly);
            
            if (readOnly) {
                $('#incidentForm button[type="submit"]').hide();
            } else {
                $('#incidentForm button[type="submit"]').show();
            }
        }
        
        function restoreScroll() {
          // Limpia backdrops de Bootstrap (modal u offcanvas)
          $('.modal-backdrop, .offcanvas-backdrop').remove();
        
          // Quita clases que bloquean scroll
          $('body').removeClass('modal-open overflow-hidden');
          $('html').removeClass('overflow-hidden');
        
          // Quita estilos inline que a veces deja Bootstrap
          $('body, html').css({ overflow: '', paddingRight: '' });
        
          // Si tienes wrapper con overflow bloqueado, desbloquéalo
          $('.app-wrapper, .app-content').css({ overflow: '', overflowY: '' });
        
          // Por si algún loader quedó encima
          $('.loader-wrapper').hide();
        }

    
        function enableIncidentForm() {
            $('#title, #description').prop('readonly', false);
            $('#priority, #status').prop('disabled', false);
            $('#incidentForm button[type="submit"]').show();
        }
    
        function generateRowHTML(incident) {
            const statusBadge = getStatusBadge(incident.status);
            const priorityText = getPriorityText(incident.priority);
            const userName = incident.user ? incident.user.name : 'Sin asignar';
            const userEmail = incident.user ? incident.user.email : '';
            const userInitial = userName.charAt(0).toUpperCase();
            
            return `
                <tr id="incident-${incident.id}">
                    <td>
                        <div class="checkbox-wrapper">
                            <label class="check-box m-0">
                                <input type="checkbox" value="${incident.id}">
                                <span class="checkmark outline-secondary"></span>
                            </label>
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark">#${incident.id}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm me-2">
                                <div class="avatar-title bg-primary rounded-circle">
                                    ${userInitial}
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0 f-s-14">${userName}</h6>
                                <small class="text-muted">${userEmail}</small>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div>
                            <h6 class="mb-1 f-s-14">${incident.title.length > 50 ? incident.title.substring(0, 50) + '...' : incident.title}</h6>
                            ${incident.description ? `<small class="text-muted">${incident.description.length > 80 ? incident.description.substring(0, 80) + '...' : incident.description}</small>` : ''}
                        </div>
                    </td>
                    <td>
                        <span class="badge status-${incident.status}">
                            ${statusBadge}
                        </span>
                    </td>
                    <td>
                        <span class="priority-${incident.priority}">
                            ${priorityText}
                        </span>
                    </td>
                    <td>
                        <small class="text-muted">
                            ${incident.created_at ? new Date(incident.created_at).toLocaleDateString('es-ES') + ' ' + new Date(incident.created_at).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'}) : 'N/A'}
                        </small>
                    </td>
                    <td>
                        <small class="text-muted">
                            ${incident.updated_at ? new Date(incident.updated_at).toLocaleDateString('es-ES') + ' ' + new Date(incident.updated_at).toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'}) : 'N/A'}
                        </small>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn btn-sm btn-info view-incident" data-id="${incident.id}" title="Ver detalles">
                                <i class="ph-duotone ph-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning edit-incident" data-id="${incident.id}" title="Editar">
                                <i class="ph-duotone ph-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-success change-status" data-id="${incident.id}" data-status="${incident.status}" title="Cambiar estado">
                                <i class="ph-duotone ph-arrows-clockwise"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-incident" data-id="${incident.id}" title="Eliminar">
                                <i class="ph-duotone ph-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }
        
        function getStatusBadge(status) {
            switch(status) {
                case 'open':
                    return '🔵 Abierto';
                case 'pending':
                    return '🟡 En Proceso';
                case 'closed':
                    return '⚫ Cerrado';
                default:
                    return status.charAt(0).toUpperCase() + status.slice(1);
            }
        }
        
        function getPriorityText(priority) {
            switch(priority) {
                case 'high':
                    return '🔴 Alta';
                case 'medium':
                    return '🟡 Media';
                case 'low':
                    return '🟢 Baja';
                default:
                    return priority.charAt(0).toUpperCase() + priority.slice(1);
            }
        }
    });
    
    function consultarIA() {
        const spinner = document.getElementById("spinner");
        const titleField = document.getElementById('title');
        const descField  = document.getElementById('description');
    
        if (!titleField || !descField || !spinner) {
            console.warn("No se encontraron los elementos necesarios");
            return;
        }
    
        const ask = titleField.value.trim();
        if (!ask) {
            Swal.fire({
                icon: 'warning',
                title: 'Campo requerido',
                text: 'Debes ingresar un título antes de consultar la IA',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
    
        // Mostrar spinner
        spinner.style.display = "block";
    
        // Realizar la solicitud AJAX GET
        const xhr = new XMLHttpRequest();
        xhr.open("GET", `https://www.cimun.cl/ia?ask=${encodeURIComponent(ask)}`, true);
    
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                spinner.style.display = "none";
                if (xhr.status === 200) {
                    descField.value = xhr.responseText;
                    console.log("Respuesta del servidor:", xhr.responseText);
                } else {
                    console.error("Error en la solicitud:", xhr.status);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al consultar la IA',
                        confirmButtonText: 'Cerrar',
                        confirmButtonColor: '#d33'
                    });
                }
            }
        };
    
        xhr.send();
    }
    </script>

@endsection
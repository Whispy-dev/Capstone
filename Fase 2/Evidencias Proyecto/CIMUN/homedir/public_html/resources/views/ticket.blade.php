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
        .priority-high { color: #dc3545 !important; }
        .priority-medium { color: #ffc107 !important; }
        .priority-lower { color: #6c757d !important; }
        
        .status-open { background-color: #0d6efd; }
        .status-inprogress { background-color: #198754; }
        .status-closed { background-color: #6c757d; }
        
        .category-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
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
                        <a href="{{ route('dashboard') }}" class="f-s-14 f-w-500">
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
                                <small class="opacity-75">Desde enero 2024</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-primary">+12%</span>
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
                                <small class="opacity-75">Requieren atención</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-warning">Urgente</span>
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
                                <h6 class="mb-1">Resueltas</h6>
                                <h3 class="mb-0">{{ $statistics['completed_tickets'] ?? 0 }}</h3>
                                <small class="opacity-75">Este mes</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-success">↑ 8%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-sm-6">
                <div class="card incident-card bg-danger text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="stats-icon bg-white bg-opacity-20">
                                    <i class="ph-bold ph-x-circle f-s-25 text-white"></i>
                                </div>
                                <h6 class="mb-1">Canceladas</h6>
                                <h3 class="mb-0">{{ $statistics['cancelled_tickets'] ?? 0 }}</h3>
                                <small class="opacity-75">Sin solución</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-white text-danger">-3%</span>
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

            <!-- Top Categories -->
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0">Categorías Principales</h5>
                        <small class="text-muted">Incidencias más reportadas</small>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach($topCategories ?? [] as $category)
                            <li class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        @switch($category['name'])
                                            @case('Baches y vías')
                                                <i class="ph-duotone ph-road-horizon f-s-20 text-warning"></i>
                                                @break
                                            @case('Servicios públicos')
                                                <i class="ph-duotone ph-lightning f-s-20 text-info"></i>
                                                @break
                                            @case('Seguridad ciudadana')
                                                <i class="ph-duotone ph-shield-check f-s-20 text-danger"></i>
                                                @break
                                            @default
                                                <i class="ph-duotone ph-list-bullets f-s-20 text-success"></i>
                                        @endswitch
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $category['name'] }}</h6>
                                        <small class="text-muted">Última actualización: hace 2h</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge bg-light-success text-success">{{ $category['count'] }}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
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
                            <table id="incidentsTable" class="w-100 display ticket-app-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="checkbox-wrapper">
                                                <label class="check-box m-0">
                                                    <input type="checkbox" id="select-all">
                                                    <span class="checkmark outline-secondary"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th>ID</th>
                                        <th>Responsable</th>
                                        <th>Prioridad</th>
                                        <th>Título</th>
                                        <th>Categoría</th>
                                        <th>Estado</th>
                                        <th>Ubicación</th>
                                        <th>Fecha</th>
                                        <th>Vencimiento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Los datos se cargan via AJAX -->
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
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea class="form-control" name="description" id="description" rows="4" placeholder="Describe detalladamente la incidencia..."></textarea>
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
            let incidentsTable;
            let currentIncidentId = null;

            // Inicializar DataTable
            incidentsTable = $('#incidentsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route("incidents.index") }}',
                    data: function(d) {
                        d.status = $('#statusFilter').val();
                        d.priority = $('#priorityFilter').val();
                    }
                },
                columns: [
                    {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                    {data: 'id', name: 'id'},
                    {data: 'agent', name: 'agent'},
                    {data: 'priority', name: 'priority'},
                    {data: 'title', name: 'title'},
                    {data: 'category', name: 'category'},
                    {data: 'status', name: 'status'},
                    {data: 'location', name: 'location'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'due_date', name: 'due_date'},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false}
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                responsive: true,
                pageLength: 25,
                order: [[1, 'desc']] // Ordenar por ID descendente
            });

            // Filtros
            $('#statusFilter, #priorityFilter').on('change', function() {
                incidentsTable.draw();
            });

            // Botón crear incidencia
            $('#create_incident_btn').on('click', function() {
                $('#incidentModalLabel').text('Nueva Incidencia Municipal');
                $('#submitBtnText').text('Crear Incidencia');
                $('#incidentForm')[0].reset();
                $('#priority').val('medium');
                $('#status').val('open');
                currentIncidentId = null;
            });

            // Envío del formulario de incidencia
            $('#incidentForm').on('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const url = currentIncidentId ? 
                    `{{ url('/incidencias') }}/${currentIncidentId}` : 
                    '{{ route("incidents.store") }}';
                
                if (currentIncidentId) {
                    formData.append('_method', 'PUT');
                }

                // Mostrar loading
                const submitBtn = $(this).find('button[type="submit"]');
                const originalText = submitBtn.html();
                submitBtn.html('<i class="ph-duotone ph-circle-notch ph-spin me-1"></i> Guardando...').prop('disabled', true);

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#incidentModal').modal('hide');
                        incidentsTable.draw();
                        
                        Swal.fire({
                            title: '¡Éxito!',
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON?.errors;
                            if (errors) {
                                let errorMessage = '';
                                Object.keys(errors).forEach(key => {
                                    errorMessage += errors[key][0] + '\n';
                                });
                                
                                Swal.fire({
                                    title: 'Error de Validación',
                                    text: errorMessage,
                                    icon: 'error'
                                });
                            }
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error inesperado. Intenta nuevamente.',
                                icon: 'error'
                            });
                        }
                    },
                    complete: function() {
                        // Restaurar botón
                        submitBtn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // Ver incidencia
            $(document).on('click', '.view-incident', function() {
                const id = $(this).data('id');
                
                $.ajax({
                    url: `{{ url('/incidencias') }}/${id}`,
                    method: 'GET',
                    success: function(response) {
                        const incident = response.data;
                        
                        // Llenar modal de solo lectura
                        $('#title').val(incident.title).prop('readonly', true);
                        $('#description').val(incident.description).prop('readonly', true);
                        $('#priority').val(incident.priority).prop('disabled', true);
                        $('#status').val(incident.status).prop('disabled', true);
                        
                        $('#incidentModalLabel').text('Ver Incidencia #' + incident.id);
                        $('#submitBtnText').text('Cerrar');
                        $('#incidentModal').modal('show');
                        
                        currentIncidentId = incident.id;
                    }
                });
            });

            // Editar incidencia
            $(document).on('click', '.edit-incident', function() {
                const id = $(this).data('id');
                
                $.ajax({
                    url: `{{ url('/incidencias') }}/${id}`,
                    method: 'GET',
                    success: function(response) {
                        const incident = response.data;
                        
                        // Llenar formulario
                        $('#title').val(incident.title).prop('readonly', false);
                        $('#description').val(incident.description).prop('readonly', false);
                        $('#priority').val(incident.priority).prop('disabled', false);
                        $('#status').val(incident.status).prop('disabled', false);
                        
                        $('#incidentModalLabel').text('Editar Incidencia #' + incident.id);
                        $('#submitBtnText').text('Actualizar Incidencia');
                        $('#incidentModal').modal('show');
                        
                        currentIncidentId = incident.id;
                    }
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
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#deleteModal').modal('hide');
                        incidentsTable.draw();
                        
                        Swal.fire({
                            title: 'Eliminado',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo eliminar la incidencia',
                            icon: 'error'
                        });
                    },
                    complete: function() {
                        btn.html(originalText).prop('disabled', false);
                    }
                });
            });

            // Cambio rápido de estado
            $(document).on('click', '.change-status', function() {
                currentIncidentId = $(this).data('id');
                const currentStatus = $(this).data('status');
                $('#newStatus').val(currentStatus);
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
                        incidentsTable.draw();
                        
                        Swal.fire({
                            title: 'Estado Actualizado',
                            text: response.message,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Limpiar formulario
                        $('#statusForm')[0].reset();
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo actualizar el estado',
                            icon: 'error'
                        });
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
                $('input[type="checkbox"]').not(this).prop('checked', isChecked);
            });

            // Actualizar estadísticas cada 30 segundos
            setInterval(function() {
                // Solo actualizar si la página está visible
                if (!document.hidden) {
                    $.get('{{ route("incidents.index") }}', function(data) {
                        // Se podría implementar actualización en tiempo real de estadísticas
                        // por ahora solo refrescamos la tabla
                        incidentsTable.draw(false); // false = no reset pagination
                    });
                }
            }, 30000); // 30 segundos
        });
    </script>
@endsection
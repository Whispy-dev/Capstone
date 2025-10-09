@extends('layout.master')
@section('title', 'Editar Evento')

@section('main-content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row m-1">
            <div class="col-12">
                <h4 class="main-title">Editar Evento</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li>
                        <a href="{{ route('calendar.index') }}" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-calendar f-s-16"></i> Calendario</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Editar Evento</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row m-1">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Editar: {{ $event->title }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('events.update', $event->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Título del Evento <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title', $event->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Tipo de Evento <span class="text-danger">*</span></label>
                                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                            <option value="">Seleccionar tipo</option>
                                            <option value="interna" {{ old('type', $event->type) === 'interna' ? 'selected' : '' }}>
                                                Reunión Interna
                                            </option>
                                            <option value="externa" {{ old('type', $event->type) === 'externa' ? 'selected' : '' }}>
                                                Reunión Externa
                                            </option>
                                            <option value="incidente" {{ old('type', $event->type) === 'incidente' ? 'selected' : '' }}>
                                                Incidente
                                            </option>
                                        </select>
                                        @error('type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" name="description" rows="4">{{ old('description', $event->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="start" class="form-label">Fecha y Hora de Inicio <span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control @error('start') is-invalid @enderror" 
                                               id="start" name="start" 
                                               value="{{ old('start', $event->start->format('Y-m-d\TH:i')) }}" required>
                                        @error('start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end" class="form-label">Fecha y Hora de Fin</label>
                                        <input type="datetime-local" class="form-control @error('end') is-invalid @enderror" 
                                               id="end" name="end" 
                                               value="{{ old('end', $event->end ? $event->end->format('Y-m-d\TH:i') : '') }}">
                                        @error('end')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Ubicación</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location', $event->location) }}" 
                                       placeholder="Ej: Oficina del Alcalde, Salón Municipal, etc.">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('calendar.index') }}" class="btn btn-secondary me-2">
                                        <i class="ti ti-arrow-left me-1"></i>Volver al Calendario
                                    </a>
                                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary">
                                        <i class="ti ti-eye me-1"></i>Ver Evento
                                    </a>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i>Actualizar Evento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Sección de eliminar evento -->
                <div class="card mt-3 border-danger">
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0">Zona de Peligro</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-3">Una vez que elimines este evento, no podrás recuperarlo. Por favor, ten cuidado.</p>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este evento? Esta acción no se puede deshacer.')">
                                <i class="ti ti-trash me-1"></i>Eliminar Evento
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panel informativo -->
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Información del Evento</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Creado:</strong>
                            <p class="mb-0 text-muted">{{ $event->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Última modificación:</strong>
                            <p class="mb-0 text-muted">{{ $event->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Tipo actual:</strong>
                            <span class="badge bg-{{ $event->type === 'interna' ? 'primary' : ($event->type === 'externa' ? 'success' : 'danger') }}">
                                {{ ucfirst($event->type) }}
                            </span>
                        </div>

                        @if($event->location)
                            <div class="mb-3">
                                <strong>Ubicación:</strong>
                                <p class="mb-0 text-muted">{{ $event->location }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Tipos de Eventos</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="badge bg-primary me-2" style="width: 15px; height: 15px;"></div>
                                <div>
                                    <strong>Reunión Interna</strong>
                                    <p class="mb-0 text-muted small">Reuniones con el equipo municipal</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="badge bg-success me-2" style="width: 15px; height: 15px;"></div>
                                <div>
                                    <strong>Reunión Externa</strong>
                                    <p class="mb-0 text-muted small">Reuniones con ciudadanos, empresas</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="badge bg-danger me-2" style="width: 15px; height: 15px;"></div>
                                <div>
                                    <strong>Incidente</strong>
                                    <p class="mb-0 text-muted small">Situaciones urgentes, emergencias</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
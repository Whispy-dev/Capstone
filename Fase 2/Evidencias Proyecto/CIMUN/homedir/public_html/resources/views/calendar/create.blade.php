@extends('layout.master')
@section('title', 'Crear Evento')

@section('main-content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row m-1">
            <div class="col-12">
                <h4 class="main-title">Crear Evento</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li>
                        <a href="{{ route('calendar.index') }}" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-calendar f-s-16"></i> Calendario</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Crear Evento</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row m-1">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Nuevo Evento</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('events.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Título del Evento <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title') }}" required>
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
                                            <option value="interna" {{ old('type') === 'interna' ? 'selected' : '' }}>
                                                Reunión Interna
                                            </option>
                                            <option value="externa" {{ old('type') === 'externa' ? 'selected' : '' }}>
                                                Reunión Externa
                                            </option>
                                            <option value="incidente" {{ old('type') === 'incidente' ? 'selected' : '' }}>
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
                                          id="description" name="description" rows="4">{{ old('description') }}</textarea>
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
                                               value="{{ old('start', request('date') ? request('date') . 'T09:00' : '') }}" required>
                                        @error('start')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="end" class="form-label">Fecha y Hora de Fin</label>
                                        <input type="datetime-local" class="form-control @error('end') is-invalid @enderror" 
                                               id="end" name="end" value="{{ old('end') }}">
                                        @error('end')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="location" class="form-label">Ubicación</label>
                                <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                       id="location" name="location" value="{{ old('location') }}" 
                                       placeholder="Ej: Oficina del Alcalde, Salón Municipal, etc.">
                                @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('calendar.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-arrow-left me-1"></i>Volver al Calendario
                                </a>
                                
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-device-floppy me-1"></i>Crear Evento
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Panel informativo -->
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tipos de Eventos</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="badge bg-primary me-2" style="width: 15px; height: 15px;"></div>
                                <div>
                                    <strong>Reunión Interna</strong>
                                    <p class="mb-0 text-muted small">Reuniones con el equipo municipal, staff interno</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="badge bg-success me-2" style="width: 15px; height: 15px;"></div>
                                <div>
                                    <strong>Reunión Externa</strong>
                                    <p class="mb-0 text-muted small">Reuniones con ciudadanos, empresas, otras instituciones</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <div class="badge bg-danger me-2" style="width: 15px; height: 15px;"></div>
                                <div>
                                    <strong>Incidente</strong>
                                    <p class="mb-0 text-muted small">Situaciones urgentes, emergencias, problemas críticos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Consejos</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2"></i>
                                <small>Usa títulos descriptivos y claros</small>
                            </li>
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2"></i>
                                <small>Incluye la ubicación cuando sea relevante</small>
                            </li>
                            <li class="mb-2">
                                <i class="ti ti-check text-success me-2"></i>
                                <small>Establece horas de inicio y fin apropiadas</small>
                            </li>
                            <li class="mb-0">
                                <i class="ti ti-check text-success me-2"></i>
                                <small>Añade descripciones detalladas para mayor contexto</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
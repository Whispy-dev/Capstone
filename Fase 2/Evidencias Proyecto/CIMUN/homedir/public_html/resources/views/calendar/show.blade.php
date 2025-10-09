@extends('layout.master')
@section('title', 'Detalles del Evento')

@section('main-content')
    <div class="container-fluid">
        <!-- Breadcrumb -->
        <div class="row m-1">
            <div class="col-12">
                <h4 class="main-title">Detalles del Evento</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li>
                        <a href="{{ route('calendar.index') }}" class="f-s-14 f-w-500">
                            <span><i class="ph-duotone ph-calendar f-s-16"></i> Calendario</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Detalles del Evento</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row m-1">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h3 class="mb-1">{{ $event->title }}</h3>
                                <span class="badge bg-{{ $event->type === 'interna' ? 'primary' : ($event->type === 'externa' ? 'success' : 'danger') }} me-2">
                                    {{ $event->type === 'interna' ? 'Reunión Interna' : ($event->type === 'externa' ? 'Reunión Externa' : 'Incidente') }}
                                </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="ti ti-dots-vertical"></i> Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('events.edit', $event->id) }}">
                                        <i class="ti ti-edit me-2"></i>Editar Evento
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger" 
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este evento?')">
                                                <i class="ti ti-trash me-2"></i>Eliminar Evento
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Información principal del evento -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="ti ti-calendar-event text-primary me-3" style="font-size: 1.5rem;"></i>
                                    <div>
                                        <h6 class="mb-0">Fecha y Hora de Inicio</h6>
                                        <p class="mb-0 text-muted">{{ $event->start->format('l, d/m/Y - H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                @if($event->end)
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="ti ti-calendar-x text-secondary me-3" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h6 class="mb-0">Fecha y Hora de Fin</h6>
                                            <p class="mb-0 text-muted">{{ $event->end->format('l, d/m/Y - H:i') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="ti ti-clock text-info me-3" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h6 class="mb-0">Duración</h6>
                                            <p class="mb-0 text-muted">Sin hora de fin especificada</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($event->location)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-map-pin text-success me-3" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h6 class="mb-0">Ubicación</h6>
                                            <p class="mb-0 text-muted">{{ $event->location }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($event->description)
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="d-flex align-items-start">
                                        <i class="ti ti-file-text text-info me-3 mt-1" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <h6 class="mb-2">Descripción</h6>
                                            <div class="p-3 bg-light rounded">
                                                {{ $event->description }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Duración calculada -->
                        @if($event->end)
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <i class="ti ti-info-circle me-2"></i>
                                        <strong>Duración total:</strong> 
                                        {{ $event->start->diff($event->end)->format('%h horas y %i minutos') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Botones de acción -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('calendar.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left me-1"></i>Volver al Calendario
                            </a>
                            
                            <div>
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-primary me-2">
                                    <i class="ti ti-edit me-1"></i>Editar Evento
                                </a>
                                
                                <!-- Botón para crear evento similar -->
                                <a href="{{ route('events.create', [
                                    'title' => $event->title,
                                    'type' => $event->type,
                                    'description' => $event->description,
                                    'location' => $event->location
                                ]) }}" class="btn btn-outline-primary">
                                    <i class="ti ti-copy me-1"></i>Duplicar Evento
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel lateral -->
            <div class="col-lg-4 col-12">
                <!-- Información adicional -->
                <div class="card">
                    <div class="card-header">
                        <h5>Información del Sistema</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>ID del Evento:</strong>
                            <p class="mb-0 text-muted">#{{ $event->id }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Creado el:</strong>
                            <p class="mb-0 text-muted">{{ $event->created_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Última actualización:</strong>
                            <p class="mb-0 text-muted">{{ $event->updated_at->format('d/m/Y H:i:s') }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <strong>Estado:</strong>
                            @if($event->start->isPast())
                                <span class="badge bg-secondary">Pasado</span>
                            @elseif($event->start->isToday())
                                <span class="badge bg-warning">Hoy</span>
                            @else
                                <span class="badge bg-success">Próximo</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Eventos relacionados -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Eventos del Mismo Día</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $sameDayEvents = \App\Models\Event::whereDate('start', $event->start->format('Y-m-d'))
                                                               ->where('id', '!=', $event->id)
                                                               ->orderBy('start')
                                                               ->get();
                        @endphp
                        
                        @forelse($sameDayEvents as $relatedEvent)
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-{{ $relatedEvent->type === 'interna' ? 'primary' : ($relatedEvent->type === 'externa' ? 'success' : 'danger') }} me-2"></span>
                                <div class="flex-grow-1">
                                    <a href="{{ route('events.show', $relatedEvent->id) }}" class="text-decoration-none">
                                        <small class="fw-bold">{{ $relatedEvent->title }}</small>
                                    </a>
                                    <p class="mb-0 text-muted" style="font-size: 11px;">{{ $relatedEvent->start->format('H:i') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted text-center">No hay otros eventos este día</p>
                        @endforelse
                    </div>
                </div>

                <!-- Acciones rápidas -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Acciones Rápidas</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="ti ti-edit me-1"></i>Editar
                            </a>
                            
                            <a href="{{ route('events.create', ['date' => $event->start->format('Y-m-d')]) }}" 
                               class="btn btn-outline-success btn-sm">
                                <i class="ti ti-plus me-1"></i>Nuevo Evento Mismo Día
                            </a>
                            
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100" 
                                        onclick="return confirm('¿Estás seguro?')">
                                    <i class="ti ti-trash me-1"></i>Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layout.master')
@section('title', 'Calendario')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/vendor/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/slick/slick-theme.css')}}">
@endsection

@section('main-content')
    <div class="container-fluid">
        <!-- Breadcrumb inicio -->
        <div class="row m-1">
            <div class="col-12 ">
                <h4 class="main-title">Calendario</h4>
                <ul class="app-line-breadcrumbs mb-3">
                    <li class="">
                        <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone ph-stack f-s-16"></i> Aplicaciones
                      </span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#" class="f-s-14 f-w-500">Calendario</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb fin -->

        <!-- Mensajes de éxito/error -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row m-1 calendar app-fullcalender">
            <!-- Panel lateral inicio -->
            <div class="col-xxl-3">
                <div class="row">
                    <!-- Botón crear evento -->
                    <div class="col-md-6 col-xxl-12">
                        <div class="card mb-3">
                            <div class="card-body text-center">
                                <a href="{{ route('events.create') }}" class="btn btn-primary btn-lg w-100">
                                    <i class="ti ti-plus me-2"></i>Crear Evento
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Eventos Arrastrables -->
                    <div class="col-md-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Tipos de Eventos</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="badge bg-primary me-2" style="width: 15px; height: 15px;"></div>
                                        <span>Reunión Interna</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="badge bg-success me-2" style="width: 15px; height: 15px;"></div>
                                        <span>Reunión Externa</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-danger me-2" style="width: 15px; height: 15px;"></div>
                                        <span>Incidente</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de próximos eventos -->
                    <div class="col-md-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Próximos Eventos</h5>
                            </div>
                            <div class="card-body">
                                <div class="event-container">
                                    @forelse($events->where('start', '>=', now())->sortBy('start')->take(5) as $event)
                                        <div class="event-box mb-3 p-2 border rounded">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-1">
                                                        <span class="badge bg-{{ $event->type === 'interna' ? 'primary' : ($event->type === 'externa' ? 'success' : 'danger') }} me-1"></span>
                                                        {{ $event->title }}
                                                    </h6>
                                                    @if($event->description)
                                                        <p class="mb-1 text-secondary f-s-13">{{ Str::limit($event->description, 50) }}</p>
                                                    @endif
                                                    <p class="f-s-13 text-muted mb-0">
                                                        <i class="ti ti-calendar-event me-1"></i>{{ $event->start->format('d/m/Y H:i') }}
                                                    </p>
                                                </div>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ route('events.show', $event->id) }}">Ver</a></li>
                                                        <li><a class="dropdown-item" href="{{ route('events.edit', $event->id) }}">Editar</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger" 
                                                                        onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted text-center">No hay eventos próximos</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Panel lateral fin -->

            <!-- Calendario principal -->
            <div class="col-xxl-9">
                <div class="card">
                    <div class="card-header">
                        <h5>Calendario de Eventos</h5>
                    </div>
                    <div class="card-body">
                        <!-- Vista de calendario básica -->
                        <div class="calendar-basic">
                            <div class="row">
                                <!-- Controles del calendario -->
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 id="currentMonth">{{ now()->format('F Y') }}</h4>
                                        <div>
                                            <button class="btn btn-outline-primary btn-sm me-1" onclick="previousMonth()">
                                                <i class="ti ti-chevron-left"></i>
                                            </button>
                                            <button class="btn btn-outline-primary btn-sm me-1" onclick="nextMonth()">
                                                <i class="ti ti-chevron-right"></i>
                                            </button>
                                            <button class="btn btn-primary btn-sm" onclick="goToday()">Hoy</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Grid del calendario -->
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered calendar-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Dom</th>
                                                    <th class="text-center">Lun</th>
                                                    <th class="text-center">Mar</th>
                                                    <th class="text-center">Mié</th>
                                                    <th class="text-center">Jue</th>
                                                    <th class="text-center">Vie</th>
                                                    <th class="text-center">Sáb</th>
                                                </tr>
                                            </thead>
                                            <tbody id="calendar-body">
                                                @php
                                                    $currentDate = now();
                                                    $firstDay = $currentDate->copy()->startOfMonth();
                                                    $lastDay = $currentDate->copy()->endOfMonth();
                                                    $startCalendar = $firstDay->copy()->startOfWeek(0);
                                                    $endCalendar = $lastDay->copy()->endOfWeek(6);
                                                    
                                                    $weeks = [];
                                                    $current = $startCalendar->copy();
                                                    
                                                    while ($current->lte($endCalendar)) {
                                                        $week = [];
                                                        for ($i = 0; $i < 7; $i++) {
                                                            $dayEvents = $events->filter(function ($event) use ($current) {
                                                                return $event->start->format('Y-m-d') === $current->format('Y-m-d');
                                                            });
                                                            
                                                            $week[] = [
                                                                'date' => $current->copy(),
                                                                'events' => $dayEvents,
                                                                'isCurrentMonth' => $current->month === $firstDay->month
                                                            ];
                                                            $current->addDay();
                                                        }
                                                        $weeks[] = $week;
                                                    }
                                                @endphp

                                                @foreach($weeks as $week)
                                                    <tr>
                                                        @foreach($week as $day)
                                                            <td class="calendar-day {{ $day['isCurrentMonth'] ? '' : 'text-muted' }}" 
                                                                style="height: 120px; vertical-align: top; position: relative;">
                                                                <div class="d-flex justify-content-between align-items-start">
                                                                    <span class="day-number {{ $day['date']->isToday() ? 'bg-primary text-white rounded px-1' : '' }}">
                                                                        {{ $day['date']->day }}
                                                                    </span>
                                                                    @if($day['isCurrentMonth'])
                                                                        <a href="{{ route('events.create', ['date' => $day['date']->format('Y-m-d')]) }}" 
                                                                           class="btn btn-sm btn-outline-primary" style="font-size: 10px; padding: 2px 4px;">
                                                                            <i class="ti ti-plus"></i>
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                                
                                                                <div class="events-list mt-1">
                                                                    @foreach($day['events']->take(3) as $event)
                                                                        <div class="event-item mb-1">
                                                                            <a href="{{ route('events.show', $event->id) }}" 
                                                                               class="badge bg-{{ $event->type === 'interna' ? 'primary' : ($event->type === 'externa' ? 'success' : 'danger') }} text-decoration-none d-block text-truncate" 
                                                                               style="font-size: 9px; max-width: 100%;" 
                                                                               title="{{ $event->title }} - {{ $event->start->format('H:i') }}">
                                                                                {{ Str::limit($event->title, 15) }}
                                                                            </a>
                                                                        </div>
                                                                    @endforeach
                                                                    
                                                                    @if($day['events']->count() > 3)
                                                                        <small class="text-muted">+{{ $day['events']->count() - 3 }} más</small>
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        @endforeach
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
            </div>
        </div>
    </div>

    <style>
        .calendar-table td {
            width: 14.28%;
            min-height: 120px;
        }
        
        .day-number {
            font-weight: 500;
            font-size: 14px;
        }
        
        .event-item {
            font-size: 10px;
        }
        
        .calendar-day:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection

@section('script')
    <!-- slick-file -->
    <script src="{{asset('assets/vendor/slick/slick.min.js')}}"></script>
    
    <script>
        // Funciones básicas para navegación del calendario (opcional)
        function previousMonth() {
            // Implementar navegación anterior
            window.location.href = "{{ route('calendar.index') }}?month=" + (new Date().getMonth());
        }
        
        function nextMonth() {
            // Implementar navegación siguiente
            window.location.href = "{{ route('calendar.index') }}?month=" + (new Date().getMonth() + 2);
        }
        
        function goToday() {
            window.location.href = "{{ route('calendar.index') }}";
        }
    </script>
@endsection


@extends('layout.master')
@section('title', 'Detalles del Incidente')

@section('main-content')
<div class="container">
    <h2>Detalle del Cargo</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $position->name }}</h4>
            <p class="card-text"><strong>Nivel:</strong> {{ $position->level ?? '—' }}</p>
            <p class="card-text"><strong>Área:</strong> {{ $position->area->name ?? 'Sin área asignada' }}</p>
            <p class="card-text"><strong>Descripción:</strong> {{ $position->description ?? '—' }}</p>
        </div>
    </div>

    <h5>Usuarios Asignados</h5>
    @if($position->users->count())
        <ul class="list-group mb-4">
            @foreach($position->users as $user)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $user->name }}</strong> <small class="text-muted">({{ $user->email }})</small>
                    </div>
                    <div>
                        @if($user->pivot->assigned_at)
                            <span class="badge bg-primary">Asignado: {{ \Carbon\Carbon::parse($user->pivot->assigned_at)->format('d-m-Y') }}</span>
                        @endif
                        @if($user->pivot->ended_at)
                            <span class="badge bg-secondary">Finalizado: {{ \Carbon\Carbon::parse($user->pivot->ended_at)->format('d-m-Y') }}</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No hay usuarios asignados a este cargo.</p>
    @endif

    <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('positions.index') }}" class="btn btn-secondary">Volver al listado</a>
</div>
@endsection

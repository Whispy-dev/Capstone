@extends('layout.master')
@section('title', 'Detalles del Área')

@section('main-content')
<div class="container">
    <h2>Detalle del Área</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h4 class="card-title">{{ $area->name }}</h4>
            <p class="card-text"><strong>Descripción:</strong> {{ $area->description ?? '—' }}</p>
        </div>
    </div>

    <h5>Usuarios Asignados</h5>
    @if($area->users->count())
        <ul class="list-group mb-4">
            @foreach($area->users as $user)
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

    <a href="{{ route('areas.edit', $area->id) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('areas.index') }}" class="btn btn-secondary">Volver al listado</a>
</div>
@endsection

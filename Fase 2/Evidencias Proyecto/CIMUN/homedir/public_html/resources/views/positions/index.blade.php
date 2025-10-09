@extends('layout.master')
@section('title', 'Detalles del Incidente')

@section('main-content')
<div class="container">
    <h2 class="mb-4">Listado de Cargos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('positions.create') }}" class="btn btn-primary mb-3">Crear Nuevo Cargo</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Área</th>
                <th>Usuarios Asignados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($positions as $position)
                <tr>
                    <td>{{ $position->name }}</td>
                    <td>{{ $position->level ?? '—' }}</td>
                    <td>{{ $position->area->name ?? 'Sin área' }}</td>
                    <td>
                        @if($position->users->count())
                            <ul class="list-unstyled mb-0">
                                @foreach($position->users as $user)
                                    <li>{{ $user->name }} <small class="text-muted">({{ $user->email }})</small></li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Sin asignaciones</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            
                        <a href="{{ route('positions.show', $position->id) }}" class="btn btn-sm btn-info">Ver</a>
                            @if(Auth::check() && Auth::user()->is_manager)
                                <a href="{{ route('positions.edit', $position->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este cargo?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">No hay cargos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
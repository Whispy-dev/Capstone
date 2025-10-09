@extends('layout.master')
@section('title', 'Listado de usuarios')

@section('main-content')
<div class="container">
    <h2>Listado de usuarios</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Cargos activos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @php
                            $activePositions = $user->positions->filter(fn($p) => !$p->pivot->ended_at);
                        @endphp
                        @if($activePositions->count())
                            <ul class="list-unstyled mb-0">
                                @foreach($activePositions as $position)
                                    <li>{{ $position->name }} ({{ $position->area->name ?? '—' }})</li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-muted">Sin cargos activos</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.positions', $user->id) }}" class="btn btn-sm btn-primary">Ver cargos</a>
                        <a href="{{ route('positions.assignToUserForm', $user->id) }}" class="btn btn-sm btn-success">Asignar cargo</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Paginación opcional --}}
    {{ $users->links() }}
</div>
@endsection
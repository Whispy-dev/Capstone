@extends('layout.master')
@section('title', 'Cargos asignados a '.$user->name)

@section('main-content')
<div class="container">
    <h2>Cargos asignados a {{ $user->name }}</h2>

    @if($user->positions->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Cargo</th>
                    <th>Área</th>
                    <th>Asignado desde</th>
                    <th>Finalizado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->positions as $position)
                    <tr>
                        <td>{{ $position->name }}</td>
                        <td>{{ $position->area->name ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($position->pivot->assigned_at)->format('d-m-Y') }}</td>
                        <td>
                            @if($position->pivot->ended_at)
                                {{ \Carbon\Carbon::parse($position->pivot->ended_at)->format('d-m-Y') }}
                            @else
                                <span class="text-muted">Activo</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('positions.removeFromUser') }}" method="POST" onsubmit="return confirm('¿Remover este cargo?')">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <input type="hidden" name="position_id" value="{{ $position->id }}">
                                <button class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Este usuario no tiene cargos asignados.</p>
    @endif

    <a href="{{ route('positions.assignToUserForm', ['user' => $user->id]) }}" class="btn btn-primary">Asignar nuevo cargo</a>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Volver al listado de usuarios</a>
</div>
@endsection

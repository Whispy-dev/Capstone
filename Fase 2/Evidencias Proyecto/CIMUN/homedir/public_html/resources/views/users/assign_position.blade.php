@extends('layout.master')
@section('title', 'Cargos cargo a '.$user->name)

@section('main-content')
<div class="container">
    <h2>Asignar cargo a {{ $user->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups...</strong> Hay problemas con los datos ingresados:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('positions.assignToUser', $user->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="position_id" class="form-label">Cargo</label>
            <select name="position_id" id="position_id" class="form-select" required>
                <option value="">Seleccione un cargo</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">
                        {{ $position->name }} ({{ $position->area->name ?? 'Sin área' }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_at" class="form-label">Fecha de asignación</label>
            <input type="date" name="assigned_at" id="assigned_at" class="form-control" value="{{ now()->toDateString() }}">
        </div>

        <button type="submit" class="btn btn-success">Asignar cargo</button>
        <a href="{{ route('users.positions', $user->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection


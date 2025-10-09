@extends('layout.master')
@section('title', 'Detalles del Incidente')

@section('main-content')
<div class="container">
    <h2>Asignar Cargo a Usuario</h2>

    <form action="{{ route('positions.assignToUser') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="user_id" class="form-label">Usuario</label>
            <select name="user_id" class="form-select" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="position_id" class="form-label">Cargo</label>
            <select name="position_id" class="form-select" required>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->name }} - {{ $position->area->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="assigned_at" class="form-label">Fecha de Asignación</label>
            <input type="date" name="assigned_at" class="form-control" required value="{{ now()->toDateString() }}">
        </div>

        <button type="submit" class="btn btn-success">Asignar</button>
    </form>
</div>
@endsection
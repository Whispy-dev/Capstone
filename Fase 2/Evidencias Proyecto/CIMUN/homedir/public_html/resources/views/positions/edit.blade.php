@extends('layout.master')
@section('title', 'Editar Cargo')

@section('main-content')
<div class="container">
    <h2>Editar Cargo</h2>

    <form action="{{ route('positions.update', $position->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Cargo</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $position->name) }}">
        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Nivel</label>
            <input type="text" name="level" class="form-control" value="{{ old('level', $position->level) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $position->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="area_id" class="form-label">Área Asociada</label>
            <select name="area_id" class="form-select" required>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ $position->area_id == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection


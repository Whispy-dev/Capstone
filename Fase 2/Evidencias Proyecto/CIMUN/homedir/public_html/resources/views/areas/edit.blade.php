@extends('layout.master')
@section('title', 'Editar Área')

@section('main-content')
<div class="container">
    <h2>Editar Área</h2>

    <form action="{{ route('areas.update', $area->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Área</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $area->name) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control">{{ old('description', $area->description) }}</textarea>
        </div>


        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('areas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection


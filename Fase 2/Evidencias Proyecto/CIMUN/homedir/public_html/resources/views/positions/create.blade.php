@extends('layout.master')
@section('title', 'Crear Nuevo Cargo')

@section('main-content')
<div class="container">
    <h2>Crear Nuevo Cargo</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Errores:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('positions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Cargo</label>
            <input type="text" id="name" name="name" class="form-control" required value="{{ old('name') }}">

        </div>

        <div class="mb-3">
            <label for="level" class="form-label">Nivel</label>
            <input type="text" name="level" class="form-control" value="{{ old('level') }}">
        </div>


        <div class="mb-3">
            <label for="area_id" class="form-label">Área Asociada</label>
            <select name="area_id" class="form-select" required>
                <option value="">Seleccione un área</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>
                        {{ $area->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <button type="button" class="btn btn-secondary btn-sm" onclick="consultarIA()" style="float: right;">
                Consultar IA
            </button>
            <div class="spinner-border text-primary d-none" role="status" id="spinner" style="float:right; margin-right:10px;">
                <span class="visually-hidden">Loading...</span>
            </div>
        
            <textarea
                id="description"
                name="description"
                class="form-control"
                rows="6"
            >{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cargo</button>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection


@push('scripts')

<script>
window.consultarIA = function () {
    const descField  = document.getElementById('description');
    const nameField  = document.getElementById('name');
    const spinner    = document.getElementById('spinner');
    const areaSelect = document.querySelector('select[name="area_id"]');
    const levelField = document.querySelector('input[name="level"]');

    if (!descField || !nameField || !spinner) {
        console.warn('Faltan elementos: description/name/spinner');
        return;
    }

    const nombre = nameField.value.trim();
    const nivel  = (levelField?.value || '').trim();
    const areaId = areaSelect?.value || '';
    const areaTx = areaSelect?.options[areaSelect.selectedIndex]?.text?.trim() || '';

    if (!nombre) {
        Swal.fire({
            icon: 'warning',
            title: 'Campo requerido',
            text: 'Debes ingresar un nombre de cargo antes de consultar la IA',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#3085d6'
        });
        return;
    }

    // Prompt más contextual para CARGO (no incidente)
    const ask =
`Contexto: Necesito una descripción para un CARGO dentro de una organización.
Genera una descripción clara, concreta y en tono profesional.
Incluye: objetivo del cargo, responsabilidades principales (5-8 bullets), y requisitos deseables (3-5 bullets).
Evita lenguaje demasiado técnico.

Datos:
- Nombre del cargo: ${nombre}
- Nivel (si aplica): ${nivel || 'No especificado'}
- Área asociada: ${areaTx || 'No especificada'} (ID: ${areaId || '-'})

Devuelve solo el texto listo para pegar en el campo "Descripción".`;

    // Mostrar spinner
    spinner.classList.remove('d-none');

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `https://www.cimun.cl/ia?ask=${encodeURIComponent(ask)}`, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            spinner.classList.add('d-none');

            if (xhr.status === 200) {
                const texto = (xhr.responseText || '').trim();

                if (!texto || /falta info|incidente/i.test(texto)) {
                    // La API sigue creyendo que es “incidente” o respondió vacío
                    Swal.fire({
                        icon: 'info',
                        title: 'Falta contexto',
                        html: 'Agrega <b>Nivel</b> y <b>Área</b> (si corresponde), o bien ajusta el nombre del cargo.<br>Ejemplo: “Analista de RRHH Jr – Reclutamiento”.',
                        confirmButtonText: 'Ok'
                    });
                    return;
                }

                descField.value = texto;
            } else {
                console.error('Error en la solicitud:', xhr.status);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al consultar la IA',
                    confirmButtonText: 'Cerrar',
                    confirmButtonColor: '#d33'
                });
            }
        }
    };

    xhr.send();
};
</script>

@endpush



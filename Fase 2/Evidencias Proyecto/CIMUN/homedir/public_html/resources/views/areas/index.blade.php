@extends('layout.master')
@section('title', 'Listado de Áreas')

    @section('main-content')
    <div class="container">
        <h2 class="mb-4">Listado de Áreas</h2>
    
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#areaModal">
            Crear Nueva Área
        </button>
    
        {{-- Errores de validación (por si se recarga tras error) --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($areas as $area)
                    <tr>
                        <td>{{ $area->name }}</td>
                        <td>{{ $area->description ?? '—' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                
                                <a href="{{ route('areas.show', $area->id) }}" class="btn btn-sm btn-info">Ver</a>
                                @if(Auth::check() && Auth::user()->is_manager)
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#areaEditModal"
                                        data-area='@json(["id" => $area->id, "name" => $area->name, "description" => $area->description])'
                                    >
                                        Editar
                                    </button>
        
                                    <form action="{{ route('areas.destroy', $area->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta área?')">
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
                        <td colspan="3" class="text-center text-muted">No hay áreas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{-- Modal para crear Área --}}
    <div class="modal fade" id="areaModal" tabindex="-1" aria-labelledby="areaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-white" id="areaModalLabel">Nueva Área</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="areaForm" action="{{ route('areas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        id="name"
                                        placeholder="Escribe el nombre del área"
                                        value="{{ old('name') }}"
                                        required
                                        autofocus
                                    >
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label><button type="button" class="btn btn-secondary btn-sm" onclick="consultarIA()" style="float: right;">Consultar IA</button>
                                    <div class="spinner-border text-primary d-none" role="status" id="spinner">
                                      <span class="visually-hidden">Loading...</span>
                                    </div>

                                    <textarea
                                        class="form-control @error('description') is-invalid @enderror"
                                        name="description"
                                        id="description"
                                        rows="6"
                                        placeholder="Describe brevemente el área..."
                                    >{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ph-duotone ph-floppy-disk me-1"></i>
                            <span id="submitAreaBtnText">Crear Área</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    {{-- Modal para editar Área --}}
    <div class="modal fade" id="areaEditModal" tabindex="-1" aria-labelledby="areaEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h1 class="modal-title fs-5 text-white" id="areaEditModalLabel">Editar Área</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
    
                {{-- Action se setea dinámicamente en JS: route('areas.update', id) --}}
                <form id="areaEditForm" method="POST">
                    @csrf
                    @method('PUT')
    
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit_id">
    
                        <div class="mb-3">
                            <label for="edit_name" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="edit_name"
                                placeholder="Escribe el nombre del área"
                                required
                            >
                        </div>
    
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Descripción</label>
                            <textarea
                                class="form-control"
                                name="description"
                                id="edit_description"
                                rows="4"
                                placeholder="Describe brevemente el área..."
                            ></textarea>
                        </div>
    
                        {{-- Si quieres mostrar errores del update en este modal, puedes imprimirlos aquí con una bag separada --}}
                        {{-- @if($errors->update->any()) ... @endif --}}
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ph-duotone ph-floppy-disk me-1"></i>
                            <span>Guardar Cambios</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    {{-- Quality-of-life: enfocar y limpiar campos --}}
    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEl = document.getElementById('areaModal');
        modalEl.addEventListener('shown.bs.modal', () => {
            document.getElementById('name')?.focus();
        });
        modalEl.addEventListener('hidden.bs.modal', () => {
            document.getElementById('areaForm')?.reset();
        });
    
        // Si hubo errores de validación y old('name') existe, abrimos el modal automáticamente
        @if($errors->any())
            const modal = new bootstrap.Modal(modalEl);
            modal.show();
        @endif
    });
    
    </script>
    
    
    {{-- Script para editar area --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      const editModalEl = document.getElementById('areaEditModal');
      const editForm = document.getElementById('areaEditForm');
      const editId = document.getElementById('edit_id');
      const editName = document.getElementById('edit_name');
      const editDescription = document.getElementById('edit_description');
    
      if (editModalEl) {
        editModalEl.addEventListener('show.bs.modal', function (event) {
          const button = event.relatedTarget;
          if (!button) return;
    
          const areaRaw = button.getAttribute('data-area') || '{}';
          let area;
          try {
            area = JSON.parse(areaRaw);
          } catch (e) {
            area = {};
          }
    
          // Setea valores en inputs (fallbacks seguros)
          editId.value = area.id ?? '';
          editName.value = area.name ?? '';
          editDescription.value = area.description ?? '';
    
          // Ajusta el action a /areas/{id} (cámbialo si tu prefix es distinto)
          const baseUpdateUrl = "{{ url('/areas') }}";
          if (area.id) {
            editForm.setAttribute('action', `${baseUpdateUrl}/${area.id}`);
          }
        });
    
        editModalEl.addEventListener('shown.bs.modal', function () {
          editName?.focus();
        });
    
        editModalEl.addEventListener('hidden.bs.modal', function () {
          editForm.reset();
          editForm.removeAttribute('action');
        });
      }
    });
    
    </script>
    
    <script>
    window.consultarIA = async function () {
      // Campos base
      const nameField = document.getElementById('name');
      const descField = document.getElementById('description');
    
      if (!nameField || !descField) {
        console.warn('Faltan elementos: #name o #description');
        return;
      }
    
      const nombreArea = nameField.value.trim();
      if (!nombreArea) {
        Swal.fire({
          icon: 'warning',
          title: 'Campo requerido',
          text: 'Debes ingresar el nombre del área antes de consultar la IA.',
          confirmButtonText: 'Entendido',
          confirmButtonColor: '#3085d6'
        });
        return;
      }
    
      // Escopar spinner y botón dentro del mismo bloque del textarea
      const block = descField.closest('.mb-3') || document;
      const spinner = block.querySelector('#spinner') || document.getElementById('spinner');
      // Si el click vino desde el botón con onclick, lo obtenemos:
      const btn = document.activeElement?.tagName === 'BUTTON' ? document.activeElement : null;
    
      // Prompt específico para Áreas
      const ask = `
    Contexto: Genera una descripción breve (1 a 2 oraciones, 20–40 palabras) para un área municipal.
    Debe indicar propósito general y funciones principales, en español claro y profesional, sin viñetas.
    
    Nombre del área: ${nombreArea}
    
    Devuelve únicamente el texto final listo para el campo "Descripción".
    `.trim();
    
      // UI: activar spinner y bloquear botón
      spinner?.classList.remove('d-none');
      if (btn) btn.disabled = true;
    
      // fetch con manejo de errores y timeout
      const controller = new AbortController();
      const timeoutId = setTimeout(() => controller.abort(), 15000); // 15s
    
      try {
        const url = `https://www.cimun.cl/ia?ask=${encodeURIComponent(ask)}`;
        const res = await fetch(url, { signal: controller.signal });
    
        if (!res.ok) {
          throw new Error(`HTTP ${res.status}`);
        }
    
        let texto = (await res.text()).trim();
    
        // Si la API respondió algo no útil (vacío o menciona "incidente"), avisamos
        if (!texto || /incidente|falta info/i.test(texto)) {
          Swal.fire({
            icon: 'info',
            title: 'Necesita más contexto',
            html: 'Revisa el <b>Nombre del área</b> (ej.: “Secretaría Municipal”, “Finanzas”). Si persiste, ajusta el nombre para dejar claro el ámbito.',
            confirmButtonText: 'Ok'
          });
          return;
        }
    
        // Si ya hay descripción, anexamos con salto de línea
        descField.value = descField.value?.trim()
          ? `${descField.value.trim()}\n\n${texto}`
          : texto;
    
      } catch (err) {
        const aborted = err?.name === 'AbortError';
        console.error('Error consultando IA:', err);
        Swal.fire({
          icon: 'error',
          title: aborted ? 'Tiempo de espera agotado' : 'Error al consultar la IA',
          text: aborted ? 'La solicitud tardó demasiado. Intenta nuevamente.' : 'Ocurrió un error al consultar la IA.',
          confirmButtonText: 'Cerrar',
          confirmButtonColor: '#d33'
        });
      } finally {
        clearTimeout(timeoutId);
        spinner?.classList.add('d-none');
        if (btn) btn.disabled = false;
      }
    };
    </script>


    @endpush
@endsection

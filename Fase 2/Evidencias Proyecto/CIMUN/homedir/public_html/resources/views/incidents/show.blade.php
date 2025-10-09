@extends('layout.master')
@section('title', 'Detalles del Incidente')
@section('css')
    <!-- CSS de Filepond -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/filepond/image-preview.min.css') }}">

    <!-- CSS del editor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/trumbowyg/trumbowyg.min.css') }}">
@endsection

@section('main-content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <div class="row m-1">
        <div class="col-12">
            <h4 class="main-title">Detalles del Incidente</h4>
            <ul class="app-line-breadcrumbs mb-3">
                <li><a href="#" class="f-s-14 f-w-500"><span><i class="ph-duotone ph-stack f-s-16"></i> Apps</span></a></li>
                <li><a href="#" class="f-s-14 f-w-500">Incidente</a></li>
                <li class="active"><a href="#" class="f-s-14 f-w-500">Detalles del Incidente</a></li>
            </ul>
        </div>
    </div>

    <!-- Mostrar mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="ticket-details row">
        <!-- Lado izquierdo -->
        <div class="col-md-5 col-lg-4 col-xxl-3">
            <div class="card">
                <div class="card-body">
                    <div class="ticket-details-profile mb-4 p-3 rounded-3">
                        <div class="ticket-profile d-flex align-items-center">
                            <div class="h-45 w-45 d-flex-center b-r-50 overflow-hidden bg-secondary me-3">
                               <img src="https://phplaravel-1384472-5380003.cloudwaysapps.com/assets/images/avatar/4.png" alt="avatar" class="img-fluid">
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $incident->user->name }}</h6>
                                <p class="text-secondary">{{ $incident->user->email ?? '(No definido)' }}</p>
                            </div>
                        </div>
                        <div class="ticket-profile-con d-flex gap-3 justify-content-center mt-3">
                            <span class="bg-success h-35 w-35 d-flex-center b-r-50"><i class="ph-bold ph-phone-call f-s-18"></i></span>
                            <span class="bg-danger h-35 w-35 d-flex-center b-r-50"><i class="ph-bold ph-arrow-square-out f-s-18"></i></span>
                            <span class="bg-info h-35 w-35 d-flex-center b-r-50"><i class="ph-bold ph-user f-s-18"></i></span>
                        </div>
                    </div>

                    <div class="about-list pt-0">
                        <div><span class="fw-medium">Número de Incidente</span><span class="float-end f-s-13 text-secondary">{{ $incident->id }}</span></div>
                        <div><span class="fw-medium">Cliente</span><span class="float-end f-s-13 text-secondary">{{ $incident->user->name }}</span></div>
                        <div><span class="fw-medium">Prioridad</span><span class="float-end f-s-13 text-secondary">{{ ucfirst($incident->priority) }}</span></div>
                        <div><span class="fw-medium">Título</span><span class="float-end f-s-13 text-secondary">{{ $incident->title }}</span></div>
                        <div><span class="fw-medium">Estado</span><span class="float-end f-s-13 text-secondary">{{ ucfirst($incident->status) }}</span></div>
                        <div><span class="fw-medium">Fecha de Creación</span><span class="float-end f-s-13 text-secondary">{{ $incident->created_at->format('d M Y') }}</span></div>
                        <div><span class="fw-medium">Última Actualización</span><span class="float-end f-s-13 text-secondary">{{ $incident->updated_at->format('d M Y') }}</span></div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><h5>Subir Archivos</h5></div>
                <div class="card-body">
                    <input class="ticket-file-upload app-file-upload" type="file" id="attachments" multiple data-allow-reorder="true">
                </div>
            </div>
        </div>

        <!-- Lado derecho -->
        <div class="col-md-7 col-lg-8 col-xxl-9">
            <div class="card">
                <div class="card-header"><h5>Detalles del Incidente</h5></div>
                <div class="card-body">
                    <div class="ticket-details-content">
                        <div class="mb-3"><h6>ID del Incidente</h6><p class="text-secondary f-s-16">{{ $incident->id }} - {{ $incident->title }}</p></div>
                        <div class="mb-3"><h6>Descripción del Incidente</h6><p class="text-secondary">{{ $incident->description }}</p></div>
                    </div>
                </div>
            </div>
        
            <div class="card">
                <div class="card-header"><h5>Comentarios</h5></div>
                <div class="card-body">
                    @foreach($incident->comments as $comment)
                    <div class="ticket-comment-box mb-3">
                        <div class="d-flex justify-content-between position-relative flex-wrap">
                            <div class="h-45 w-45 d-flex-center b-r-50 overflow-hidden position-absolute">
                                 <img src="https://phplaravel-1384472-5380003.cloudwaysapps.com/assets/images/avatar/6.png" alt="avatar" class="img-fluid">
                            </div>
                            <div class="flex-grow-1 ps-2 pe-2 ms-5">
                                <h6 class="mb-0">{{ $comment->user->name }}</h6>
                                <p class="text-muted f-s-14">para {{ $incident->user->name }}</p>
                                <p class="text-dark mb-3">{{ $comment->content }}</p>
        
                                @if($comment->documents->count() > 0)
                                    <ul class="d-flex flex-wrap ms-5">
                                        @foreach($comment->documents as $file)
                                        <li class="me-3 w-250 mb-3">
                                            <div class="ticket-details-comment p-3 w-100">
                                                <h6 class="mb-0">
                                                    <a href="{{ $file->full_path }}" target="_blank">{{ $file->name }}</a>
                                                </h6>
                                                <p class="mb-0 text-secondary">{{ $file->created_at->format('d M Y, h:i A') }}</p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <div class="ms-5"><p>{{ $comment->created_at->format('d M, Y h:i A') }}</p></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        
            <div class="card">
                <div class="card-header"><h5>Dejar una Nota</h5></div>
                <div class="card-body">
                    <form action="{{ route('incidents.comments.store', $incident->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="content" class="form-label">Escribir comentario</label>
                            <textarea id="editor-1" name="content" class="form-control" rows="5" required></textarea>
                            @error('content')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="attachments" class="form-label">Adjuntar archivos</label>
                            <input class="form-control" type="file" name="attachments[]" id="attachments" multiple accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <small class="text-muted">Archivos permitidos: JPG, JPEG, PNG, PDF, DOC, DOCX (máx. 10MB cada uno)</small>
                            @error('attachments.*')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Nota</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<!-- Filepond -->
<script src="{{ asset('assets/vendor/filepond/filepond.min.js') }}"></script>
<script src="{{ asset('assets/vendor/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
<script src="{{ asset('assets/js/ticket_details.js') }}"></script>
@endsection

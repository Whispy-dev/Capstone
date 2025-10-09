<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\IncidentCategory;
use App\Models\User;
use App\Models\DeviceToken;
use App\Models\Comment;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Services\FirebaseService;

class IncidentsController extends Controller
{
    /**
     * Display a listing of the incidents.
     */
    public function index(Request $request)
    {
    
        $user = auth()->user();
        $mId  = (int) ($user->municipality_id ?? 0);
    
        // Base filtrada por municipio
        $base = Incident::query()->with('user');
    
        if ($mId > 0) {
            $base->where('municipality_id', $mId);
        }
    
        // Filtros de la vista
        if ($request->filled('status')) {
            $base->where('status', $request->status);
         
        }
        if ($request->filled('priority')) {
            $base->where('priority', $request->priority);
        
        }
    
        // Lista para la tabla
        $incidents = $base->get();
       
    
        // Estadísticas (siempre desde la misma base filtrada por municipio)
        try {
            $statistics = [
                'all_tickets'     => (clone $base)->without(['user'])->count(),
                'open_tickets'    => (clone $base)->without(['user'])->where('status', 'open')->count(),
                'pending_tickets' => (clone $base)->without(['user'])->where('status', 'pending')->count(),
                'closed_tickets'  => (clone $base)->without(['user'])->where('status', 'closed')->count(),
                'high_priority'   => (clone $base)->without(['user'])->where('priority', 'high')->count(),
                'medium_priority' => (clone $base)->without(['user'])->where('priority', 'medium')->count(),
                'low_priority'    => (clone $base)->without(['user'])->where('priority', 'low')->count(),
            ];
           
        } catch (\Exception $e) {
            
            // fallback para que la vista no reviente
            $statistics = [
                'all_tickets' => 0, 'open_tickets' => 0, 'pending_tickets' => 0,
                'closed_tickets' => 0, 'high_priority' => 0, 'medium_priority' => 0, 'low_priority' => 0,
            ];
        }
    
        // Top categorías (si quieres, podrías calcularlo de verdad con la misma base)
        $topCategories = [
            ['name'=>'Servicios públicos','count'=>45],
            ['name'=>'Baches y vías','count'=>32],
            ['name'=>'Seguridad ciudadana','count'=>28],
            ['name'=>'Limpieza urbana','count'=>19],
        ];
       
    
        // Categorías activas (globales; si fueran por municipio, filtra por $mId)
        $categories = IncidentCategory::where('active', 1)
            ->orderBy('name')
            ->get(['id','name']);
    
        // Para asignar: solo usuarios de mi municipalidad
        $users = User::query()
            ->when($mId > 0, function ($q) use ($mId) {
                $q->where('municipality_id', $mId);
            })
            ->orderBy('name')
            ->get(['id','name']);
            
            if ($mId === 0) {
    $incidents = collect();
        $statistics = array_map(function () { return 0; }, $statistics);
    }

        return view('incidents.index', compact('incidents','statistics','topCategories','categories','users'));
    }


    /**
     * Store a newly created incident.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => ['required', Rule::in(['low','medium','high'])],
            'status'      => ['required', Rule::in(['open','pending','closed'])],
            'category_id' => [
                'required',
                Rule::exists('incident_categories', 'id')->where(function ($query) {
                    $query->where('active', 1);
                }),
            ],
            'assigned_id' => ['required', 'integer', Rule::exists('users', 'id')],
        ]);
    
        $user = Auth::user();
        $municipalityId = (int) ($user->municipality_id ?? 0);
    
        // Bloquea creación si el usuario no tiene municipio asignado
        if ($municipalityId === 0) {
            return back()->with('error', 'Debes tener una municipalidad asignada para crear incidencias.');
        }
    
        // (Opcional pero recomendado) Validar que el asignado sea del mismo municipio
        $assignedIsSameMunicipality = User::where('id', $validatedData['assigned_id'])
            ->where('municipality_id', $municipalityId)
            ->exists();
    
        if (!$assignedIsSameMunicipality) {
            return back()->with('error', 'El usuario asignado no pertenece a tu municipalidad.');
        }
    
        try {
            $incident = Incident::create([
                'user_id'         => $user->id,
                'assigned_id'     => $validatedData['assigned_id'],
                'title'           => $validatedData['title'],
                'description'     => $validatedData['description'] ?? '',
                'priority'        => $validatedData['priority'],
                'status'          => $validatedData['status'],
                'category_id'     => $validatedData['category_id'],
                'municipality_id' => $municipalityId, // 👈 se setea aquí, desde el user
            ])->load(['user','assigned','category']);
    
            if ($request->expectsJson()) {
                return response()->json([
                    'success'  => true,
                    'message'  => '✅ Incidencia creada exitosamente',
                    'incident' => $incident,
                ], 201);
            }
    
            return redirect()->route('incidents.index')->with('success', '✅ Incidencia creada exitosamente');
    
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => '❌ Error al crear la incidencia',
                    'error'   => $e->getMessage(),
                ], 500);
            }
    
            return redirect()->route('incidents.index')->with('error', '❌ Error al crear la incidencia: '.$e->getMessage());
        }
    }
    
        
    /**
     * Display the specified incident.
     */
    public function show(Request $request, $id)
    {
     ;
    
        $incident = Incident::with([
            'user',
            'assigned', // ⬅️ agregado
            'category',
            'comments.user',
            'comments.documents'
        ])->findOrFail($id);
    
        if ($request->ajax() || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data'    => $incident
            ]);
        }
    
        return view('incidents.show', compact('incident'));
    }
    
    public function update(Request $request, $id, FirebaseService $firebase)
    {
        Log::info('Update de incidencia llamado', ['id' => $id, 'request' => $request->all()]);
        $incident = Incident::findOrFail($id);
        $DeviceTokens = DeviceToken::where('user_id',$incident->user_id)->get();
        //dd(DeviceToken::where('user_id',$incident->user_id)->get());
        
        $notificationResponse = null;

        if ($DeviceTokens) {
            foreach ($DeviceTokens as $DeviceToken) {
                try {
                    $notificationResponse = $firebase->sendNotification(
                        $DeviceToken->token,
                        'Incidencia asignada actualizada',
                        'Tienes una nueva incidencia actualizada en tu comuna',
                        ['id_incidencia' => $id]
                    );
        
                    if (isset($notificationResponse['name'])) {
                        Log::info('FCM sent', ['id' => $notificationResponse['name']]);
                    } else {
                        Log::warning('FCM response unexpected', ['response' => $notificationResponse]);
                    }
                } catch (\Throwable $e) {
                    Log::error('FCM Exception', ['error' => $e->getMessage()]);
                }
            }
        }

        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:low,medium,high',
            'status'      => 'required|in:open,pending,closed',
            // Permitimos cambiar asignación si viene en el request
            'assigned_id' => ['sometimes','integer', Rule::exists('users','id')], // ⬅️ nuevo
        ]);
    
        Log::info('Datos validados para actualizar incidencia', $validatedData);
    
        try {
            $incident->update($validatedData);
            Log::info('Incidencia actualizada exitosamente', ['incident_id' => $incident->id]);
    
            // Cargar relaciones para respuesta
            $incident->load(['user','assigned']);
    
            return response()->json([
                'success' => true,
                'message' => 'Incidencia actualizada exitosamente',
                'data' => $incident,
                'sendNotification' => $notificationResponse
            ]);
    
        } catch (\Exception $e) {
            Log::error('Error actualizando incidencia', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar la incidencia: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        Log::info('UpdateStatus llamado', ['id' => $id, 'request' => $request->all()]);
        $incident = Incident::findOrFail($id);

        $request->validate([
            'status' => 'required|in:open,pending,closed',
            'comment' => 'nullable|string'
        ]);

        try {
            DB::beginTransaction();

            // Actualizar estado
            $incident->update(['status' => $request->status]);
            
            // Si hay comentario, guardarlo
            if ($request->filled('comment')) {
                Comment::create([
                    'incident_id' => $incident->id,
                    'user_id' => Auth::id(),
                    'content' => $request->comment
                ]);
                Log::info('Comentario agregado al cambio de estado', ['incident_id' => $incident->id]);
            }

            DB::commit();
            Log::info('Estado actualizado exitosamente', ['incident_id' => $incident->id, 'status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => 'Estado actualizado exitosamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error actualizando estado', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el estado: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        Log::info('Destroy incidencia llamado', ['id' => $id]);

        try {
            DB::beginTransaction();
            
            $incident = Incident::findOrFail($id);
            
            // Eliminar comentarios asociados
            $incident->comments()->delete();
            
            // Eliminar incidencia
            $incident->delete();
            
            DB::commit();
            Log::info('Incidencia y comentarios eliminados exitosamente', ['incident_id' => $id]);

            return response()->json([
                'success' => true,
                'message' => 'Incidencia eliminada exitosamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error eliminando incidencia', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la incidencia: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Agregar comentario a una incidencia
     */
    public function addComment(Request $request, $id)
    {
        Log::info('AddComment llamado', ['incident_id' => $id, 'request' => $request->all()]);

        $request->validate([
            'content' => 'required|string|max:1000',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240' // Cambié 'documents' por 'attachments' para coincidir con el formulario
        ]);
    
        try {
            DB::beginTransaction();

            $incident = Incident::findOrFail($id);
    
            $comment = Comment::create([
                'incident_id' => $incident->id,
                'user_id' => auth()->id(),
                'content' => $request->content
            ]);

            Log::info('Comentario creado', ['comment_id' => $comment->id]);
    
            // Procesar archivos adjuntos
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('attachments', 'public');
                    
                    // Crear documento con los campos correctos según la estructura de la BD
                    Document::create([
                        'incident_id' => $incident->id,
                        'comment_id' => $comment->id,
                        'name' => $file->getClientOriginalName(), // Campo 'name' en lugar de 'filename'
                        'type' => $file->getClientMimeType(),     // Campo 'type' en lugar de 'mime_type'
                        'path' => $path,                          // Campo 'path' en lugar de 'filepath'
                    ]);

                    Log::info('Archivo guardado', [
                        'name' => $file->getClientOriginalName(),
                        'path' => $path,
                        'comment_id' => $comment->id
                    ]);
                }
            }

            DB::commit();
    
            // Recargar datos para mostrar en la vista
            $incident->load(['user', 'comments.user', 'comments.documents']);
    
            return redirect()->route('incidents.show', $incident->id)->with('success', 'Comentario agregado exitosamente');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error agregando comentario', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Error al agregar el comentario: ' . $e->getMessage());
        }
    }

    /**
     * Obtener comentarios de una incidencia
     */
    public function getComments($id)
    {
        Log::info('GetComments llamado', ['incident_id' => $id]);
        
        $incident = Incident::findOrFail($id);
        $comments = $incident->comments()->with(['user', 'documents'])->orderBy('created_at', 'desc')->get();
        
        Log::info('Comentarios obtenidos', ['incident_id' => $id, 'comments_count' => $comments->count()]);

        return response()->json([
            'success' => true,
            'data' => $comments
        ]);
    }

    /**
     * Eliminar comentario
     */
    public function deleteComment($incidentId, $commentId)
    {
        Log::info('DeleteComment llamado', ['incident_id' => $incidentId, 'comment_id' => $commentId]);
        
        try {
            $comment = Comment::where('incident_id', $incidentId)
                             ->where('id', $commentId)
                             ->where('user_id', Auth::id()) // Solo el autor puede eliminar
                             ->firstOrFail();
            
            $comment->delete();
            
            Log::info('Comentario eliminado exitosamente', ['comment_id' => $commentId]);

            return response()->json([
                'success' => true,
                'message' => 'Comentario eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error eliminando comentario', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el comentario: ' . $e->getMessage()
            ], 500);
        }
    }

    public function export()
    {
        Log::info('Export incidencias llamado');
    
        $user = auth()->user();
        $mId  = (int) ($user->municipality_id ?? 0);
    
        $incidents = Incident::with(['user', 'comments'])
            ->when($mId > 0, function ($q) use ($mId) {
                $q->where('municipality_id', $mId);
            })
            ->get();


    
        $filename = 'incidencias_' . date('Y-m-d_H-i-s') . '.csv';
    
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
    
        $callback = function() use ($incidents) {
            $file = fopen('php://output', 'w');
    
            fputcsv($file, [
                'ID', 'Título', 'Descripción', 'Estado', 'Prioridad',
                'Responsable', 'Comentarios', 'Fecha Creación', 'Última Actualización'
            ]);
    
            foreach ($incidents as $incident) {
                $commentsText = $incident->comments->count() > 0
                    ? $incident->comments->count() . ' comentario(s)'
                    : 'Sin comentarios';
    
                fputcsv($file, [
                    $incident->id,
                    $incident->title,
                    $incident->description,
                    ucfirst($incident->status),
                    ucfirst($incident->priority),
                    $incident->user?->name ?? 'Sin asignar',
                    $commentsText,
                    $incident->created_at->format('d/m/Y H:i'),
                    $incident->updated_at->format('d/m/Y H:i')
                ]);
            }
    
            fclose($file);
        };
    
        Log::info('Export de incidencias completado', ['count' => $incidents->count()]);
        return response()->stream($callback, 200, $headers);
    }

}
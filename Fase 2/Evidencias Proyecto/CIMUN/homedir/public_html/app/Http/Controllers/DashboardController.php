<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\IncidentCategory; 

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $mId  = (int) ($user->municipality_id ?? 0);
    
        // Si no tiene municipality_id, devolvemos vacíos/ceros (y evitas ver datos de otros)
        if ($mId === 0) {
            $incidentesAbiertos   = 0;
            $incidentesPendientes = 0;
            $incidentesResueltos  = 0;
            $tiempoPromedioResolucion = 0;
            $proximasReuniones = collect([]);
            $incidentesPorTipo = collect([]);
            $incidentesPorArea = collect([]);
            $categories = IncidentCategory::where('active', 1)->orderBy('name')->get(['id','name']);
            $users = collect([]); // o bien User::whereNull('id')->get()
            
            return view('dashboard.index', compact(
                'incidentesAbiertos',
                'incidentesPendientes',
                'incidentesResueltos',
                'tiempoPromedioResolucion',
                'proximasReuniones',
                'incidentesPorTipo',
                'incidentesPorArea',
                'categories',
                'users'
            ));
        }
    
        // Base filtrada por municipio
        $base = Incident::where('municipality_id', $mId);
    
        // Indicadores (usamos clones de la base para no re-crear el where)
        $incidentesAbiertos   = (clone $base)->where('status', 'open')->count();
        $incidentesPendientes = (clone $base)->where('status', 'pending')->count();
        $incidentesResueltos  = (clone $base)->where('status', 'closed')->count();
    
        // Tiempo promedio de resolución solo de este municipio
        $tiempoPromedioResolucion = (clone $base)
            ->where('status', 'closed')
            ->avg(DB::raw('TIMESTAMPDIFF(MINUTE, created_at, updated_at)')) ?? 0;
    
        // Próximas reuniones (si Event tiene municipality_id, filtra; si no, déjalo tal cual)
        try {
            $proximasReuniones = Event::where('start', '>=', now())
                // ->where('municipality_id', $mId) // <-- Descomenta si tu tabla events lo tiene
                ->orderBy('start', 'asc')
                ->take(5)
                ->get();
        } catch (\Exception $e) {
            $proximasReuniones = collect([]);
        }
    
        // Incidentes por prioridad (solo del municipio)
        $incidentesPorTipo = (clone $base)
            ->select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->get();
    
        if ($incidentesPorTipo->isEmpty()) {
            $incidentesPorTipo = collect([
                (object)['priority' => 'alta',  'total' => 0],
                (object)['priority' => 'media', 'total' => 0],
                (object)['priority' => 'baja',  'total' => 0],
            ]);
        }
    
        // Incidentes por usuario (solo del municipio) con nombre del usuario
        $incidentesPorArea = (clone $base)
            ->select('user_id', DB::raw('count(*) as total'))
            ->groupBy('user_id')
            ->with(['user:id,name'])
            ->get();
    
        if ($incidentesPorArea->isEmpty()) {
            $incidentesPorArea = collect([
                (object)['user_id' => '—', 'total' => 0]
            ]);
        }
    
        // Categorías activas (si tus categorías son globales, no hace falta filtrar por municipio)
        $categories = IncidentCategory::where('active', 1)
            ->orderBy('name')
            ->get(['id','name']);
    
        // Sugerencia: al asignar incidencias, lista solo usuarios de tu municipio
        $users = User::where('municipality_id', $mId)
            ->orderBy('name')
            ->get(['id','name']);
    
        return view('dashboard.index', compact(
            'incidentesAbiertos',
            'incidentesPendientes',
            'incidentesResueltos',
            'tiempoPromedioResolucion',
            'proximasReuniones',
            'incidentesPorTipo',
            'incidentesPorArea',
            'categories',
            'users'
        ));
    }
    
    /**
     * Estadísticas rápidas para AJAX (coherente con 'closed')
     */
    public function getStats()
    {
        $user = auth()->user();
        $mId  = (int) ($user->municipality_id ?? 0);
    
        if ($mId === 0) {
            return response()->json([
                'incidentes_abiertos'   => 0,
                'incidentes_pendientes' => 0,
                'incidentes_resueltos'  => 0,
                'total_incidentes'      => 0,
                'tiempo_promedio'       => 0,
            ]);
        }
    
        $base = Incident::where('municipality_id', $mId);
    
        $stats = [
            'incidentes_abiertos'   => (clone $base)->where('status', 'open')->count(),
            'incidentes_pendientes' => (clone $base)->where('status', 'pending')->count(),
            'incidentes_resueltos'  => (clone $base)->where('status', 'closed')->count(), // <-- usa 'closed' como en index()
            'total_incidentes'      => (clone $base)->count(),
            'tiempo_promedio'       => (clone $base)->where('status', 'closed')
                                        ->avg(DB::raw('TIMESTAMPDIFF(MINUTE, created_at, updated_at)')) ?? 0,
        ];
    
        return response()->json($stats);
    }

}
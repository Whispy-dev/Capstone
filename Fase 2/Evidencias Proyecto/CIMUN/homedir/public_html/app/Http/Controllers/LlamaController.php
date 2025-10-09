<?php
namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cloudstudio\Ollama\Facades\Ollama;

class LlamaController extends Controller
{
    // Mostrar todas las áreas con sus cargos y usuarios
    public function index(Request $request)
    {
        $ask = $request->input('ask');
        
        try{
           $response = Ollama::agent('Eres una asistente de CIMUN (Centro de Incidencias Municipales)')
                    ->prompt('Ayudas sobre el incidente de acuerdo a la solicitud "'.$ask.'", debes entregar una respuesta unica para descripcion del incidente maximo 200 caracteres.')
                    ->model('ollama.com/library/llama3.2:latest')
                    ->ask($ask);
            
            return $response['response'];
    
        } catch (\Throwable $e) {
            // Catch any other general exceptions or errors
            \Log::error($e->getMessage());
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
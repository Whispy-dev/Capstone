<?php
namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
    // Mostrar todas las áreas con sus cargos y usuarios
    public function index()
    {
        $areas = Area::with(['positions', 'users'])->get();
        return view('areas.index', compact('areas'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('areas.create');
    }

    // Guardar nueva área
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['created_by'] = Auth::id();
        $validated['updated_by'] = Auth::id();

        Area::create($validated);

        return redirect()->route('areas.index')->with('success', 'Área creada correctamente.');
    }

    // Mostrar detalles de un área específica
    public function show($id)
    {
        $area = Area::with(['positions', 'users'])->findOrFail($id);
        return view('areas.show', compact('area'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('areas.edit', compact('area'));
    }

    // Actualizar área
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $area = Area::findOrFail($id);
        $validated['updated_by'] = Auth::id();
        $area->update($validated);

        return redirect()->route('areas.index')->with('success', 'Área actualizada correctamente.');
    }

    // Eliminar (soft delete)
    public function destroy($id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Área eliminada correctamente.');
    }
}
<?php
namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    // Mostrar todos los cargos con su área y usuarios asignados
    public function index()
    {
        $positions = Position::with(['area', 'users'])->get();
        return view('positions.index', compact('positions'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $areas = Area::all();
        return view('positions.create', compact('areas'));
    }

    // Guardar nuevo cargo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'area_id' => 'required|exists:areas,id',
        ]);

        Position::create($validated);

        return redirect()->route('positions.index')->with('success', 'Cargo creado correctamente.');
    }

    // Mostrar detalles de un cargo específico
    public function show($id)
    {
        $position = Position::with(['area', 'users'])->findOrFail($id);
        return view('positions.show', compact('position'));
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $position = Position::findOrFail($id);
        $areas = Area::all();
        return view('positions.edit', compact('position', 'areas'));
    }

    // Actualizar cargo
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'area_id' => 'required|exists:areas,id',
        ]);

        $position = Position::findOrFail($id);
        $position->update($validated);

        return redirect()->route('positions.index')->with('success', 'Cargo actualizado correctamente.');
    }

    // Eliminar (soft delete)
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Cargo eliminado correctamente.');
    }

    // Asignar cargo a usuario
    public function assignToUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'position_id' => 'required|exists:positions,id',
            'assigned_at' => 'required|date',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $user->positions()->attach($validated['position_id'], [
            'assigned_at' => $validated['assigned_at'],
        ]);

        return redirect()->back()->with('success', 'Cargo asignado al usuario.');
    }

    // Remover cargo de usuario
    public function removeFromUser(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $user->positions()->detach($validated['position_id']);

        return redirect()->back()->with('success', 'Cargo removido del usuario.');
    }
}
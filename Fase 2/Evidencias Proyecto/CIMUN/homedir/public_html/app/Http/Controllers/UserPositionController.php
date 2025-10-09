<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserPositionController extends Controller
{
    public function index(User $user)
    {
        $user->load('positions.area'); // Eager load área asociada
        return view('users.user_positions', compact('user'));
    }

    public function create(User $user)
    {
        $positions = Position::with('area')->get();
        return view('users.assign_position', compact('user', 'positions'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'position_id' => 'required|exists:positions,id',
            'assigned_at' => 'nullable|date',
        ]);

        $user->positions()->attach($request->position_id, [
            'assigned_at' => $request->assigned_at ?? Carbon::now(),
        ]);

        return redirect()->route('users.positions', $user->id)
                         ->with('success', 'Cargo asignado correctamente.');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'position_id' => 'required|exists:positions,id',
        ]);

        $user = User::findOrFail($request->user_id);

        // Opcional: marcar fecha de finalización en vez de detach
        $user->positions()->updateExistingPivot($request->position_id, [
            'ended_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Cargo removido correctamente.');
    }
}
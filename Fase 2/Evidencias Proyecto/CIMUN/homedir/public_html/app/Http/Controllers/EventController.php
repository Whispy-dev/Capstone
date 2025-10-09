<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    // Mostrar todos los eventos en la vista del calendario
    public function index()
    {
        $events = Event::all();
        return view('calendar.calendar', compact('events'));
    }

    // Devolver eventos en formato JSON para FullCalendar (sin JS personalizado)
    public function getEvents()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start->format('Y-m-d H:i:s'),
                'end' => $event->end ? $event->end->format('Y-m-d H:i:s') : null,
                'description' => $event->description,
                'type' => $event->type,
                'location' => $event->location,
                'className' => $this->getEventClass($event->type),
                'backgroundColor' => $this->getEventColor($event->type),
                'borderColor' => $this->getEventColor($event->type),
            ];
        });

        return response()->json($events);
    }

    // Mostrar formulario para crear evento
    public function create()
    {
        return view('calendar.create');
    }

    // Crear un nuevo evento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:interna,externa,incidente',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'location' => 'nullable|string|max:255',
        ]);

        Event::create($validated);

        return redirect()->route('calendar.index')->with('success', 'Evento creado correctamente');
    }

    // Mostrar un evento específico
    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('calendar.show', compact('event'));
    }

    // Mostrar formulario para editar evento
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('calendar.edit', compact('event'));
    }

    // Actualizar un evento existente
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:interna,externa,incidente',
            'start' => 'required|date',
            'end' => 'nullable|date|after_or_equal:start',
            'location' => 'nullable|string|max:255',
        ]);

        $event->update($validated);

        return redirect()->route('calendar.index')->with('success', 'Evento actualizado correctamente');
    }

    // Eliminar un evento
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        
        return redirect()->route('calendar.index')->with('success', 'Evento eliminado correctamente');
    }

    // Método privado para obtener la clase CSS según el tipo
    private function getEventClass($type)
    {
        return match($type) {
            'interna' => 'event-primary',
            'externa' => 'event-success', 
            'incidente' => 'event-danger',
            default => 'event-secondary'
        };
    }

    // Método privado para obtener el color según el tipo
    private function getEventColor($type)
    {
        return match($type) {
            'interna' => '#3788d8',
            'externa' => '#28a745',
            'incidente' => '#dc3545', 
            default => '#6c757d'
        };
    }
}
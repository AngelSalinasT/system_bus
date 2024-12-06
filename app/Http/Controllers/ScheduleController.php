<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Route;
use App\Models\Bus;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    // Mostrar todos los horarios
    public function index()
    {
        // Obtener todos los horarios con las rutas y autobuses relacionados
        $schedules = Schedule::with(['route', 'bus'])->get();
        return view('schedules.index', compact('schedules')); // Retornar la vista con la lista de horarios
    }

    // Mostrar el formulario para crear un nuevo horario
    public function create()
    {
        // Obtener todas las rutas y autobuses disponibles para asignarlos al horario
        $routes = Route::all();
        $buses = Bus::all();
        return view('schedules.create', compact('routes', 'buses')); // Retorna el formulario de creación
    }

    // Almacenar un nuevo horario en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'bus_id' => 'required|exists:buses,id',
            'date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'nullable|date_format:H:i',
        ]);

        // Crear el nuevo horario
        Schedule::create([
            'route_id' => $request->route_id,
            'bus_id' => $request->bus_id,
            'date' => $request->date,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    // Mostrar el formulario para editar un horario
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id); // Buscar el horario por su ID
        $routes = Route::all(); // Obtener todas las rutas
        $buses = Bus::all(); // Obtener todos los autobuses
        return view('schedules.edit', compact('schedule', 'routes', 'buses')); // Retorna la vista de edición
    }

    // Actualizar un horario en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'route_id' => 'required|exists:routes,id',
            'bus_id' => 'required|exists:buses,id',
            'date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'nullable|date_format:H:i',
        ]);

        $schedule = Schedule::findOrFail($id); // Buscar el horario por su ID
        $schedule->update([
            'route_id' => $request->route_id,
            'bus_id' => $request->bus_id,
            'date' => $request->date,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    // Eliminar un horario
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id); // Buscar el horario por su ID
        $schedule->delete(); // Eliminar el horario

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}

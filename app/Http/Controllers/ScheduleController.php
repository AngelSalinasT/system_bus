<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Route;
use App\Models\Bus;
use App\Http\Resources\ScheduleCollection;
use App\Filters\ScheduleFilter;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Http\Requests\UpdateScheduleRequest;
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
    public function Store(StoreScheduleRequest $request){
        return new ScheduleResource(Schedule::create($request->all()));
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
    public function update(UpdateScheduleRequest $request, Schedule $Schedule){
        $Schedule->update($request->all());
    }

    // Eliminar un horario
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id); // Buscar el horario por su ID
        $schedule->delete(); // Eliminar el horario

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }

    public function apiIndex(Request $request){
        $filter = new ScheduleFilter();
        $queryItems = $filter->transform($request);
        $includeTickets = request()->query('includeTickets');
        $schedules = Schedule::where($queryItems);
        if($includeTickets){
            $schedules = $schedules->with('tickets');
        }
        return new ScheduleCollection($schedules->paginate()->appends($request->query()));
    }

}

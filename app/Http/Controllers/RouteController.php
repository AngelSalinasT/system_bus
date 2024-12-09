<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Branch;
use App\Http\Resources\RouteCollection;
use App\Filters\RouteFilter;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // Mostrar todas las rutas
    public function index()
    {
        $routes = Route::with('branch')->get(); // Obtener todas las rutas con sus sucursales asociadas
        return view('routes.index', compact('routes')); // Retorna la vista con la lista de rutas
    }

    // Mostrar el formulario para crear una nueva ruta
    public function create()
    {
        $branches = Branch::all(); // Obtener todas las sucursales para asociarlas a la ruta
        return view('routes.create', compact('branches')); // Retorna el formulario de creación
    }

    // Almacenar una nueva ruta en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'nullable|numeric',
            'estimated_time' => 'nullable',
            'branch_id' => 'required|exists:branches,id', // Verificar que la sucursal exista
        ]);

        // Crear la nueva ruta
        Route::create([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'distance' => $request->distance,
            'estimated_time' => $request->estimated_time,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('routes.index')->with('success', 'Route created successfully.');
    }

    // Mostrar el formulario para editar una ruta
    public function edit($id)
    {
        $route = Route::findOrFail($id); // Buscar la ruta por su ID
        $branches = Branch::all(); // Obtener todas las sucursales para asociarlas
        return view('routes.edit', compact('route', 'branches')); // Retorna la vista con los datos de la ruta
    }

    // Actualizar una ruta en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'nullable|numeric',
            'estimated_time' => 'nullable',
            'branch_id' => 'required|exists:branches,id', // Verificar que la sucursal exista
        ]);

        $route = Route::findOrFail($id); // Buscar la ruta por su ID
        $route->update([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'distance' => $request->distance,
            'estimated_time' => $request->estimated_time,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
    }

    // Eliminar una ruta
    public function destroy($id)
    {
        $route = Route::findOrFail($id); // Buscar la ruta por su ID
        $route->delete(); // Eliminar la ruta

        return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
    }

    public function apiIndex(Request $request){
        $filter = new RouteFilter();
        $queryItems = $filter->transform($request);
        $includeSchedules = request()->query('includeSchedules');
        $routes = Route::where($queryItems);
        if($includeSchedules){
            $routes = $routes->with('schedules');
        }
        return new RouteCollection($routes->paginate()->appends($request->query()));
    }
}

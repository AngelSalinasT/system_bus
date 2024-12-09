<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Branch;
use App\Http\Resources\RouteCollection;
use App\Filters\RouteFilter;
use App\Http\Requests\StoreRouteRequest;
use App\Http\Requests\UpdateRouteRequest;
use App\Http\Resources\RouteResource;
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
    public function Store(StoreRouteRequest $request){
        return new RouteResource(Route::create($request->all()));
    }

    // Mostrar el formulario para editar una ruta
    public function edit($id)
    {
        $route = Route::findOrFail($id); // Buscar la ruta por su ID
        $branches = Branch::all(); // Obtener todas las sucursales para asociarlas
        return view('routes.edit', compact('route', 'branches')); // Retorna la vista con los datos de la ruta
    }

    // Actualizar una ruta en la base de datos
    public function update(UpdateRouteRequest $request, Route $Route){
        $Route->update($request->all());
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

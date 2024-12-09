<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Http\Resources\BusCollection;
use App\Filters\BusFilter;
use App\Http\Requests\StoreBusRequest;
use App\Http\Requests\UpdateBusRequest;
use App\Http\Resources\BusResource;
use Illuminate\Http\Request;

class BusController extends Controller
{
    // Mostrar todos los autobuses
    public function index()
    {
        $buses = Bus::all(); // Obtener todos los autobuses
        return view('buses.index', compact('buses')); // Retornar la vista con la lista de autobuses
    }

    // Mostrar el formulario para crear un nuevo autobús
    public function create()
    {
        return view('buses.create'); // Retorna la vista del formulario de creación
    }

    // Almacenar un nuevo autobús en la base de datos
    public function Store(StoreBusRequest $request){
        return new BusResource(Bus::create($request->all()));
    }

    // Mostrar el formulario para editar un autobús
    public function edit($id)
    {
        $bus = Bus::findOrFail($id); // Buscar el autobús por su ID
        return view('buses.edit', compact('bus')); // Retorna la vista de edición con los datos del autobús
    }

    // Actualizar un autobús en la base de datos

    public function update(UpdateBusRequest $request, Bus $Bus){
        $Bus->update($request->all());
    }

    // Eliminar un autobús
    public function destroy($id)
    {
        $bus = Bus::findOrFail($id); // Buscar el autobús por su ID
        $bus->delete(); // Eliminar el autobús

        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }

    public function apiIndex(Request $request){
        $filter = new BusFilter();
        $queryItems = $filter->transform($request);
        $includeSchedules = request()->query('includeSchedules');
        $buses = Bus::where($queryItems);
        if($includeSchedules){
            $buses = $buses->with('schedules');
        }
        return new BusCollection($buses->paginate()->appends($request->query()));
    }
}

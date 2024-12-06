<?php

namespace App\Http\Controllers;

use App\Models\Bus;
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
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'plates' => 'required|string|max:255|unique:buses',
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        // Crear el nuevo autobús
        Bus::create([
            'plates' => $request->plates,
            'model' => $request->model,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    // Mostrar el formulario para editar un autobús
    public function edit($id)
    {
        $bus = Bus::findOrFail($id); // Buscar el autobús por su ID
        return view('buses.edit', compact('bus')); // Retorna la vista de edición con los datos del autobús
    }

    // Actualizar un autobús en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'plates' => 'required|string|max:255|unique:buses,plates,' . $id,
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer',
        ]);

        $bus = Bus::findOrFail($id); // Buscar el autobús por su ID
        $bus->update([
            'plates' => $request->plates,
            'model' => $request->model,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    // Eliminar un autobús
    public function destroy($id)
    {
        $bus = Bus::findOrFail($id); // Buscar el autobús por su ID
        $bus->delete(); // Eliminar el autobús

        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }
}

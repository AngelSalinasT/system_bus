<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Route;
use App\Models\Branch;

class RouteComponent extends Component
{
    use WithPagination;

    public $route_name, $origin, $destination, $distance, $estimated_time, $branch_id, $isEditMode = false, $routeId;
    public $branches;  // Para almacenar las sucursales disponibles

    // Reglas de validación
    protected $rules = [
        'route_name' => 'required|string|max:255',
        'origin' => 'required|string|max:255',
        'destination' => 'required|string|max:255',
        'distance' => 'nullable|numeric',
        'estimated_time' => 'nullable|date_format:H:i',
        'branch_id' => 'required|exists:branches,id',
    ];


    public function render()
    {
        // Traemos las rutas con paginación
        $routes = Route::paginate(10);
        $this->branches = Branch::all(); // Traemos las sucursales disponibles
        return view('livewire.route-component', compact('routes'));
    }

    // Crear una nueva ruta
    public function createRoute()
    {
        $this->validate(); // Validamos los datos

        Route::create([
            'route_name' => $this->route_name,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'distance' => $this->distance,
            'estimated_time' => $this->estimated_time,
            'branch_id' => $this->branch_id,
        ]);

        session()->flash('message', 'Route created successfully!');
        $this->resetFields();  // Limpiamos los campos
    }

    // Editar una ruta existente
    public function editRoute($id)
    {
        $route = Route::findOrFail($id); // Encontramos la ruta por su ID

        // Rellenamos los campos con los datos actuales de la ruta
        $this->routeId = $route->id;
        $this->route_name = $route->route_name;
        $this->origin = $route->origin;
        $this->destination = $route->destination;
        $this->distance = $route->distance;
        $this->estimated_time = $route->estimated_time;
        $this->branch_id = $route->branch_id;

        $this->isEditMode = true; // Cambiamos el modo a edición
    }

    // Actualizar una ruta
    public function updateRoute()
    {
        $this->validate(); // Validamos los datos

        $route = Route::findOrFail($this->routeId); // Encontramos la ruta

        // Actualizamos la ruta con los nuevos datos
        $route->update([
            'route_name' => $this->route_name,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'distance' => $this->distance,
            'estimated_time' => $this->estimated_time,
            'branch_id' => $this->branch_id,
        ]);

        session()->flash('message', 'Route updated successfully!');
        $this->resetFields();  // Limpiamos los campos
    }

    // Eliminar una ruta
    public function deleteRoute($id)
    {
        $route = Route::findOrFail($id);
        $route->delete(); // Eliminamos la ruta

        session()->flash('message', 'Route deleted successfully!');
    }

    // Resetear los campos del formulario
    public function resetFields()
    {
        $this->route_name = '';
        $this->origin = '';
        $this->destination = '';
        $this->distance = '';
        $this->estimated_time = '';
        $this->branch_id = '';
        $this->isEditMode = false; // Desactivar el modo de edición
    }
}

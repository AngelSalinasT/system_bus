<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bus;

class BusComponent extends Component
{
    public $buses;
    public $plates;
    public $model;
    public $capacity;
    public $bus_id;
    public $isEditMode = false;

    // Reglas de validación
    protected $rules = [
        'plates' => 'required|string|max:255|unique:buses,plates',
        'model' => 'required|string|max:255',
        'capacity' => 'required|integer|min:1',
    ];

    // Mensajes personalizados
    protected $messages = [
        'plates.required' => 'Plates are required.',
        'model.required' => 'Model is required.',
        'capacity.required' => 'Capacity is required.',
    ];

    public function render()
    {
        $this->buses = Bus::all(); // Cargar buses junto con sus horarios

        return view('livewire.bus-component');
    }

    public function resetFields()
    {
        $this->plates = '';
        $this->model = '';
        $this->capacity = '';
        $this->bus_id = null;
        $this->isEditMode = false;
    }

    public function createBus()
    {
        $this->validate();

        Bus::create([
            'plates' => $this->plates,
            'model' => $this->model,
            'capacity' => $this->capacity,
        ]);

        session()->flash('message', 'Bus created successfully!');
        $this->resetFields();
    }

    public function editBus($id)
    {
        $bus = Bus::findOrFail($id);

        $this->bus_id = $bus->id;
        $this->plates = $bus->plates;
        $this->model = $bus->model;
        $this->capacity = $bus->capacity;
        $this->isEditMode = true;
    }

    public function updateBus()
    {
        $this->validate([
            'plates' => 'required|string|max:255|unique:buses,plates,' . $this->bus_id,
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $bus = Bus::findOrFail($this->bus_id);
        $bus->update([
            'plates' => $this->plates,
            'model' => $this->model,
            'capacity' => $this->capacity,
        ]);

        session()->flash('message', 'Bus updated successfully!');
        $this->resetFields();
    }

    public function deleteBus($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();

        session()->flash('message', 'Bus deleted successfully!');
    }
}

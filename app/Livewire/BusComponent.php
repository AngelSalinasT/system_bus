<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Bus;
use App\Models\Branch;

class BusComponent extends Component
{
    public $buses;
    public $branches;
    public $license_plate;
    public $model;
    public $capacity;
    public $branch_id;
    public $bus_id;
    public $isEditMode = false;

    // Reglas de validación
    protected $rules = [
        'license_plate' => 'required|string|max:255|unique:buses,license_plate',
        'model' => 'required|string|max:255',
        'capacity' => 'required|integer|min:1',
        'branch_id' => 'required|exists:branches,id',
    ];

    // Mensajes personalizados
    protected $messages = [
        'license_plate.required' => 'License plate is required.',
        'model.required' => 'Model is required.',
        'capacity.required' => 'Capacity is required.',
        'branch_id.required' => 'Please select a branch.',
    ];

    public function render()
    {
        $this->buses = Bus::with('branch')->get(); // Cargar buses junto con sus sucursales
        $this->branches = Branch::all(); // Cargar todas las sucursales
        return view('livewire.bus-component');
    }

    public function resetFields()
    {
        $this->license_plate = '';
        $this->model = '';
        $this->capacity = '';
        $this->branch_id = '';
        $this->bus_id = null;
        $this->isEditMode = false;
    }

    public function createBus()
    {
        $this->validate();

        Bus::create([
            'license_plate' => $this->license_plate,
            'model' => $this->model,
            'capacity' => $this->capacity,
            'branch_id' => $this->branch_id,
        ]);

        session()->flash('message', 'Bus created successfully!');
        $this->resetFields();
    }

    public function editBus($id)
    {
        $bus = Bus::findOrFail($id);

        $this->bus_id = $bus->id;
        $this->license_plate = $bus->license_plate;
        $this->model = $bus->model;
        $this->capacity = $bus->capacity;
        $this->branch_id = $bus->branch_id;
        $this->isEditMode = true;
    }

    public function updateBus()
    {
        $this->validate([
            'license_plate' => 'required|string|max:255|unique:buses,license_plate,' . $this->bus_id,
            'model' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $bus = Bus::findOrFail($this->bus_id);
        $bus->update([
            'license_plate' => $this->license_plate,
            'model' => $this->model,
            'capacity' => $this->capacity,
            'branch_id' => $this->branch_id,
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

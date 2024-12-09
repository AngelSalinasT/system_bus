<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Branch;

class BranchComponent extends Component
{
    public $branches;
    public $name;
    public $address;
    public $phone;
    public $branch_id;
    public $isEditMode = false;

    // Reglas de validación
    protected $rules = [
        'name' => 'required|string|max:255|unique:branches,name',
        'address' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
    ];

    // Mensajes personalizados
    protected $messages = [
        'name.required' => 'Branch name is required.',
        'address.required' => 'Address is required.',
        'phone.required' => 'Phone number is required.',
    ];

    public function render()
    {
        $this->branches = Branch::all(); // Cargar todas las sucursales
        return view('livewire.branch-component');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->address = '';
        $this->phone = '';
        $this->branch_id = null;
        $this->isEditMode = false;
    }

    public function createBranch()
    {
        $this->validate();

        Branch::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Branch created successfully!');
        $this->resetFields();
    }

    public function editBranch($id)
    {
        $branch = Branch::findOrFail($id);

        $this->branch_id = $branch->id;
        $this->name = $branch->name;
        $this->address = $branch->address;
        $this->phone = $branch->phone;
        $this->isEditMode = true;
    }

    public function updateBranch()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:branches,name,' . $this->branch_id,
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $branch = Branch::findOrFail($this->branch_id);
        $branch->update([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Branch updated successfully!');
        $this->resetFields();
    }

    public function deleteBranch($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        session()->flash('message', 'Branch deleted successfully!');
    }
}

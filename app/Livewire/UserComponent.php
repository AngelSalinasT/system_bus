<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserComponent extends Component
{
    public $users, $user_id;
    public $name, $email, $password, $password_confirmation;

    public $isEditMode = false;

    // Renderizar la vista con todos los usuarios
    public function render()
    {
        $this->users = User::all(); // Cargar todos los usuarios
        return view('livewire.user-component');
    }

    // Reiniciar los campos
    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->isEditMode = false;
    }

    // Crear un nuevo usuario
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|same:password_confirmation',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        session()->flash('success', 'User created successfully.');
        $this->resetFields();
    }

    // Cargar datos de un usuario para edición
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isEditMode = true;
    }

    // Actualizar un usuario
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
            'password' => 'nullable|min:8|same:password_confirmation',
        ]);

        $user = User::findOrFail($this->user_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        session()->flash('success', 'User updated successfully.');
        $this->resetFields();
    }

    // Eliminar un usuario
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('success', 'User deleted successfully.');
    }
}

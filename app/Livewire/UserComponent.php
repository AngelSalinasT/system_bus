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

    // Crear nuevo usuario
    public function createUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt('password'), // Contraseña por defecto
        ]);

        session()->flash('message', 'User created successfully.');
        $this->resetFields();
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $this->name = $user->name;      // Asigna el nombre al formulario
        $this->email = $user->email;    // Asigna el email al formulario
        $this->user_id = $user->id;      // Guarda el ID del usuario
        $this->isEditMode = true;       // Cambia a modo de edición
    }


    // Actualizar usuario
    public function updateUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->user_id,
        ]);

        $user = User::find($this->user_id);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        session()->flash('message', 'User updated successfully.');
        $this->resetFields();
    }

    // Eliminar usuario
    public function deleteUser($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }
}

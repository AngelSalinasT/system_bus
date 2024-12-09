<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserComponent extends Component
{
    public $users;
    public $name, $email, $role, $password, $password_confirmation, $isEditMode = false, $userId;

    // Inicialización de los usuarios
    public function mount()
    {
        $this->users = User::all();
    }

    // Función para resetear los campos del formulario
    public function resetFields()
    {
        $this->name = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->isEditMode = false;
    }

    // Función para crear un nuevo usuario
    public function createUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:8|confirmed', // Validación de contraseña
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'password' => Hash::make($this->password), // Encriptamos la contraseña
        ]);

        session()->flash('message', 'User created successfully.');
        $this->resetFields();
    }

    // Función para editar un usuario existente
    public function editUser($userId)
    {
        $this->isEditMode = true;
        $user = User::find($userId);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = ''; // No mostramos la contraseña en la edición
        $this->password_confirmation = ''; // Para manejar la confirmación de la contraseña
    }

    // Función para actualizar un usuario
    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->userId)],
            'role' => 'required|in:admin,user',
            // Validación de la contraseña solo si es nueva
            'password' => 'nullable|string|min:8|confirmed', // Es opcional durante la edición
        ]);

        $user = User::find($this->userId);

        // Si la contraseña fue proporcionada, la actualizamos
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->name = $this->name;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->save();

        session()->flash('message', 'User updated successfully.');
        $this->resetFields();
    }

    // Función para eliminar un usuario
    public function deleteUser($userId)
    {
        User::find($userId)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

    public function render()
    {
        return view('livewire.user-component');
    }
}

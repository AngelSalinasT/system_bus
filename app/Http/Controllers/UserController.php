<?php

namespace App\Http\Controllers;

use App\Filters\UserFilter;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index()
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('users.index', compact('users')); // Retorna la vista con la lista de usuarios
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        return view('users.create'); // Retorna el formulario de creación
    }

    // Almacenar un nuevo usuario en la base de datos
    public function Store(StoreUserRequest $request){
        return new UserResource(User::create($request->all()));
    }

    // Mostrar el formulario para editar un usuario
    public function edit($id)
    {
        $user = User::findOrFail($id); // Buscar al usuario por su ID
        return view('users.edit', compact('user')); // Retorna el formulario de edición con los datos del usuario
    }

    // Actualizar la información de un usuario
    public function update(UpdateUserRequest $request, User $user){
        $user->update($request->all());
    }

    // Eliminar un usuario
    public function destroy($id)
    {
        $user = User::findOrFail($id); // Buscar al usuario por su ID
        $user->delete(); // Eliminar al usuario

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function apiIndex(Request $request){
        $filter = new UserFilter();
        $queryItems = $filter->transform($request);
        $includeTickets = request()->query('includeTickets');
        $users = User::where($queryItems);
        if($includeTickets){
            $users = $users->with('tickets');
        }
        return new UserCollection($users->paginate()->appends($request->query()));
    }
}

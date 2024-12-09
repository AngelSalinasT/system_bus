<div>
    <!-- Mensaje de éxito o error -->
    @if (session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo usuario -->
    <button wire:click="resetFields" class="btn btn-primary mb-4 mt-6 bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
        Add New User
    </button>

    <!-- Formulario de creación/edición -->
    <form wire:submit.prevent="{{ $isEditMode ? 'updateUser' : 'createUser' }}" class="space-y-4 max-w-md mx-auto">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model="name" id="name" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Name">
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email" id="email" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Email">
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select wire:model="role" id="role" class="form-select mt-1 block w-full p-2 border rounded-md shadow-sm">
                <option value="">-- Select a Role --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            @error('role')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Mostrar campo de contraseña solo cuando estamos en modo de edición -->
        @if (!$isEditMode || $password)
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" wire:model="password" id="password" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Password">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        @endif

        <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
            {{ $isEditMode ? 'Update User' : 'Create User' }}
        </button>
    </form>

    <!-- Lista de usuarios -->
    <div class="mt-6">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Role</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-sm">{{ $user->role }}</td>
                        <td class="px-4 py-2 text-sm">
                            <button wire:click="editUser({{ $user->id }})" class="btn btn-info bg-yellow-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-600">
                                Edit
                            </button>
                            <button wire:click="deleteUser({{ $user->id }})" class="btn btn-info bg-red-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-red-800">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

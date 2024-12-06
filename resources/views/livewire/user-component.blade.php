<div>
    <div class="p-6 max-w-md mx-auto bg-white shadow rounded-lg">
        <form wire:submit.prevent="store" class="space-y-4">
            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Correo -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" wire:model="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Botón -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg shadow hover:bg-indigo-700">
                Submit
            </button>
        </form>
    </div>

    <!-- Tabla de usuarios -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button wire:click="edit({{ $user->id }})">Edit</button>
                        <button wire:click="delete({{ $user->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>
    <h2 class="text-3xl font-semibold mb-6">Users</h2>

    <!-- Mensaje de éxito o error -->
    @if (session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo usuario -->
    <button wire:click="resetFields" class="btn btn-primary mb-4 bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
        Add New User
    </button>

    @if ($isEditMode)
    <!-- Formulario de edición de usuario -->
    <form wire:submit.prevent="updateUser" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model="name" id="name" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Name">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email" id="email" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Email">
        </div>

        <button type="submit" class="btn btn-success bg-green-700 text-black px-4 py-2 rounded-md shadow-sm hover:bg-green-600">
            Update User
        </button>
        
    </form>
@else
    <!-- Formulario de creación de usuario -->
    <form wire:submit.prevent="createUser" class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model="name" id="name" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Name">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="email" id="email" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Email">
        </div>

        <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
            Create User
        </button>
    </form>
@endif


    <!-- Lista de usuarios -->
    <div class="mt-6">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Password</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $user->name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $user->email }}</td>
                        <td class="px-4 py-2 text-sm">{{ $user->password }}</td>
                        <td class="px-4 py-2 text-sm">
                            <button wire:click="editUser({{ $user->id }})" class="btn btn-info bg-yellow-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-600">
                                Edit
                            </button>
                            <button wire:click="editUser({{ $user->id }})" class="bg-red-500 text-white px-4 py-2 rounded-md shadow-sm">
                                Delete
                            </button>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

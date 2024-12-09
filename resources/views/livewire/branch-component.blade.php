<div>
    <!-- Mensaje de éxito o error -->
    @if (session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para crear una nueva sucursal -->
    <button wire:click="resetFields"
        class="btn btn-primary mb-4 mt-6 bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
        Add New Branch
    </button>

    <!-- Formulario de creación/edición -->
    <form wire:submit.prevent="{{ $isEditMode ? 'updateBranch' : 'createBranch' }}" class="space-y-4 max-w-md mx-auto">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" wire:model="name" id="name"
                class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Branch Name">
            @error('name')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" wire:model="address" id="address"
                class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Address">
            @error('address')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" wire:model="phone" id="phone"
                class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Phone">
            @error('phone')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
            class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
            {{ $isEditMode ? 'Update Branch' : 'Create Branch' }}
        </button>
    </form>

    <!-- Lista de sucursales -->
    <div class="mt-6">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Address</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Phone</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $branch->name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $branch->address }}</td>
                        <td class="px-4 py-2 text-sm">{{ $branch->phone }}</td>
                        <td class="px-4 py-2 text-sm">
                            <button wire:click="editBranch({{ $branch->id }})"
                                class="btn btn-info bg-yellow-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-600">
                                Edit
                            </button>
                            <button wire:click="deleteBranch({{ $branch->id }})"
                                class="btn btn-info bg-red-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-red-800">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

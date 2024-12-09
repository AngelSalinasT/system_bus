<div>
    <!-- Mensaje de éxito o error -->
    @if (session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para agregar un nuevo bus -->
    <button wire:click="resetFields" class="btn btn-primary mb-4 mt-8 bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
        Add New Bus
    </button>

    <!-- Formulario de creación/edición -->
    <form wire:submit.prevent="{{ $isEditMode ? 'updateBus' : 'createBus' }}" class="space-y-4 max-w-md mx-auto">
        <div>
            <label for="plates" class="block text-sm font-medium text-gray-700">Plates</label>
            <input type="text" wire:model="plates" id="plates" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Plates">
            @error('plates') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
            <input type="text" wire:model="model" id="model" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Model">
            @error('model') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="capacity" class="block text-sm font-medium text-gray-700">Capacity</label>
            <input type="number" wire:model="capacity" id="capacity" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Capacity">
            @error('capacity') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
            {{ $isEditMode ? 'Update Bus' : 'Create Bus' }}
        </button>
    </form>

    <!-- Lista de buses -->
    <div class="mt-6">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Plates</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Model</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Capacity</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buses as $bus)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $bus->plates }}</td>
                        <td class="px-4 py-2 text-sm">{{ $bus->model }}</td>
                        <td class="px-4 py-2 text-sm">{{ $bus->capacity }}</td>
                        <td class="px-4 py-2 text-sm">
                            <button wire:click="editBus({{ $bus->id }})" class="btn btn-info bg-yellow-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-600">
                                Edit
                            </button>
                            <button wire:click="deleteBus({{ $bus->id }})" class="btn btn-info bg-red-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-red-800">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

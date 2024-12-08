<div>
    <h2 class="text-3xl font-semibold mb-6">Routes</h2>

    <!-- Mensaje de éxito o error -->
    @if (session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para crear una nueva ruta -->
    <button wire:click="resetFields"
        class="btn btn-primary mb-4 bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
        Add New Route
    </button>

    @if ($isEditMode)
        <!-- Formulario de edición de ruta -->
        <form wire:submit.prevent="updateRoute" class="space-y-4 max-w-md mx-auto">
            <div>
                <label for="route_name" class="block text-sm font-medium text-gray-700">Route Name</label>
                <input type="text" wire:model="route_name" id="route_name"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Route Name">
            </div>

            <div>
                <label for="origin" class="block text-sm font-medium text-gray-700">Origin</label>
                <input type="text" wire:model="origin" id="origin"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Origin">
            </div>

            <div>
                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                <input type="text" wire:model="destination" id="destination"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Destination">
            </div>

            <div>
                <label for="distance" class="block text-sm font-medium text-gray-700">Distance</label>
                <input type="text" wire:model="distance" id="distance"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Distance">
            </div>

            <div>
                <label for="estimated_time" class="block text-sm font-medium text-gray-700">Estimated Time</label>
                <input type="time" wire:model="estimated_time" id="estimated_time"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Estimated Time">
            </div>

            <div>
                <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
                <select wire:model="branch_id" id="branch_id"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="btn btn-success bg-green-700 text-white px-4 py-2 rounded-md shadow-sm hover:bg-green-600">
                Update Route
            </button>
        </form>
    @else
        <!-- Formulario de creación de ruta -->
        <form wire:submit.prevent="createRoute" class="space-y-4 max-w-md mx-auto">
            <div>
                <label for="route_name" class="block text-sm font-medium text-gray-700">Route Name</label>
                <input type="text" wire:model="route_name" id="route_name"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Route Name">
            </div>

            <div>
                <label for="origin" class="block text-sm font-medium text-gray-700">Origin</label>
                <input type="text" wire:model="origin" id="origin"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Origin">
            </div>

            <div>
                <label for="destination" class="block text-sm font-medium text-gray-700">Destination</label>
                <input type="text" wire:model="destination" id="destination"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Destination">
            </div>

            <div>
                <label for="distance" class="block text-sm font-medium text-gray-700">Distance</label>
                <input type="text" wire:model="distance" id="distance"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Distance">
            </div>

            <div>
                <label for="estimated_time" class="block text-sm font-medium text-gray-700">Estimated Time</label>
                <input type="time" wire:model="estimated_time" id="estimated_time"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Estimated Time">
            </div>

            <div>
                <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch</label>
                <select wire:model="branch_id" id="branch_id"
                    class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit"
                class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
                Create Route
            </button>
        </form>
        <!-- Mostrar los errores de validación -->
        @if ($errors->any())
            <div class="alert alert-danger  bg-red-100 text-red-800 mt-2 block p-4 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif

    <!-- Lista de rutas -->
    <div class="mt-6">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Route Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Origin</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Destination</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Distance</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($routes as $route)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $route->route_name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $route->origin }}</td>
                        <td class="px-4 py-2 text-sm">{{ $route->destination }}</td>
                        <td class="px-4 py-2 text-sm">{{ $route->distance }}</td>
                        <td class="px-4 py-2 text-sm">
                            <button wire:click="editRoute({{ $route->id }})"
                                class="btn btn-info bg-yellow-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-600">
                                Edit
                            </button>

                            <button wire:click="deleteRoute({{ $route->id }})"
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

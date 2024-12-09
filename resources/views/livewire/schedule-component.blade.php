<div>
    <!-- Mensaje de éxito o error -->
    @if (session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mt-6 mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para regresar al formulario de creación -->
    <button wire:click="resetFields"
        class="btn btn-primary mb-4 mt-6 bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
        Add New Schedule
    </button>

    <!-- Formulario de creación/edición -->
    <form wire:submit.prevent="{{ $isEditMode ? 'updateSchedule' : 'createSchedule' }}" class="space-y-4 max-w-md mx-auto">
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
            <input type="date" wire:model="date" id="date" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Date">
            @error('date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure Time</label>
            <input type="time" wire:model="departure_time" id="departure_time" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Departure Time">
            @error('departure_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="arrival_time" class="block text-sm font-medium text-gray-700">Arrival Time</label>
            <input type="time" wire:model="arrival_time" id="arrival_time" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Arrival Time">
            @error('arrival_time') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="route_id" class="block text-sm font-medium text-gray-700">Route</label>
            <select wire:model="route_id" id="route_id" class="form-select mt-1 block w-full p-2 border rounded-md shadow-sm">
                <option value="">-- Select a Route --</option>
                @foreach ($routes as $route)
                    <option value="{{ $route->id }}">{{ $route->route_name }} - {{ $route->origin }} - {{ $route->destination }}</option>
                @endforeach
            </select>
            @error('route_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
            <select wire:model="bus_id" id="bus_id" class="form-select mt-1 block w-full p-2 border rounded-md shadow-sm">
                <option value="">-- Select a Bus --</option>
                @foreach ($buses as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->plates }} - {{ $bus->model }}</option>
                @endforeach
            </select>
            @error('bus_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
            {{ $isEditMode ? 'Update Schedule' : 'Create Schedule' }}
        </button>
    </form>

    <!-- Lista de horarios -->
    <div class="mt-6">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Route</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Bus</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Date</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Departure Time</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Arrival Time</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                    <tr>
                        <td class="px-4 py-2">{{ $schedule->route->route_name }} - {{ $schedule->route->origin }} - {{ $schedule->route->destination }}</td>
                        <td class="px-4 py-2">{{ $schedule->bus->plates }} - {{ $schedule->bus->model }}</td>
                        <td class="px-4 py-2">{{ $schedule->date }}</td>
                        <td class="px-4 py-2">{{ $schedule->departure_time }}</td>
                        <td class="px-4 py-2">{{ $schedule->arrival_time }}</td>
                        <td class="px-4 py-2">
                            <button wire:click="editSchedule({{ $schedule->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md">Edit</button>
                            <button wire:click="deleteSchedule({{ $schedule->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $schedules->links() }}
        </div>
    </div>
</div>

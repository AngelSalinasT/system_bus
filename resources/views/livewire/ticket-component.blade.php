<div>
    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif

    <!-- Botón para crear un nuevo ticket -->
    <button wire:click="resetFields" class="btn btn-primary mb-4 mt-6 bg-blue-800 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
        Add New Ticket
    </button>

    <!-- Formulario de creación/edición -->
    <form wire:submit.prevent="{{ $isEditMode ? 'updateTicket' : 'createTicket' }}" class="space-y-4 max-w-md mx-auto">
        <div>
            <label for="passenger_name" class="block text-sm font-medium text-gray-700">Passenger Name</label>
            <input type="text" wire:model="passenger_name" id="passenger_name" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Passenger Name">
            @error('passenger_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="passenger_email" class="block text-sm font-medium text-gray-700">Passenger Email</label>
            <input type="email" wire:model="passenger_email" id="passenger_email" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Passenger Email">
            @error('passenger_email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="seat_number" class="block text-sm font-medium text-gray-700">Seat Number</label>
            <input type="number" wire:model="seat_number" id="seat_number" class="form-input mt-1 block w-full p-2 border rounded-md shadow-sm" placeholder="Seat Number">
            @error('seat_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
            <select wire:model="bus_id" id="bus_id" class="form-select mt-1 block w-full p-2 border rounded-md shadow-sm">
                <option value="">-- Select Bus --</option>
                @foreach ($buses as $bus)
                    <option value="{{ $bus->id }}">{{ $bus->license_plate }} - {{ $bus->model }}</option>
                @endforeach
            </select>
            @error('bus_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-600">
            {{ $isEditMode ? 'Update Ticket' : 'Create Ticket' }}
        </button>
    </form>

    <!-- Lista de tickets -->
    <div class="mt-6">
        <table class="table-auto w-full border-separate border-spacing-2">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Ticket Number</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Passenger Name</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Passenger Email</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Seat Number</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Bus</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                    <tr>
                        <td class="px-4 py-2 text-sm">{{ $ticket->generateTicketNumber() }}</td> <!-- Generación dinámica del ticket_number -->
                        <td class="px-4 py-2 text-sm">{{ $ticket->passenger_name }}</td>
                        <td class="px-4 py-2 text-sm">{{ $ticket->passenger_email }}</td>
                        <td class="px-4 py-2 text-sm">{{ $ticket->seat_number }}</td>
                        <td class="px-4 py-2 text-sm">{{ $ticket->bus->license_plate }} - {{ $ticket->bus->model }}</td>
                        <td class="px-4 py-2 text-sm">
                            <button wire:click="editTicket({{ $ticket->id }})" class="btn btn-info bg-yellow-500 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-600">
                                Edit
                            </button>
                            <button wire:click="deleteTicket({{ $ticket->id }})" class="btn btn-danger bg-red-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-red-800">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

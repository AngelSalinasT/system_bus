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
            <label for="schedule_id" class="block text-sm font-medium text-gray-700">Schedule</label>
            <select wire:model="schedule_id" id="schedule_id" class="form-select mt-1 block w-full p-2 border rounded-md shadow-sm">
                <option value="">-- Select Schedule --</option>
                @foreach ($schedules as $schedule)
                    <option value="{{ $schedule->id }}">{{ $schedule->departure_time }} - {{ $schedule->bus->plates }} - {{ $schedule->bus->model }}</option>
                @endforeach
            </select>
            @error('schedule_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Campo para seleccionar el usuario -->
        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
            <select wire:model="user_id" id="user_id" class="form-select mt-1 block w-full p-2 border rounded-md shadow-sm">
                <option value="">-- Select User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>
            @error('user_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
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
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Schedule</th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">User</th>
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
                        <td class="px-4 py-2 text-sm">{{ $ticket->schedule->departure_time }} - {{ $ticket->schedule->bus->license_plate }} - {{ $ticket->schedule->bus->model }}</td> <!-- Relación con schedule -->
                        <td class="px-4 py-2 text-sm">{{ $ticket->user->name }} - {{ $ticket->user->email }}</td> <!-- Relación con user -->
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

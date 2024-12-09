<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Schedule;

class TicketComponent extends Component
{
    public $tickets;
    public $users;
    public $schedules;
    public $passenger_name;
    public $passenger_email;
    public $seat_number;
    public $ticket_id;
    public $user_id;
    public $schedule_id;
    public $isEditMode = false;

    // Reglas de validación
    protected $rules = [
        'passenger_name' => 'required|string|max:255',
        'passenger_email' => 'required|email|max:255',
        'seat_number' => 'required|integer|min:1',
        'user_id' => 'required|exists:users,id', // Asegúrate de que el usuario esté seleccionado
        'schedule_id' => 'required|exists:schedules,id', // Asegúrate de que el schedule esté seleccionado
    ];

    // Mensajes personalizados
    protected $messages = [
        'passenger_name.required' => 'Passenger name is required.',
        'passenger_email.required' => 'Passenger email is required.',
        'seat_number.required' => 'Seat number is required.',
        'user_id.required' => 'Please select a user.',
        'schedule_id.required' => 'Please select a schedule.',
    ];

    public function render()
    {
        // Cargar los tickets, usuarios y horarios
        $this->tickets = Ticket::with('user', 'schedule')->get();
        $this->users = User::all();
        $this->schedules = Schedule::all();
        return view('livewire.ticket-component');
    }

    public function resetFields()
    {
        // Restablecer los campos después de crear o actualizar el ticket
        $this->passenger_name = '';
        $this->passenger_email = '';
        $this->seat_number = '';
        $this->user_id = '';
        $this->schedule_id = '';
        $this->ticket_id = null;
        $this->isEditMode = false;
    }

    public function createTicket()
    {
        // Validar y crear el ticket
        $this->validate();

        Ticket::create([
            'passenger_name' => $this->passenger_name,
            'passenger_email' => $this->passenger_email,
            'seat_number' => $this->seat_number,
            'user_id' => $this->user_id,
            'schedule_id' => $this->schedule_id,
        ]);

        session()->flash('message', 'Ticket created successfully!');
        $this->resetFields();
    }

    public function editTicket($id)
    {
        // Obtener el ticket y cargar sus datos para la edición
        $ticket = Ticket::findOrFail($id);

        $this->ticket_id = $ticket->id;
        $this->passenger_name = $ticket->passenger_name;
        $this->passenger_email = $ticket->passenger_email;
        $this->seat_number = $ticket->seat_number;
        $this->user_id = $ticket->user_id;
        $this->schedule_id = $ticket->schedule_id;
        $this->isEditMode = true;
    }

    public function updateTicket()
    {
        // Validar y actualizar el ticket
        $this->validate();

        $ticket = Ticket::findOrFail($this->ticket_id);
        $ticket->update([
            'passenger_name' => $this->passenger_name,
            'passenger_email' => $this->passenger_email,
            'seat_number' => $this->seat_number,
            'user_id' => $this->user_id,
            'schedule_id' => $this->schedule_id,
        ]);

        session()->flash('message', 'Ticket updated successfully!');
        $this->resetFields();
    }

    public function deleteTicket($id)
    {
        // Eliminar el ticket
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        session()->flash('message', 'Ticket deleted successfully!');
    }
}

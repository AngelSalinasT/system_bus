<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ticket;
use App\Models\Bus;

class TicketComponent extends Component
{
    public $tickets;
    public $buses;
    public $ticket_number;
    public $passenger_name;
    public $passenger_email;
    public $seat_number;
    public $bus_id;
    public $ticket_id;
    public $isEditMode = false;

    // Reglas de validación
    protected $rules = [
        'ticket_number' => 'required|string|unique:tickets,ticket_number',
        'passenger_name' => 'required|string|max:255',
        'passenger_email' => 'required|email|max:255',
        'seat_number' => 'required|integer|min:1',
        'bus_id' => 'required|exists:buses,id',
    ];

    // Mensajes personalizados
    protected $messages = [
        'ticket_number.required' => 'Ticket number is required.',
        'passenger_name.required' => 'Passenger name is required.',
        'passenger_email.required' => 'Passenger email is required.',
        'seat_number.required' => 'Seat number is required.',
        'bus_id.required' => 'Please select a bus.',
    ];

    public function render()
    {
        $this->tickets = Ticket::with('bus')->get(); // Cargar tickets junto con sus buses
        $this->buses = Bus::all(); // Cargar todos los buses
        return view('livewire.ticket-component');
    }

    public function resetFields()
    {
        $this->ticket_number = '';
        $this->passenger_name = '';
        $this->passenger_email = '';
        $this->seat_number = '';
        $this->bus_id = '';
        $this->ticket_id = null;
        $this->isEditMode = false;
    }

    public function createTicket()
    {
        $this->validate();

        Ticket::create([
            'ticket_number' => $this->ticket_number,
            'passenger_name' => $this->passenger_name,
            'passenger_email' => $this->passenger_email,
            'seat_number' => $this->seat_number,
            'bus_id' => $this->bus_id,
        ]);

        session()->flash('message', 'Ticket created successfully!');
        $this->resetFields();
    }

    public function editTicket($id)
    {
        $ticket = Ticket::findOrFail($id);

        $this->ticket_id = $ticket->id;
        $this->ticket_number = $ticket->ticket_number;
        $this->passenger_name = $ticket->passenger_name;
        $this->passenger_email = $ticket->passenger_email;
        $this->seat_number = $ticket->seat_number;
        $this->bus_id = $ticket->bus_id;
        $this->isEditMode = true;
    }

    public function updateTicket()
    {
        $this->validate([
            'ticket_number' => 'required|string|unique:tickets,ticket_number,' . $this->ticket_id,
            'passenger_name' => 'required|string|max:255',
            'passenger_email' => 'required|email|max:255',
            'seat_number' => 'required|integer|min:1',
            'bus_id' => 'required|exists:buses,id',
        ]);

        $ticket = Ticket::findOrFail($this->ticket_id);
        $ticket->update([
            'ticket_number' => $this->ticket_number,
            'passenger_name' => $this->passenger_name,
            'passenger_email' => $this->passenger_email,
            'seat_number' => $this->seat_number,
            'bus_id' => $this->bus_id,
        ]);

        session()->flash('message', 'Ticket updated successfully!');
        $this->resetFields();
    }

    public function deleteTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        session()->flash('message', 'Ticket deleted successfully!');
    }
}

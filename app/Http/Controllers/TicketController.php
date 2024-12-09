<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Schedule;
use App\Filters\TicketFilter;
use App\Http\Resources\TicketCollection;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Mostrar todos los boletos
    public function index()
    {
        // Obtener todos los boletos con los usuarios y horarios relacionados
        $tickets = Ticket::with(['user', 'schedule'])->get();
        return view('tickets.index', compact('tickets')); // Retorna la vista con la lista de boletos
    }

    // Mostrar el formulario para crear un nuevo boleto
    public function create()
    {
        // Obtener todos los horarios disponibles para asignarlos al boleto
        $schedules = Schedule::all();
        $users = User::all(); // Obtener todos los usuarios
        return view('tickets.create', compact('schedules', 'users')); // Retorna el formulario de creación
    }

    // Almacenar un nuevo boleto en la base de datos
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id', // Verificar que el usuario exista
            'schedule_id' => 'required|exists:schedules,id', // Verificar que el horario exista
            'booking_code' => 'required|string|unique:tickets',
            'amount' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        // Crear el nuevo boleto
        Ticket::create([
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
            'booking_code' => $request->booking_code,
            'amount' => $request->amount,
            'purchase_date' => $request->purchase_date,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    // Mostrar el formulario para editar un boleto
    public function edit($id)
    {
        $ticket = Ticket::findOrFail($id); // Buscar el boleto por su ID
        $schedules = Schedule::all(); // Obtener todos los horarios
        $users = User::all(); // Obtener todos los usuarios
        return view('tickets.edit', compact('ticket', 'schedules', 'users')); // Retorna la vista de edición
    }

    // Actualizar un boleto en la base de datos
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'user_id' => 'required|exists:users,id', // Verificar que el usuario exista
            'schedule_id' => 'required|exists:schedules,id', // Verificar que el horario exista
            'booking_code' => 'required|string|unique:tickets,booking_code,' . $id,
            'amount' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $ticket = Ticket::findOrFail($id); // Buscar el boleto por su ID
        $ticket->update([
            'user_id' => $request->user_id,
            'schedule_id' => $request->schedule_id,
            'booking_code' => $request->booking_code,
            'amount' => $request->amount,
            'purchase_date' => $request->purchase_date,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    // Eliminar un boleto
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id); // Buscar el boleto por su ID
        $ticket->delete(); // Eliminar el boleto

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }

    public function apiIndex(Request $request){
        $filter = new TicketFilter();
        $queryItems = $filter->transform($request);
        if (count($queryItems) == 0) {
            return new TicketCollection(Ticket::paginate());
        }else{
            $tickets = Ticket::where($queryItems);
            return new TicketCollection($tickets->paginate()->appends($request->query()));
        }
    }
}

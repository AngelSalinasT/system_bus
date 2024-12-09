<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Schedule;
use App\Filters\TicketFilter;
use App\Http\Resources\TicketCollection;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResource;
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
    public function Store(StoreTicketRequest $request){
        return new TicketResource(Ticket::create($request->all()));
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
    public function update(UpdateTicketRequest $request, Ticket $ticket){
        $ticket->update($request->all());
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'passenger_name',
        'passenger_email',
        'seat_number',
        'bus_id',
        'user_id',  // ID del cliente que compra el boleto
    ];

    // Relación con el bus
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // Relación con el usuario que compra el boleto
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Método para generar un ticket number dinámicamente
    public function generateTicketNumber()
    {
        return 'TICKET-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }
}

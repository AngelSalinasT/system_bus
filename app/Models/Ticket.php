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
        'schedule_id',  // Cambiado a schedule_id
        'user_id',      // ID del cliente que compra el boleto
    ];

    // Relación con el horario
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');  // Relación con el horario
    }

    // Relación con el usuario que compra el boleto
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

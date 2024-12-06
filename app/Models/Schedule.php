<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
    'route_id',
    'bus_id',
    'date',
    'departure_time',
    'arrival_time',
    ];

    // Relation: A schedule belongs to a route
    public function route()
    {
    return $this->belongsTo(Route::class, 'route_id');
    }

    // Relation: A schedule belongs to a bus
    public function bus()
    {
    return $this->belongsTo(Bus::class, 'bus_id');
    }

    // Relation: A schedule has many tickets
    public function tickets()
    {
    return $this->hasMany(Ticket::class);
    }
}

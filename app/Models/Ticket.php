<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    protected $fillable = [
        'id_user',
        'id_schedule',
        'booking_code',
        'amount',
        'purchase_date',
        ];

        // Relation: A ticket belongs to a user
        public function user()
        {
        return $this->belongsTo(User::class, 'id_user');
        }

        // Relation: A ticket belongs to a timetable
        public function schedule()
        {
        return $this->belongsTo(Schedule::class, 'id_timetable');
        }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'plates',
        'model',
        'capacity',
        ];

        // Relationship: A bus can be assigned to several schedules
        public function schedules()
        {
        return $this->hasMany(Schedule::class);
        }
}

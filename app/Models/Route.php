<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    // Massively assignable attributes
    protected $fillable = [
        'route_name',
        'origin',
        'destination',
        'distance',
        'estimated_time',
        'branch_id',
    ];

    // Relationship: A route belongs to a branch
    public function branch()
    {
    return $this->belongsTo(Branch::class);
    }

    // Relationship: A route has many schedules
    public function schedules()
    {
    return $this->hasMany(Schedule::class);
    }
}

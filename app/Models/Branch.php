<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory;

    // Attributes that can be assigned in bulk
    protected $fillable = [
    'name',
    'address',
    'phone',
    ];

    // Relationship: A branch has many routes
    public function routes()
    {
    return $this->hasMany(Route::class);
    }
}

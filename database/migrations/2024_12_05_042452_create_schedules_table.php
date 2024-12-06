<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('route_id')->constrained('routes'); // FK to routes
            $table->foreignId('bus_id')->constrained('buses'); // FK to buses
            $table->date('date'); // Date of schedule
            $table->time('departure_time'); // Departure time
            $table->time('arrival_time')->nullable(); // Estimated time of arrival
            $table->timestamps(); // created_at and updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('passenger_name')->nullable(); // Passenger's name (nullable if same as user)
            $table->string('passenger_email')->nullable(); // Passenger's email (nullable if same as user)
            $table->integer('seat_number'); // Seat number
            $table->foreignId('bus_id')->constrained()->onDelete('cascade'); // Foreign key to buses table
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key to users table
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}

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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('id_user')->constrained('users'); // FK to users
            $table->foreignId('id_schedule')->constrained('schedules'); // FK to schedules
            $table->string('booking_code')->unique(); // Unique code
            $table->decimal('amount', 10, 2); // Ticket price
            $table->date('purchase_date'); // Purchase date
            $table->timestamps(); // created_at and updated_at
        });
    }


    /** n
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

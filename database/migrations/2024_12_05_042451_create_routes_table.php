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
        Schema::create('routes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('origin'); // Route origin
            $table->string('destination'); // Route destination
            $table->decimal('distance', 10, 2)->nullable(); // Distance in km
            $table->time('estimated_time')->nullable(); // Estimated time
            $table->foreignId('branch_id')->constrained('branches'); // FK to branches
            $table->timestamps(); // created_at and updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};

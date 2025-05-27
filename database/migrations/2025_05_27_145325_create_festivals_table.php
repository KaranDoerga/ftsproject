<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location_adress');
            $table->string('postal_code');
            $table->string('city');
            $table->string('country');
            $table->text('line_up');
            $table->string('music_genre');
            $table->string('image');
            $table->decimal('ticket_price', 8, 2);
            $table->enum('status', ['concept', 'published', 'sold_out'])->default('concept');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
};

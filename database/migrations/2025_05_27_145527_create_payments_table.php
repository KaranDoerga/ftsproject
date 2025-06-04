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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Gekoppeld aan een boeking
            $table->decimal('amount', 8, 2); // Het betaalde bedrag
            $table->decimal('original_amount', 8, 2)->nullable(); // Het originele bedrag vóór korting
            $table->decimal('discount_amount', 8, 2)->default(0); // Bedrag van de korting (bijv. door punten)
            $table->integer('points_redeemed')->default(0); // Hoeveel punten zijn ingewisseld
            $table->string('payment_method')->nullable(); // bijv. 'iDEAL', 'PayPal', 'Punten', 'Gratis'
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->timestamp('paid_at')->nullable(); // Wanneer de betaling is voltooid
            $table->string('transaction_id')->nullable()->unique(); // Optionele ID van de betaalprovider
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('betalingen');
    }
};

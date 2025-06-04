<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'original_amount',
        'discount_amount',
        'points_redeemed',
        'payment_method',
        'status',
        'paid_at',
        'transaction_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'original_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    public function booking() {
        return $this->belongsTo(Booking::class);
    }
}

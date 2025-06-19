<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'location_adress',
        'postal_code',
        'city',
        'country',
        'line_up',
        'music_genre',
        'image',
        'ticket_price',
        'status',
        'planning_status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function routes() {
        return $this->hasMany(Route::class);
    }
}

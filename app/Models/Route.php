<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'festival_id',
        'departure_location',
        'date_departure',
        'date_return',
        'bus_id',
        'available',
    ];

    protected static function booted(): void {
        static::creating(function(Route $route) {
            $route->available = !empty($route->bus_id);
        });

        static::updating(function(Route $route) {
            $route->available = !empty($route->bus_id);
        });
    }

    public function festival() {
        return $this->belongsTo(Festival::class);
    }

    public function bus() {
        return $this->belongsTo(Bus::class);
    }

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}

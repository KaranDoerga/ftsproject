<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
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

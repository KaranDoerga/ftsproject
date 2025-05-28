<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    public function bookings() {
        return $this->hasMany(Booking::class);
    }

    public function routes() {
        return $this->hasMany(Route::class);
    }
}

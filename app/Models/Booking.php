<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'festival_id',
        'route_id',
        'person_amount',
        'status',
        'points_earned',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function festival(){
        return $this->belongsTo(Festival::class);
    }

    public function route() {
        return $this->belongsTo(Route::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function points(){
        return $this->hasMany(Point::class);
    }


}

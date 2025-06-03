<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{

    use HasFactory;

    protected $fillable = [
        'type',
        'capacity',
        'license_plate',
        'available', // boolean
        'driver',
        ];

    protected $casts = [
        'available' => 'boolean',
    ];
    public function routes() {
        return $this->hasMany(Route::class);
    }
}

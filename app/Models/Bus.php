<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    public function routes() {
        return $this->hasMany(Route::class);
    }
}

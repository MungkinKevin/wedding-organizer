<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'price', 'description', 'facilities'])]


class Paket extends Model
{
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}

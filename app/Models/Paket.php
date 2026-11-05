<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'price', 'description', 'facilities'])]
class Paket extends Model
{
    protected $table = 'paket';

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'paket_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'price', 'description', 'facility1', 'facility2', 'facility3', 'facility4', 'facility5', 'facility6'])]
class Paket extends Model
{
    protected $table = 'paket';
    
    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}

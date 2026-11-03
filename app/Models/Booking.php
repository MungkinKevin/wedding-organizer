<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'paket_id', 'event_date', 'notes', 'final_price', 'status'])]
class Booking extends Model
{
    protected $table = 'booking';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = 'paket';

    protected $primaryKey = 'id_paket';

    protected $fillable = [
        'nama_paket',
        'harga',
        'deskripsi',
        'fasilitas',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'paket_id', 'id_paket');
    }
}
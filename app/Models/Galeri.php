<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'photo'])]
class Galeri extends Model
{
    protected $table = 'galeri';

    protected $fillable = [
        'title',
        'photo',
    ];
}

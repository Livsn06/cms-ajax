<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'name',
        'price',
        'description',
        'image_path',
    ];


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

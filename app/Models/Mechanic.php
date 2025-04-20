<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    protected $fillable = [
        'name',
    ];

    public function carOwner(){
        return $this->hasOneThrough(Owner::class, Car::class);
    }

    public function car(){
        return $this->hasOne(Car::class);
    }
}

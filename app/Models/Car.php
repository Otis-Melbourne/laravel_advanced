<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable  = [
        'mechanic_id',  
        'model',
    ];

    public function owner(){
        return $this->hasOne(Owner::class);
    }

    public function mechanic(){
        return $this->belongsTo(Mechanic::class);
    }
}

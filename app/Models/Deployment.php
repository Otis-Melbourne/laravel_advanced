<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    protected $fillable = [
        'environment_id',
        'commit_hash',
    ];

    public function environment(){
        return $this->belongsTo(Environment::class);
    }
}

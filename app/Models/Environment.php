<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Environment extends Model
{
    protected $fillable = [
        'application_id',
        'name',
    ];

    public function application() : BelongsTo
    {
        return $this->belongsTo(Application::class);
    }

    public function deployments(){
        return $this->hasMany(Deployment::class);
    }
}

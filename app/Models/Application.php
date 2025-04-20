<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Application extends Model
{
    protected $fillable = [
        'name',
    ];

    public function environments() : HasMany
    {
        return $this->hasMany(Environment::class);
    }

    public function deployments() : HasManyThrough
    {
        return $this->hasManyThrough(Deployment::class, Environment::class);
    }
}

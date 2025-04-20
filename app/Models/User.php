<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Mail;
use App\Mail\Registration;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected static function booted(): void
    {
        static::created(function (User $user) {
            Mail::to($user->email)->queue(new Registration($user));
        });
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function expensiveOrder(){
        return $this->hasOne(Order::class)->ofMany('price', 'max');
    }

    public function cheapOrder(){
        return $this->hasOne(Order::class)->ofMany('price', 'min');
    }

    public function oldestOrder() : HasOne
    {
        return $this->hasOne(Order::class)->oldestOfMany();
    }
    
    public function lastestOrder() : HasOne
    {
        return $this->hasOne(Order::class)->latestOfMany();
    }

    public function posts(){
        return $this->hasMany(Post::class);    
    }

    public function lastestPost(){
        return $this->hasOne(Post::class)->latestOfMany();
    }

    public function oldestPost(){
        return $this->hasOne(Post::class)->oldestOfMany();
    }

}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'iso_code',
        'country_code',
        'phone',
        'email',
        'role',
        'status',
        'gender',
        'rating_score',
        'is_online',
        'is_verified',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];    
    protected $guarded = [];
    

    public function setPasswordAttribute(string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function addresses(){
        return $this->hasMany(Address::class);
    }
    public function verifications(){
        return $this->hasMany(Verification::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function earnings(){
        return $this->hasMany(Earning::class);
    }
    public function withdrawals(){
        return $this->hasMany(Withdrawal::class);
    }

    public function sluggable(): array
    {
        return [
            'username' => [
                'source' => 'username'
            ]
        ];
    }
}

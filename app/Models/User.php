<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable,Sluggable, InteractsWithMedia;

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
        'balance',
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

    public function courses(){
        return $this->hasMany(Course::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function address(){
        return $this->hasOne(Address::class);
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

    public function getImage(){
        return ($this->getFirstMediaUrl('users')) ? $this->getFirstMediaUrl('users') : asset('assets/img/user/user11.jpg');
    }
}

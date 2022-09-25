<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function villages(){
        return $this->hasMany(Village::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function addresses(){
        return $this->hasMany(Address::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function districts(){
        return $this->hasMany(District::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function addresses(){
        return $this->hasMany(Address::class);
    }
}

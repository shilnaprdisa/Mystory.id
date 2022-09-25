<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'village_id',
        'district_id',
        'city_id',
        'province_id',
        'zip_code',
        'detail',
        'lat',
        'lng',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function village(){
        return $this->belongsTo(Village::class);
    }
}

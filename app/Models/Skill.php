<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;    
    protected $guarded = [];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function level(){
        return $this->belongsTo(Level::class);
    }
}

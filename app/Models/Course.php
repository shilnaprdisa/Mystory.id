<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;    
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
    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }
    public function level(){
        return $this->belongsTo(Level::class);
    }

    public function getImage(){
        return ($this->getFirstMediaUrl('courses')) ? $this->getFirstMediaUrl('courses') : asset('assets/img/course/course-01.jpg');
    }
}

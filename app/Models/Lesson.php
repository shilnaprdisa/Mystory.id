<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;  
    protected $guarded = [];

    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function getImage(){
        return ($this->getFirstMediaUrl('lessons')) ? $this->getFirstMediaUrl('lessons') : asset('assets/img/course/course-11.jpg');
    }
}

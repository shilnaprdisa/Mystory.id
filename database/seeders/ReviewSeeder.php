<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = User::where('role', 'Student')->get();
        $courses = Course::all();
        foreach($students as $student){
            foreach($courses as $course){
                $cek = Transaction::where('user_id', $student->id)->where('course_id', $course->id)->first();
                if($cek)
                Review::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'rating' => rand(1,5),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Level;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'Tentor')->get();
        $courses = Course::all();
        $levels = Level::all();
        foreach($users as $user){
            foreach($courses as $course){
                foreach($levels as $level){
                    Skill::create([
                        'user_id' => $user->id,
                        'course_id' => $course->id,
                        'level_id' => $level->id,
                        'status' => 'Enabled',
                        'price' => rand(1,9).'0000',
                    ]);
                }
            }
        }
    }
}

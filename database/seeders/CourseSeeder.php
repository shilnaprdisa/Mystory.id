<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'Tentor')->get();
        $lessons = Lesson::all();
        $levels = Level::all();
        foreach($users as $user){
            foreach($lessons as $lesson){
                foreach($levels as $level){
                    Course::create([
                        'user_id' => $user->id,
                        'lesson_id' => $lesson->id,
                        'level_id' => $level->id,
                        'status' => 'Enabled',
                        'price' => rand(1,9).'0000',
                        'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa saepe totam porro rem corporis molestias iusto perspiciatis voluptas repellendus, minus molestiae atque accusantium ipsum. Maiores sed dolorum expedita repudiandae adipisci?'
                    ]);
                }
            }
        }
    }
}

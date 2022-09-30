<?php

namespace Database\Seeders;

use App\Models\Review;
use App\Models\Skill;
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
        $skills = Skill::all();
        foreach($students as $student){
            foreach($skills as $skill){
                $cek = Transaction::where('user_id', $student->id)->where('skill_id', $skill->id)->first();
                if($cek)
                Review::create([
                    'user_id' => $student->id,
                    'skill_id' => $skill->id,
                    'rating' => rand(1,5),
                ]);
            }
        }
    }
}

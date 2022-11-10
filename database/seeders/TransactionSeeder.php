<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = Course::all();
        $users = User::where('role', 'Student')->get();
        $time = rand(1,5);

        foreach($courses as $course){
            $trans_fee = transFee($course->price * $time);
            foreach($users as $user){
                Transaction::create([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                    'lesson' => $course->lesson->name,
                    'level' => $course->level->name,
                    'price' => $course->price,
                    'time' => $time,
                    'trans_fee' => $trans_fee,
                    'total_price' => $course->price * $time + $trans_fee,
                    'status' => 'Paid',
                    'payment_code' => uniqid()
                ]);
            }
        }
    }
}

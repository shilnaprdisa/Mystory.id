<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Skill;
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
        $skills = Skill::all();
        $users = User::where('role', 'Student')->get();
        $time = rand(1,5);
        $setting_fee = Setting::where('name', 'AdminFee')->first();
        $cutting = ($setting_fee->type == 'Persen') ? $setting_fee->value / 100 : $setting_fee->value ;

        foreach($skills as $skill){
            $admin_fee = $skill->price * $time * $cutting;
            foreach($users as $user){
                Transaction::create([
                    'user_id' => $user->id,
                    'skill_id' => $skill->id,
                    'course' => $skill->course->name,
                    'level' => $skill->level->number,
                    'roman' => $skill->level->roman,
                    'price' => $skill->price,
                    'time' => $time,
                    'admin_fee' => $admin_fee,
                    'total_price' => $skill->price * $time + $admin_fee,
                    'status' => 'Paid',
                    'payment_code' => uniqid()
                ]);
            }
        }
    }
}

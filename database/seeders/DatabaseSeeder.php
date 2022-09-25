<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            SettingSeeder::class,
            CourseSeeder::class,
            LevelSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            SkillSeeder::class,
            TransactionSeeder::class,
            NotificationSeeder::class,
            ReviewSeeder::class,
            EarningSeeder::class,
            WithdrawalSeeder::class
        ]);
    }
}

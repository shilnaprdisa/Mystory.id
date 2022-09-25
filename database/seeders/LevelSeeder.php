<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'number' => 1,
            'roman' => 'I'
        ]);
        Level::create([
            'number' => 2,
            'roman' => 'II'
        ]);
    }
}

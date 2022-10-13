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
            'name' => 'Kelas 1 SD',
        ]);
        Level::create([
            'number' => 2,
            'name' => 'Kelas 1 SMP',
        ]);
        Level::create([
            'number' => 3,
            'name' => 'Kelas 1 SMA',
        ]);
        Level::create([
            'number' => 4,
            'name' => 'Semester 1 S1',
        ]);
        Level::create([
            'number' => 5,
            'name' => 'Semester 1 S2',
        ]);
    }
}

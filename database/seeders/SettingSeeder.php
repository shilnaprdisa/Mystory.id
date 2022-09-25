<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'AdminFee',
            'value' => 2,
            'type' => 'Persen'
        ]);
        Setting::create([
            'name' => 'WDFee',
            'value' => 6500,
            'type' => 'Nominal'
        ]);
        Setting::create([
            'name' => 'MinWD',
            'value' => 50000,
            'type' => null
        ]);
    }
}

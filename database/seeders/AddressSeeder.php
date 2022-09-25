<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        foreach($users as $user){
            Address::create([
                'user_id' => $user->id,
                'village_id' => '3326130031',
                'district_id' => '3326130',
                'city_id' => '3326',
                'province_id' => '33',
                'zip_code' => '51173',
                'detail' => 'KEDUNGWUNI TIMUR, KEDUNGWUNI, KABUPATEN PEKALONGAN, JAWA TENGAH, (51173)',
                'lat' => '',
                'lng' => '',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getProvinces(){
        $provinces = Province::pluck('name', 'id');
        return response()->json($provinces);
    }
    public function getCities($province_id){
        $cities = City::where('province_id', $province_id)->pluck('name', 'id');
        return response()->json($cities);
    }
    public function getDistricts($city_id){
        $districts = District::where('city_id', $city_id)->pluck('name', 'id');
        return response()->json($districts);
    }
    public function getVillages($district_id){
        $villages = Village::where('district_id', $district_id)->pluck('name', 'id');
        return response()->json($villages);
    }
}

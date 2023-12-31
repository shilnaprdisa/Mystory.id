<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function fee($name, $total){
        if($name == 'transFee'){
            return transFee($total);
        }
        return wdFee($total);
    }
    public function index(){
        return view('setting.index');
    }
    public function updatePassword(Request $request){
        $this->validate($request, [
            'current_password' => 'required|max:255',
            'password' => 'required|max:255|min:8',
            'confirm_password' => 'required|max:255|min:8',
        ]);
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return redirect()->back()->with('failed', 'Failed, Your current password is wrong.');
        }
        if($request->password != $request->confirm_password){
            return redirect()->back()->with('failed', 'Password does not match.');
        }
        User::whereId(auth()->user()->id)->update(['password' => bcrypt($request->password)]);
        return redirect()->back()->with('success', 'Password Updated Successfuly.');
    }
    public function profile(){
        return view('setting.profile');
    }
    public function updateProfile(Request $request){
        // dd($request->all());
        $request['phone'] = formatPhone($request->phone);
        $phone = 'required|max:255|unique:users';
        $email = 'required|max:255|unique:users|email';
        if(auth()->user()->phone == $request->phone){
            $phone = 'required|max:255';
        }
        if(auth()->user()->email == $request->email){
            $email = 'required|max:255|email';
        }
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => $phone,
            'email' => $email,
            'gender' => 'required|max:11',
            'zip_code' => 'max:255',
            'village_id' => 'required|max:255',
            'district_id' => 'required|max:255',
            'city_id' => 'required|max:255',
            'province_id' => 'required|max:255',
            'detail' => 'required|max:255',
        ]);
        $user = User::find(auth()->user()->id);
        $user->update($request->all());
        $user->address->update($request->all());
        return redirect()->back()->with('success', 'Data Updated Successfuly');
    }
    public function updatePP(Request $request){
        $this->validate($request, ['profile_picture' => 'required|mimes:jpg,png,jpeg,gif']);
        $user = User::Find(auth()->user()->id);
        if($request->hasFile('profile_picture')){
            $user->clearMediaCollection('users');
            $user->addMediaFromRequest('profile_picture')->toMediaCollection('users');
        }
        return redirect()->back()->with('success', 'Foto Profile berhasil diperbarui');
    }
    public function TransFee(Request $request){
        $this->validate($request, [
            'TransFee' => 'required|max:200000000|numeric',
            'TransFeeType' => 'required|max:20'
        ]);
        Setting::whereName('TransFee')->update(['value' => $request->TransFee, 'type' => $request->TransFeeType]);
        return redirect()->back()->with('success', 'Transaction Fee updated successfuly.');
    }
    public function WidFee(Request $request){
        $this->validate($request, [
            'WidFee' => 'required|max:200000000|numeric',
            'WidFeeType' => 'required|max:20'
        ]);
        Setting::whereName('WDFee')->update(['value' => $request->WidFee, 'type' => $request->WidFeeType]);
        return redirect()->back()->with('success', 'WD Fee updated successfuly.');
    }
    public function MinWD(Request $request){
        $this->validate($request, ['MinWD' => 'required|max:200000000|numeric']);
        Setting::whereName('MinWD')->update(['value' => $request->MinWD]);
        return redirect()->back()->with('success', 'WD Fee updated successfuly.');
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserCollection;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index(){
        $role = auth()->user()->role;
        if($role == 'Super'){
            $users = User::paginate(10);
        }elseif($role == 'Admin'){
            $users = User::whereNotIn('role', ['Super', 'Admin'])->paginate(10);
        }
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new UserCollection($users),
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        $this->_validation($request, false);
        $user = User::create($request->all());
        $request->request->add(['user_id' => $user->id]);
        $address = Address::create($request->all());
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'data' => new UserResource($user),
        ], Response::HTTP_CREATED);        
    }

    public function update(Request $request, $id){
        $this->_validation($request, true);
        $user = User::findOrFail($id);
        $user->update($request->all());
        $address = Address::where('user_id', $id)->update([
            'village_id' => $request->village_id,
            'district_id' => $request->district_id,
            'city_id' => $request->city_id,
            'province_id' => $request->province_id,
            'zip_code' => $request->zip_code,
            'detail' => $request->detail,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new UserResource($user),
        ], Response::HTTP_OK);        
    }

    public function destroy(Request $request, $id){
        $user = User::find($id);
        $user->update(['status' => $request->type]);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new UserResource($user),
        ], Response::HTTP_OK);
    }

    private function _validation(Request $request,$isUpdate){
        $email = 'required|email|max:255|unique:users';
        $username = 'required|max:255|unique:users';
        $phone = 'required|max:255|unique:users';
        $password = 'required|max:255|min:8';
        if($isUpdate){
            $email = 'required|email|max:255';
            $username = 'required|max:255';
            $phone = 'required|max:255';
            $password = '';
        }
        return $this->validate($request,[
            'name' => 'required|max:255',
            'username' => $username,
            'email' => $email,
            'phone' => $phone,
            'iso_code' => 'required|max:11',
            'country_code' => 'required|max:11',
            'role' => 'required|max:11',
            'gender' => 'required|max:11',
            'password' => $password,
            'village_id' => 'required|max:255',
            'district_id' => 'required|max:255',
            'city_id' => 'required|max:255',
            'province_id' => 'required|max:255',
            'zip_code' => 'max:255',
            'detail' => 'required|max:255',
            'lat' => 'max:255',
            'lng' => 'max:255',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->_validation($request);
        if($request->role == 'Admin' or $request->role == 'Super'){
            return response()->json([
                'message' => 'something wrong!',
                'status_code' => 400,
            ], Response::HTTP_BAD_REQUEST);
        }
        $request['phone'] = $this->_formatPhone($request->phone);
        $request['status'] = 'Pending';
        $user = User::create($request->all());
        $request->request->add(['user_id' => $user->id]);
        $address = Address::create($request->all());
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'token' => $token,
            'data' => new UserResource($user),
        ], Response::HTTP_CREATED);
    }

    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password')) && !Auth::attempt(['phone' => $request->email, 'password' => $request->password]) && !Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }
        $user = User::whereEmail($request->email)->first() ?? User::wherePhone($request->email)->first() ?? User::whereUsername($request->email)->firstOrFail();
        if($user->status == 'Banned' or $user->status == 'Deleted'){
            return response()->json(['message' => 'Your account is banned or deleted! Please contact our customers service.'], Response::HTTP_UNAUTHORIZED);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Login success!',
            'status_code' => 200,
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]
        ], Response::HTTP_OK);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout Success!',
        ], Response::HTTP_OK);
    }

    private function _formatPhone($phone){
        // kadang ada penulisan no hp 0811 239 345
        $phone = str_replace(" ","",$phone);
        // kadang ada penulisan no hp (0274) 778787
        $phone = str_replace("(","",$phone);
        // kadang ada penulisan no hp (0274) 778787
        $phone = str_replace(")","",$phone);
        // kadang ada penulisan no hp 0811.239.345
        $phone = str_replace(".","",$phone);

        $hp = $phone;
    
        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($phone))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($phone), 0, 3)=='+62'){
                // $hp = trim($phone);
                $hp = substr(trim($phone), 3);
            }
            // cek apakah no hp karakter 1-2 adalah 62
            elseif(substr(trim($phone), 0, 2)=='62'){
                // $hp = '+62'.substr(trim($phone), 1);
                $hp = substr(trim($phone), 2);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($phone), 0, 1)=='0'){
                // $hp = '+62'.substr(trim($phone), 1);
                $hp = substr(trim($phone), 1);
            }
        }
        return $hp;
    }

    private function _validation(Request $request){
        return $this->validate($request,[
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|max:255|unique:users|email',
            'phone' => 'required|max:255|unique:users',
            'iso_code' => 'required|max:11',
            'country_code' => 'required|max:11',
            'role' => 'required|max:11',
            'gender' => 'required|max:11',
            'password' => 'required|max:255',
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

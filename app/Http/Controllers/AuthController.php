<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function create($type){
        return view('auth.register', compact('type'));
    }
    
    public function login(Request $request){
        if (!Auth::attempt($request->only('email', 'password')) && !Auth::attempt(['phone' => formatPhone($request->email), 'password' => $request->password]) && !Auth::attempt(['username' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->with('failed', 'Email atau password salah.');
        }
        $user = User::whereEmail($request->email)->first() ?? User::wherePhone(formatPhone($request->email))->first() ?? User::whereUsername($request->email)->firstOrFail();
        if($user->status == 'Banned' or $user->status == 'Deleted'){
            return redirect('/suspend');
        }elseif($user->role == 'Student'){
            return redirect('/dashboard');
        }elseif($user->role == 'Tentor'){
            return redirect('/tentor');
        }
        return redirect('/admin');
    }

    public function register(Request $request){
        $request['phone'] = formatPhone($request->phone);
        $this->_validation($request);
        if($request->role == 'Admin' or $request->role == 'Super'){
            return response()->json([
                'message' => 'something wrong!',
                'status_code' => 400,
            ], Response::HTTP_BAD_REQUEST);
        }
        $request['status'] = 'Pending';
        $user = User::create($request->all());
        $request->request->add(['user_id' => $user->id]);
        $address = Address::create($request->all());
        Auth::login($user);
        return redirect('/verification/Register');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/login');
    }

    public function suspend(){
        if(auth()->user()){
            Auth::logout();
        }
        return view('auth.suspend');
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
            'password' => 'required|max:255|min:8',
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

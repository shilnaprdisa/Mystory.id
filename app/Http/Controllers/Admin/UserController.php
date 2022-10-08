<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $role = auth()->user()->role;
        if($role == 'Super'){
            $users = User::paginate(10);
        }elseif($role == 'Admin'){
            $users = User::whereNotIn('role', ['Super', 'Admin'])->paginate(10);
        }
        return view('admin.user.index', compact('users'));
    }
}

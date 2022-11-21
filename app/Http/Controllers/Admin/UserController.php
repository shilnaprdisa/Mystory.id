<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
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
    public function show($id){
        $user = User::find($id);
        return view('admin.user.show', compact('user'));
    }
    public function status(Request $request){
        $this->validate($request, ['id' => 'required|max:200000000|numeric', 'status' => 'required|max:20']);
        $user = User::whereId($request->id)->update(['status' => $request->status]);
        if(($request->status == 'Banned' or $request->status == 'Deleted') && $user->role == 'Tentor'){
            Course::whereUserId($request->id)->update(['status' => 'Disabled']);
        }
        return redirect()->back()->with('success', 'Status updated successfully');
    }
}

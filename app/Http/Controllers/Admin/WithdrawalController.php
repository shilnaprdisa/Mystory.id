<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index(){
        $wd = Withdrawal::paginate(10);
        return view('admin.wd.index', compact('wd'));
    }
    public function done(Request $request){
        $this->validate($request, [
            'id' => 'required|max:200000000|numeric',
            'received' => 'required|max:200000000|numeric',
        ]);
        $wd = Withdrawal::find($request->id);
        if($request->received != $wd->received){
            return redirect()->back()->with('failed', 'Total received does not match.');
        }
        $wd->update(['status' => 'Done']);
        return redirect()->back()->with('success', 'Data updated successfully.');
    }
}

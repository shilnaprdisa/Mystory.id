<?php

namespace App\Http\Controllers\Tentor;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index(){
        $wd = Withdrawal::whereUserId(auth()->user()->id)->paginate(10);
        $settings = Setting::all();
        return view('tentor.wd.index', compact('wd', 'settings'));
    }
    public function store(Request $request){
        $this->validate($request, [
            'account_number' => 'required|max:255',
            'account_name' => 'required|max:255',
            'bank_name' => 'required|max:255',
            'amount' => 'required|max:200000000|numeric',
        ]);
        $user = User::find(auth()->user()->id);
        if($user->balance < $request->amount){
            return redirect()->back()->with('failed', 'Saldo tidak cukup');
        }
        $wd_fee = wdFee($request->amount);
        $request->request->add(['user_id' => $user->id,'wd_fee' => $wd_fee, 'received' => $request->amount - $wd_fee, 'status' => 'Pending']);
        Withdrawal::create($request->all());
        $user->update(['balance' => $user->balance - $request->amount]);
        return redirect()->back()->with('success', 'Request berhasil dikirim.');
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\WithdrawalCollection;
use App\Http\Resources\Api\V1\WithdrawalResource;
use App\Models\Setting;
use App\Models\User;
use App\Models\Verification;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WithdrawalController extends Controller
{

    public function index(){
        $wd = Withdrawal::all();
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new WithdrawalCollection($wd),
        ], Response::HTTP_OK);  
    }

    public function create(Request $request){
        $user = $request->user();
        $verification = Verification::whereUserId($user->id)->whereDate('created_at', now())->whereStatus('Valid')->whereType('WD')->first();
        if(!$verification){
            return response()->json([
                'message' => 'Withdrawal Unauthenticated!',
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        }
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'balance' => $user->balance,
        ], Response::HTTP_OK);
    }

    public function store(Request $request){
        $min_wd = Setting::where('name', 'MinWD')->value('value');
        $this->validate($request,[
            'amount' => 'required|numeric|max:required|numeric|max:200000000|min:'.$min_wd
        ]);
        $user = $request->user();
        $verification = Verification::whereUserId($user->id)->whereDate('created_at', now())->whereStatus('Valid')->whereType('WD')->first();
        if(!$verification){
            return response()->json([
                'message' => 'Withdrawal Unauthenticated!',
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        }
        $setting_fee = Setting::where('name', 'WDFee')->first();
        $wd_fee = ($setting_fee->type == 'Persen') ? $request->amount * $setting_fee->value / 100 : $setting_fee->value ;
        if($user->balance < $request->amount){
            return response()->json([
                'message' => 'Your balance is not enough.',
                'status_code' => 403,
            ], Response::HTTP_FORBIDDEN);
        }
        $wd = Withdrawal::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'wd_fee' => $wd_fee,
            'received' => $request->amount - $wd_fee,
            'status' => "Pending"
        ]);
        User::whereId($user->id)->update(['balance' => $user->balance - $request->amount]);
        $verification->update(['status' => 'Expired']);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new WithdrawalResource($wd),
        ], Response::HTTP_CREATED);  
    }

    public function update(Request $request){
        $this->validate($request,[
            'id' => 'required|numeric|max:200000000'
        ]);
        $wd = Withdrawal::find($request->id);
        $wd->update(['status' => 'Success']);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new WithdrawalResource($wd),
        ], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OtpEmail;
use App\Models\User;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function verification($type){//view register, WD or reset password
        if($type == 'Register' && !auth()->user()){
            return redirect('/login');
        }
        return view('verification.index', compact('type'));
    }

    public function getOtpRegister(Request $request){
        $this->validate($request,[
            'type' => 'required|max:255',
            'send_via' => 'required|max:255'
        ]);
        $user_id = $request->user()->id;
        return $this->_generateOtp($request,$user_id);
    }    

    public function viapost(Request $request){
        $request['otp'] = ($request->otp == null or strlen($request->otp) > 6) ? 0 : $request->otp;
        $this->validate($request, [
            'user_id' => 'required|numeric|max:200000000',
            'otp' => 'required|max:6',
            'type' => 'required|max:20',
        ]);
        return $this->_otpValidation(Verification::whereUserId($request->user_id)->whereType($request->type)->whereOtp(md5($request->otp))->whereStatus('Created')->whereDate('created_at', now())->first(), $request->type, $request->user_id);
    }

    public function viaget($encrypt){
        $decrypt = base64_decode($encrypt);
        $data = (isset($decrypt)) ? explode(config('app.otp_key'), $decrypt, 3) : [0 => null, 1 => null, 2 => null];
        return $this->_otpValidation(Verification::whereUserId($data[1])->whereType($data[2])->whereOtp($data[0])->whereStatus('Created')->whereDate('created_at', now())->first(), $data[2], $data[1]);
    }

    private function _generateOtp(Request $request,$user_id){
        $count = Verification::whereUserId($user_id)->whereDate('created_at',now())->count();
        if($count >= 5){
            return view('verification.limit');
        }
        $verification = Verification::whereUserId($user_id)->whereType($request->type)->whereStatus('Created')->update(['status' => 'Expired']);
        $otp = rand(100000, 999999);
        $request->request->add(['user_id' => $user_id, 'otp' => md5($otp), 'status' => 'Created', 'expired_at' => Carbon::tomorrow(), 'type' => $request->type]);
        $verification = Verification::create($request->only(['user_id', 'otp', 'status', 'expired_at', 'type', 'send_via']));
        $link = config('app.autoverify_url').base64_encode(md5($otp).config('app.otp_key').$user_id.config('app.otp_key').$request->type);
        if($request->send_via == 'WA'){
            //wa
        }elseif($request->send_via == 'SMS'){
            //sms
        }else{
            Mail::raw("Kode verifikasi anda adalah $otp, atau kunjungi link berikut $link", function($message) use($verification){
                $message->to($verification->user->email,$verification->user->name);
                $message->subject("Verifikasi akun Belajarin.Id");
            });
            // $text = ['subject' => 'Verifikasi akun Belajarin.Id'];
            // Mail::to($verification->user->email)->send(new OtpEmail($text));
        }
        $type = $request->type;
        return view('verification.verify', compact('user_id','type'));
        // return response()->json([
        //     'message' => 'Success',
        //     'status_code' => 201,
        //     'otp' => $otp,
        //     'link' => $link,
        // ]);
    }

    private function _otpValidation($verification, $type, $user_id){
        if(!$verification){
            Verification::whereUserId($user_id)->whereType($type)->whereStatus('Created')->update(['status' => 'Expired']);
            return view('verification.wrong', compact('type'));
        }
        $verification->update(['status' => 'Valid']);
        if($verification->type == 'ResetPassword'){
            return view('verification.set_password');
        }elseif($verification->type == 'WD'){//ini belum dipake
            return view('verification.wd');
        }
        $user = User::find($verification->user_id);
        $user->update(['is_verified' => true]);
        $role = $user->role;
        return view('verification.account_active',compact('role'));
    }
}

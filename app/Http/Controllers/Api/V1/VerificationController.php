<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\VerificationResource;
use App\Models\User;
use App\Models\Verification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class VerificationController extends Controller
{
    public function verification($type){//view register, WD or reset password
        return response()->json([
            'message' => $type.' Verification Type',
            'status_code' => 200,
        ], Response::HTTP_OK);
    }

    public function getOtpResetPassword(Request $request){
        $this->validate($request,[
            'type' => 'required|max:255',
            'email' => 'required|max:255',
            'send_via' => 'required|max:255'
        ]);
        $user = User::whereEmail($request->email)->first() ?? User::wherePhone($request->email)->first() ?? User::whereUsername($request->email)->first();
        if(!$user){
            return response()->json([
                'message' => 'Failed!, Your account is not registered!',
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->_generateOtp($request,$user->id);
    }

    public function getOtpRegister(Request $request){
        $this->validate($request,[
            'type' => 'required|max:255',
            'send_via' => 'required|max:255'
        ]);
        $user_id = $request->user()->id;
        return $this->_generateOtp($request,$user_id);
    }

    public function getOtpWD(Request $request){
        $this->validate($request,[
            'send_via' => 'required|max:255'
        ]);
        $request->request->add(['type' => 'WD']);
        $user_id = $request->user()->id;
        return $this->_generateOtp($request,$user_id);
    }

    public function viapost(Request $request){
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
        if($count > 5){
            return response()->json([
                'message' => 'Failed!, Exceed limit and try again tomorrow!',
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $verification = Verification::whereUserId($user_id)->whereType($request->type)->whereStatus('Created')->update(['status' => 'Expired']);
        $otp = rand(100000, 999999);
        $request->request->add(['user_id' => $user_id, 'otp' => md5($otp), 'status' => 'Created', 'expired_at' => Carbon::tomorrow(), 'type' => $request->type]);
        $verification = Verification::create($request->only(['user_id', 'otp', 'status', 'expired_at', 'type', 'send_via']));
        // $link = config('app.autoverify_url').hash_hmac('sha256', md5($otp).config('app.otp_key').$user_id,config('app.otp_key'));
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
        }
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'user_id' => $user_id,
            'type' => $request->type,
            'otp' => $otp,
            'link' => $link,
        ], Response::HTTP_CREATED);
    }

    private function _otpValidation($verification, $type, $user_id){
        if(!$verification){
            Verification::whereUserId($user_id)->whereType($type)->whereStatus('Created')->update(['status' => 'Expired']);
            return response()->json([
                'message' => 'Your OTP is Wrong or Expired.',
                'type' => $type,
                'status_code' => 500,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $verification->update(['status' => 'Valid']);
        if($verification->type == 'ResetPassword'){
            return response()->json([
                'message' => 'OTP validation successfully, please change your password!',
                'status_code' => 200,
                'verification_id' => $verification->id
            ], Response::HTTP_OK);
        }elseif($verification->type == 'WD'){
            return response()->json([
                'message' => 'OTP validation successfully, you can make a withdrawal!',
                'status_code' => 200,
                'verification_id' => $verification->id
            ], Response::HTTP_OK);
        }
        $user = User::find($verification->user_id);
        $user->update(['status' => 'Active']);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
        ], Response::HTTP_OK);
    }
}

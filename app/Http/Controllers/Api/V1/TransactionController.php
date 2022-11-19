<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\TransactionCollection;
use App\Http\Resources\Api\V1\TransactionResource;
use App\Models\Course;
use App\Models\Earning;
use App\Models\Notification;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use \Midtrans\Config;
use Midtrans\CoreApi;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::paginate(10);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new TransactionCollection($transactions),
        ], Response::HTTP_OK);

    }

    public function store(Request $request){
        $transactions = Transaction::create($this->_trasactionRequest($request, 'Order'));
        $this->_createNotification($transactions);
        return response()->json([
            'message' => 'Success',
            'status_code' => 201,
            'data' => new TransactionResource($transactions),
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $transaction = Transaction::find($id);
        $transaction->update($this->_trasactionRequest($request, $request->status));
        $this->_createNotification($transaction);
        return response()->json([
            'message' => 'Success',
            'status_code' => 200,
            'data' => new TransactionResource($transaction),
        ], Response::HTTP_OK);
    }

    public function destroy(Request $request, $id){
        $transaction = Transaction::find($id);
        $transaction->update(['status' => $request->status]);
        $this->_createNotification($transaction);
        return response()->json([
            'message' => 'Success, Switch to '.$request->status,
            'status_code' => 200,
        ], Response::HTTP_OK);
    }

    public function payment(Request $request){
        $this->validate($request, ['transaction_id' => 'required|numeric|max:200000000']);
        $transaction = Transaction::find($request->transaction_id);
        if($transaction->status != 'Done' && $transaction->status != 'PaymentFailed'){
            return response()->json([
                'message' => 'Transaction is '.$transaction->status.'. Payment not accepted',
                'status_code' => 422,
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $uid = uniqid();
        if($request->payment_method == 'bank_transfer'){
            $data = $this->_bankTransfer($request,$uid, $transaction->total_price);
        }
        $transaction->update(['payment_code' => $uid]);
        // Set your Merchant Server Key
        Config::$serverKey = config('app.midtrans_server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isProduction = false;
        // Set sanitization on (default)
        Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        Config::$is3ds = true;

        $response = CoreApi::charge($data);
        if($response->status_code == '201'){
            $response = $this->_setResponse($request,$response);
        }else{
            $message = 'Something went wrong!';
            $response_code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response = [
                'status_code' => '500',
            ];
        }
        $message = 'Success create payment!';
        $response_code = Response::HTTP_CREATED;
        return response()->json([
            'message' => $message,
            'data' => $response,
        ], $response_code);
    }

    //payment handle callback notification by midtrans
    public function paymentHandle(Request $request){
        $serverkey = config('app.midtrans_server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverkey);
        if($hashed == $request->signature_key){
            // Log::info($request);
            $transaction = Transaction::where('payment_code', $request->order_id)->first();
            if($request->transaction_status == 'settlement' or $request->transaction_status == 'capture'){
                $transaction->update(['status'=>'Paid']);
            }elseif($request->transaction_status == 'pending'){
                $transaction->update(['status'=>'Paid']);
            }elseif($request->transaction_status == 'deny' or $request->transaction_status == 'cancel' or $request->transaction_status == 'expire'){
                $transaction->update(['status'=>'PaymentFailed']);
            }
            sendNotif($transaction);

            if($transaction->status == 'Paid'){
                $amount = $transaction->price * $transaction->time;
                Earning::create([
                    'user_id' => $transaction->course->user->id,
                    'transaction_id' => $transaction->id,
                    'amount' => $amount,
                ]);
                $transaction->course->user->update(['balance' => $transaction->course->user->balance + $amount]);
            }

        }else{
            Log::info("hash=$request->signature_key, order_id=$request->order_id, transaction_id=$request->transaction_id");
        }
    }

    private function _trasactionRequest(Request $request, $status){
        $this->_validation($request);
        $user = User::find($request->user_id);
        $course = Course::find($request->course_id);
        $sub_total = $request->time * $course->price;
        $trans_fee = transFee($sub_total);
        $request->request->add([
            'user_id' => $user->id,'course_id' => $request->course_id, 'lesson' => $course->lesson->name,
            'level' => $course->level->name, 'price' => $course->price,
            'time' => $request->time, 'trans_fee' => $trans_fee, 'total_price' => $sub_total + $trans_fee,
            'status' => $status
        ]);
        return $request->all();
    }

    private function _validation(Request $request){
        return $this->validate($request, [
            'user_id' => 'required|numeric|max:200000000',
            'course_id' => 'required|numeric|max:200000000',
            'time' => 'required|numeric|max:200000000',
        ]);
    }

    private function _bankTransfer(Request $request,$order_id, $total_price){
        if($request->payment_type == 'echannel'){
            $data = [
                'payment_type' => $request->payment_type,
                'transaction_details' => ['order_id' => $order_id, 'gross_amount' => $total_price],
                'echannel' => [
                    'bill_info1' => 'Payment:'.$order_id,
                    'bill_info2' => 'Belajarin online purchase'
                ]
            ];
        }elseif($request->payment_type == 'permata'){
            $data = [
                'payment_type' => $request->payment_type,
                'transaction_details' => ['order_id' => $order_id, 'gross_amount' => $total_price],
            ];
        }else{
            $data = [
                'payment_type' => $request->payment_type,
                'transaction_details' => ['order_id' => $order_id, 'gross_amount' => $total_price],
                'bank_transfer' => [
                    'bank' => $request->bank
                ]
            ];
        }
        return $data;
    }

    private function _setResponse(Request $request,$response){
        if($request->payment_method == 'bank_transfer'){
            if($request->payment_type == 'echannel'){
                $resp = [
                    'status_code' => '201',
                    'payment_id' => $response->order_id,
                    'gross_amount' => $response->gross_amount,
                    'currency' => $response->currency,
                    'payment_method' => $request->payment_method,
                    'payment_type' => $response->payment_type,
                    'bank' => 'mandiri bill',
                    'bill_key' => $response->bill_key,
                    'biller_code' => $response->biller_code,
                ];
            }elseif(isset($response->permata_va_number)){
                $resp = [
                    'status_code' => '201',
                    'payment_id' => $response->order_id,
                    'gross_amount' => $response->gross_amount,
                    'currency' => $response->currency,
                    'payment_method' => $request->payment_method,
                    'payment_type' => $response->payment_type,
                    'bank' => 'permata',
                    'va_number' => $response->permata_va_number,
                ];
            }else{
                $resp = [
                    'status_code' => '201',
                    'payment_id' => $response->order_id,
                    'gross_amount' => $response->gross_amount,
                    'currency' => $response->currency,
                    'payment_method' => $request->payment_method,
                    'payment_type' => $response->payment_type,
                    'bank' => $response->va_numbers[0]->bank,
                    'va_number' => $response->va_numbers[0]->va_number,
                ];
            }
        }

        return $resp;
    }
}

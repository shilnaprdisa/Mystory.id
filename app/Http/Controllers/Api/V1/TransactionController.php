<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\TransactionCollection;
use App\Http\Resources\Api\V1\TransactionResource;
use App\Models\Course;
use App\Models\Earning;
use App\Models\Notification;
use App\Models\Setting;
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
            $this->_createNotification($transaction);

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
        $setting_fee = Setting::where('name', 'AdminFee')->first();
        $sub_total = $request->time * $course->price;
        $admin_fee = ($setting_fee->type == 'Persen') ? $sub_total * $setting_fee->value / 100 : $setting_fee->value ;
        $request->request->add([
            'user_id' => $user->id,'course_id' => $request->course_id, 'course' => $course->course->name,
            'level' => $course->level->name, 'price' => $course->price,
            'time' => $request->time, 'admin_fee' => $admin_fee, 'total_price' => $sub_total + $admin_fee,
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

    private function _createNotification($transactions){
        
        $name = $transactions->user->name;
        $uri = '/transactions/'.$transactions->id;
        $uritentor = '/tentor/transactions/'.$transactions->id;
        
        if($transactions->status == 'Order'){
            $user_id = $transactions->course->user->id;
            $title = "Pesanan Baru";
            $description = "Ada pesanan baru dari $name,segera terima untuk membuat kesepakatan!";
            $status = 'Sended';
            $type = 'Order';
            $uri = $uritentor;
        }elseif($transactions->status == 'Agree'){
            $user_id = $transactions->user_id;
            $title = "Berhasil Menemukan Tentor";
            $description = "Kami berhasil menemukan tentor untuk anda, Segera panggil!";
            $status = 'Sended';
            $type = 'Agree';
        }elseif($transactions->status == 'Come'){
            $user_id = $transactions->course->user->id;
            $title = "Pelanggan Memanggil";
            $description = "Pelanggan dengan atas nama $name mengharapkan anda untuk datang ke lokasi, bersegeralah!";
            $status = 'Sended';
            $type = 'Come';
            $uri = $uritentor;
        }elseif($transactions->status == 'Process'){
            $user_id = $transactions->user_id;
            $title = "Selamat Belajar";
            $description = "Tentor sudah sampai di lokasi, belajarlah dengan giat!";
            $status = 'Sended';
            $type = 'Process';
        }elseif($transactions->status == 'Done'){
            $user_id = $transactions->user_id;
            $title = "Proses Belajar Selesai";
            $description = "Proses belajar telah selesai, silahkan lakukan pembayaran!";
            $status = 'Sended';
            $type = 'Done';
        }elseif($transactions->status == 'Paid'){
            $payment = $transactions->payment_code;
            $user_id = $transactions->user_id;
            $title = "Pembayaran Berhasil";
            $description = "Pembayaran dengan nomor id $payment telah berhasil. Terimaksih telah menggunakan jasa layanan kami";
            $status = 'Sended';
            $type = 'Paid';
            $notification = Notification::create([
                'user_id' => $transactions->course->user->id, 'title' => $title, 'description' => "$name berhasil melakukan pembayaran, mintalah untuk memberikan review terbaik!",
                'status' => $status, 'type' => 'Paid', 'uri' => $uritentor
            ]);
        }elseif($transactions->status == 'PaymentFailed'){
            $payment = $transactions->payment_code;
            $user_id = $transactions->user_id;
            $title = "Pembayaran Gagal";
            $description = "Pembayaran dengan nomor id $payment gagal. silahkan melakukan pembayaran ulang";
            $status = 'Sended';
            $type = 'NotFound';
        }elseif($transactions->status == 'NotFound'){
            $user_id = $transactions->user_id;
            $title = "Gagal Menemukan Tentor";
            $description = "Kami tidak berhasil menemukan tentor disekitar anda.";
            $status = 'Sended';
            $type = 'NotFound';
        }elseif($transactions->status == 'Cancel'){
            $id = $transactions->id;
            $user_id = $transactions->user_id;
            $title = "Pesanan dibatalkan";
            $description = "Pesanan dengan ID $id dibatalkan.";
            $status = 'Sended';
            $type = 'Cancel';
            $notification = Notification::create([
                'user_id' => $transactions->course->user->id, 'title' => $title, 'description' => "Pesanan dengan ID $id dibatalkan.",
                'status' => $status, 'type' => $type, 'uri' => $uritentor
            ]);
        }else{ //review
            $user_id = $transactions->user_id;
            $name = $transactions->user->name;
            $title = "Review Dari $name";
            $description = "INI BELUM KELAR";
            $status = 'Sended';
            $type = 'Cancel';
        }

        $notification = Notification::create([
            'user_id' => $user_id, 'title' => $title, 'description' => $description,
            'status' => $status, 'type' => $type, 'uri' => $uri
        ]);

        return $notification;
    }
}

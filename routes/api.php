<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CourseController;
use App\Http\Controllers\Api\V1\LevelController;
use App\Http\Controllers\Api\V1\SkillController;
use App\Http\Controllers\Api\V1\TransactionController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\VerificationController;
use App\Http\Controllers\Api\V1\WithdrawalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('payment-handle', [TransactionController::class, 'paymentHandle']);//payment handle midtrans notification callback

    Route::get('verification/{type}', [VerificationController::class, 'verification']);
    Route::post('get-otp-reset-password', [VerificationController::class, 'getOtpResetPassword']);
    Route::get('verify', [VerificationController::class, 'verify']);
    Route::post('verify', [VerificationController::class, 'viapost']);
    Route::get('verify/{encrypt}', [VerificationController::class, 'viaget']);
    
    Route::group(['middleware' => 'auth:sanctum'], function(){
        Route::post('get-otp-register', [VerificationController::class, 'getOtpRegister']);

        Route::get('logout', [AuthController::class, 'logout']);

        Route::group(['middleware' => ['auth', 'CheckRoles:Tentor']], function () {
            Route::post('get-otp-wd', [VerificationController::class, 'getOtpWD']);
            Route::get('withdrawals/create', [WithdrawalController::class, 'create']);
            Route::post('withdrawals', [WithdrawalController::class, 'store']);
	    });

        Route::group(['middleware' => ['auth', 'CheckRoles:Super,Admin']], function () {
            Route::get('withdrawals', [WithdrawalController::class, 'index']);
            Route::post('withdrawals/update', [WithdrawalController::class, 'update']);

            Route::resource('users', UserController::class);
            Route::resource('courses', CourseController::class);
            Route::resource('levels', LevelController::class);
            Route::resource('skills', SkillController::class);

            Route::post('payment', [TransactionController::class, 'payment']);
            Route::resource('transactions', TransactionController::class);
	    });
    });
});

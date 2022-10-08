<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    // return json_encode(array_rand(['ab', 'bc', 'cd']));
});

Route::get('/getProvinces', [AddressController::class, 'getProvinces']);
Route::get('/getCities/{province_id}', [AddressController::class, 'getCities']);
Route::get('/getDistricts/{district_id}', [AddressController::class, 'getDistricts']);
Route::get('/getVillages/{village_id}', [AddressController::class, 'getVillages']);

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register/{type}', [AuthController::class, 'create']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/verification/{type}', [VerificationController::class, 'verification']);
// Route::get('verify', [VerificationController::class, 'verify']);
Route::post('/verify', [VerificationController::class, 'viapost']);
Route::get('/verify/{encrypt}', [VerificationController::class, 'viaget']);

Route::get('/suspend', [AuthController::class, 'suspend']);

Route::group(['middleware' => ['auth', 'OtpVerification:Student,Tentor,Admin,Super']], function () {
    Route::post('/get-otp-register', [VerificationController::class, 'getOtpRegister']);
});
Route::group(['middleware' => ['auth', 'CheckRoles:Student,Tentor,Admin,Super']], function () {//all users
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth', 'CheckRoles:Student']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

Route::prefix('tentor')->group(function(){
    Route::group(['middleware' => ['auth', 'CheckRoles:Tentor']], function () {
        Route::get('', [DashboardController::class, 'tentor']);
        // Route::post('get-otp-wd', [VerificationController::class, 'getOtpWD']);
        // Route::get('withdrawals/create', [WithdrawalController::class, 'create']);
        // Route::post('withdrawals', [WithdrawalController::class, 'store']);
    });
});

Route::prefix('admin')->group(function(){
    Route::group(['middleware' => ['auth', 'CheckRoles:Super,Admin']], function () {
        Route::get('', [DashboardController::class, 'admin']);
        // Route::get('withdrawals', [WithdrawalController::class, 'index']);
        // Route::post('withdrawals/update', [WithdrawalController::class, 'update']);
    
        Route::resource('users', UserController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('levels', LevelController::class);
        // Route::resource('skills', SkillController::class);
    
        // Route::post('payment', [TransactionController::class, 'payment']);
        // Route::resource('transactions', TransactionController::class);
    });
});

<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\EarningController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\Admin\WithdrawalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Student\TransactionController as StudentTransactionController;
use App\Http\Controllers\Tentor\CourseController;
use App\Http\Controllers\Tentor\EarningController as TentorEarningController;
use App\Http\Controllers\Tentor\TransactionController as TentorTransactionController;
use App\Http\Controllers\Tentor\WithdrawalController as TentorWithdrawalController;
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

Route::get('/', [SiteController::class, 'index']);
Route::get('/courses', [SiteController::class, 'courses']);
Route::get('/courses/{id}', [SiteController::class, 'detail']);
Route::get('/user/{username}', [SiteController::class, 'user']);

Route::get('/getProvinces', [AddressController::class, 'getProvinces']);
Route::get('/getCities/{province_id}', [AddressController::class, 'getCities']);
Route::get('/getDistricts/{district_id}', [AddressController::class, 'getDistricts']);
Route::get('/getVillages/{village_id}', [AddressController::class, 'getVillages']);
    
Route::get('fee/{name}/{total}', [SettingController::class, 'fee']);

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register/{type}', [AuthController::class, 'create']);
Route::get('/register', function(){
    return view('register_option');
});
Route::post('/register', [AuthController::class, 'register']);

Route::get('/verification/{type}', [VerificationController::class, 'verification']);
// Route::get('verify', [VerificationController::class, 'verify']);
Route::post('/verify', [VerificationController::class, 'viapost']);
Route::get('/verify/{encrypt}', [VerificationController::class, 'viaget']);

Route::get('/suspend', [AuthController::class, 'suspend']);
Route::get('/pending', [AuthController::class, 'pending']);

Route::group(['middleware' => ['auth', 'OtpVerification:Student,Tentor,Admin,Super']], function () {
    Route::post('/get-otp-register', [VerificationController::class, 'getOtpRegister']);
});
Route::group(['middleware' => ['auth', 'CheckRoles:Student,Tentor,Admin,Super']], function () {//all users
    Route::get('/invoice/{id}', [SiteController::class, 'invoice']);
    
    Route::get('/profile', [SettingController::class, 'profile']);
    Route::post('/updateProfile', [SettingController::class, 'updateProfile']);
    Route::post('/updatePP', [SettingController::class, 'updatePP']);
    Route::get('/setting', [SettingController::class, 'index']);
    Route::post('/updatePassword', [SettingController::class, 'updatePassword']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth', 'CheckRoles:Student']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/transactions', StudentTransactionController::class);
    Route::put('/reviews', [ReviewController::class, 'update']);
});

Route::prefix('tentor')->group(function(){
    Route::group(['middleware' => ['auth', 'CheckRoles:Tentor']], function () {
        Route::get('', [DashboardController::class, 'tentor']);
        Route::resource('courses', CourseController::class);
        Route::resource('reviews', ReviewController::class);
        Route::resource('transactions', TentorTransactionController::class);
        Route::resource('earnings', TentorEarningController::class);
        Route::resource('withdrawals', TentorWithdrawalController::class);
        Route::get('fee/{name}/{total}', [SettingController::class, 'fee']);
        // Route::post('get-otp-wd', [VerificationController::class, 'getOtpWD']);
        // Route::get('withdrawals/create', [WithdrawalController::class, 'create']);
        // Route::post('withdrawals', [WithdrawalController::class, 'store']);
    });
});

Route::prefix('admin')->group(function(){
    Route::group(['middleware' => ['auth', 'CheckRoles:Super,Admin']], function () {

        Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

        Route::get('', [DashboardController::class, 'admin']);
        // Route::get('withdrawals', [WithdrawalController::class, 'index']);
        // Route::post('withdrawals/update', [WithdrawalController::class, 'update']);
    
        Route::resource('users', UserController::class);
        Route::post('users/status', [UserController::class, 'status']);

        Route::resource('lessons', LessonController::class);
        Route::resource('levels', LevelController::class);
        Route::resource('transactions', TransactionController::class);
        Route::resource('withdrawals', WithdrawalController::class);
        Route::post('withdrawals/done', [WithdrawalController::class, 'done']);

        Route::get('earnings', [EarningController::class, 'index']);
        Route::post('TransFee', [SettingController::class, 'TransFee']);
        Route::post('WidFee', [SettingController::class, 'WidFee']);
        Route::post('MinWD', [SettingController::class, 'MinWD']);
    
        // Route::post('payment', [TransactionController::class, 'payment']);
        // Route::resource('transactions', TransactionController::class);
    });
});

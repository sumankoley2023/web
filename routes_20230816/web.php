<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sign_in;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Master_controller;
use App\Http\Controllers\Member;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth-login');
});
Route::get('index', function () {
    return view('auth-login');
});
Route::get('index', [Sign_in::class, 'index']);
Route::post('valid_check', [Sign_in::class, 'valid_check']);
Route::get('logout', [Sign_in::class, 'logout']);

Route::get('dashboard', [Dashboard::class, 'index']);



Route::get('package_master', [Master_controller::class, 'package_master']);
Route::post('insert_package_master', [Master_controller::class, 'insert_package_master']);
Route::get('status_package_master/{id}/{status}', [Master_controller::class, 'status_package_master']);
Route::get('del_package_master/{id}', [Master_controller::class, 'del_package_master']);


Route::get('valid_pan', [Member::class, 'valid_pan']);
Route::post('create_profile', [Member::class, 'create_profile']);
Route::get('add_member', [Member::class, 'index']);
Route::post('insert_member', [Member::class, 'insert_member']);
Route::post('insert_profile_1', [Member::class, 'insert_profile_1']);
Route::get('send_otp', [Member::class, 'send_otp']);
Route::get('enter_otp', [Member::class, 'enter_otp']);
Route::post('verify_otp', [Member::class, 'verify_otp']);
Route::get('busness_cal', [Member::class, 'busness_cal']);
Route::get('resend_mobile', [Member::class, 'resend_mobile']);
Route::get('resend_email', [Member::class, 'resend_email']);
Route::get('member_profile', [Member::class, 'member_profile']);
Route::get('bank_kyc', [Member::class, 'bank_kyc']);
Route::post('verify_otp_bank', [Member::class, 'verify_otp_bank']);
Route::get('payment', [Member::class, 'payment']);
Route::post('payment_generate', [Member::class, 'payment_generate']);
Route::get('refer_member', [Member::class, 'refer_member']);
Route::get('join/{id}', [Member::class, 'join']);
Route::post('join_profile', [Member::class, 'join_profile']);
Route::get('get_bank_details', [Member::class, 'get_bank_details']);

Route::get('my_profile', [Member::class, 'my_profile']);
Route::get('change_password', [Member::class, 'change_password']);
Route::post('update_change_password', [Member::class, 'update_change_password']);

Route::post('change_profile', [Member::class, 'change_profile']);
Route::post('verify_email_otp_profile', [Member::class, 'verify_email_otp_profile']);
Route::get('update_package', [Member::class, 'update_package']);
Route::post('insert_update_package', [Member::class, 'insert_update_package']);
Route::get('busness_cal', [Member::class, 'busness_cal']);
Route::get('binary_cor_jobs', [Member::class, 'binary_cor_jobs']);
Route::get('tree', [Member::class, 'tree']);
Route::get('total_team', [Member::class, 'total_team']);
Route::get('direct_team', [Member::class, 'direct_team']);
Route::get('direct_income', [Member::class, 'direct_income']);
Route::get('withdrawal', [Member::class, 'withdrawal']);
Route::post('req_withdrawal', [Member::class, 'req_withdrawal']);
Route::get('executive_income', [Member::class, 'executive_income']);
Route::get('binary_income', [Member::class, 'binary_income']);
Route::get('steady_income', [Member::class, 'steady_income']);
Route::get('my_wallet', [Member::class, 'my_wallet']);



<?php

use App\Http\Controllers\StripePaymentController;
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
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/test', 'ArticlesController@handle');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware(['guest'])->name('password.request');

Route::post('/forgot-password', 'ResetPasswordController@resetPw')->middleware(['guest'])->name('password.email');

Route::get('stripe', [StripePaymentController::class, 'index']);
Route::post('payment-process', [StripePaymentController::class, 'process']);


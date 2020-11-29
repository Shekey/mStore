<?php

use App\Http\Controllers\StripePaymentController;
use App\Http\Livewire\ArtikliLiveWire;
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
    $market = \App\Models\Market::all();
    return view('welcome', ['data' => $market]);
})->name('home');

Route::get('/test', 'App\Http\Controllers\ArticlesController@handle');

Route::post('image/upload/store','App\Http\Controllers\ImageUploadController@fileStore');
Route::post('image/delete','App\Http\Controllers\ImageUploadController@fileDestroy');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('stripe', [App\Http\Controllers\StripePaymentController::class, 'index']);
    Route::post('payment-process', [App\Http\Controllers\StripePaymentController::class, 'process']);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/kategorije', function () {
        return view('admin.categories.index');
    })->name('kategorije');

    Route::get('/reklame', function () {
        return view('admin.reklame.index');
    })->name('reklame');

    Route::get('/prodavnice', function () {
        return view('admin.prodavnice.index');
    })->name('prodavnice');

    Route::get('/prodavnice/{id}/artikli',  function ($id) {
        return view('admin.prodavnice.artikli', compact('id'));
    });
});


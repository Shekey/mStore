<?php

use App\Events\NotifyOrderCreated;
use App\Http\Controllers\StripePaymentController;
use App\Http\Livewire\ArtikliLiveWire;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

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
Route::get('artisan-optimize', function () {
    Artisan::call('optimize');
});

Route::get('/sitemap.xml', '\App\Http\Controllers\SitemapController@sitemap');

Route::get('/kontakt', function () {
    return view('contact');
})->name('contact');

Route::post('/kontakt', '\App\Http\Controllers\ContactForm@mailContactForm');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/', function () {
    if(\Illuminate\Support\Facades\Auth::user() && !\Illuminate\Support\Facades\Auth::user()->isActive) {
        Session::put('error', 'Uskoro očekujte poziv na telefonski broj od administratora, kako bi smo potvrdili i aktivirali ovaj račun.');
        \Illuminate\Support\Facades\Auth::logout();
    }
    $markets = \App\Models\Market::with('type')->get()->groupBy('marketType');
    return view('welcome', ['data' => $markets]);
})->name('home');

Route::post('image/upload/store','App\Http\Controllers\ImageUploadController@fileStore');
Route::post('image/delete','App\Http\Controllers\ImageUploadController@fileDestroy');

Route::get('/prodavnica/{id}',  function ($id) {
    return view('prodavnica.index', compact('id'));
})->name('catalog');
Route::get('/korpa', \App\Http\Livewire\CartDetails::class)->name('cart');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/kategorije', function () {
        return view('admin.categories.index');
    })->name('kategorije');

    Route::get('/tipMarketa', function () {
        return view('admin.marketType.index');
    })->name('tipMarketa');

    Route::get('/reklame', function () {
        return view('admin.reklame.index');
    })->name('reklame');

    Route::get('/prodavnice', function () {
        return view('admin.prodavnice.index');
    })->name('prodavnice');

    Route::get('/prodavnice/{id}/artikli',  function ($id) {
        return view('admin.prodavnice.artikli', compact('id'));
    });

    Route::resource('korisnici', \App\Http\Controllers\UsersController::class);
    Route::post('/korisnici/updateStatus', '\App\Http\Controllers\UsersController@manageUser')->name('korisnici.updateStatus');
    Route::get('/narudzbe/{id}', \App\Http\Livewire\OrderLiveWire::class)->name('order-item');
    Route::get('/narudzbe', \App\Http\Livewire\OrderListLiveWire::class)->name('orders');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/mark-as-read', '\App\Http\Controllers\UsersController@markNotification')->name('markNotification');
});


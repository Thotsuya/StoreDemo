<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::redirect('/','/register');

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth:sanctum'],function(){

    Route::resource('clients',\App\Http\Controllers\ClientController::class)->except('show','create');
    Route::resource('products',\App\Http\Controllers\ProductController::class);
    Route::resource('factories',\App\Http\Controllers\FactoryController::class)->except('show','create');
    Route::resource('orders',\App\Http\Controllers\OrderController::class);

    Route::post('address',[\App\Http\Controllers\AddressController::class,'store'])->name('address.store');
    Route::delete('address/{address}',[\App\Http\Controllers\AddressController::class,'destroy'])->name('address.destroy');


});

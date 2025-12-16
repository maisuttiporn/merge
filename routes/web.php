<?php

use App\Http\Controllers\CheckinController;
use App\Http\Controllers\UserController;
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

Route::get('/main/{user_id?}', function ($user_id = 0) {

    

    $users = \App\Models\User::orderBy('fname')->get();
    if ($user_id == 0) {
        $user_id = $users->first()->id;
    }

    return view('main.index', compact('user_id', 'users'));

})->name('main');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function() {
    return redirect()->route('main');
});


Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::put('/user/{user_id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');


Route::get('/checkin', [CheckinController::class, 'index'])->name('checkin.index');
Route::get('/checkin/check/{homenumber?}/{date?}', [CheckinController::class, 'check'])->name('checkin.check');
Route::post('/checkin/checksave/{homenumber}/{date}', [CheckInController::class,'checksave'])->name('checkin.checksave');

Route::get('/checkin/payment/{checkin_id}', [CheckInController::class,'payment'])->name('checkin.payment');
Route::post('/checkin/payment/{checkin_id}', [CheckInController::class,'paymentupdate'])->name('checkin.paymentupdate');

use App\Http\Controllers\PaymentController;
Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
Route::get('/payment/desc/{user_id}',[PaymentController::class, 'desc'])->name('payment.desc');
Route::post('/payment/update/{user_id}/{payerid}', [PaymentController::class,'update'])->name('payment.update');


use App\Http\Controllers\InvController;
Route::get('/inv/index/{inv_id?}', [InvController::class,'index'])->name('inv.index');
Route::get('/inv/create', [InvController::class,'create'])->name('inv.create');
Route::post('/inv', [InvController::class,'store'])->name('inv.store');
Route::get('/inv/{inv_id}/edit', [InvController::class,'edit'])->name('inv.edit');
Route::put('/inv/{inv_id}', [InvController::class,'update'])->name('inv.update');



use App\Http\Controllers\InvdescController;
Route::post('/invdesc', [InvdescController::class,'store'])->name('invdesc.store');
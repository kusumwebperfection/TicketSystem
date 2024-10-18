<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\userTicketController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
 
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
    return view('ticket.create');
});
Route::get('/search', function () {
    return view('ticket.search');
});

Auth::routes();
Route::resource('ticket', UserTicketController::class);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/home', function(){ return redirect('/');})->name('home');
Route::post('ticket/search', [UserTicketController::class, 'search'])->name('ticket.search');
Route::middleware(['auth', 'role:admin,sub_admin'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::resource('ticket', UserTicketController::class)->only(['index']);
});
Route::get('/payment', function () {
    return view('payment'); // Point to your payment view
})->name('payment.form');

Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
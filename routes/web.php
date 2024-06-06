<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\LandingController;
use App\Http\Controllers\Dashboard\MemberController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RequestController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\MyOrderController;

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

Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/explorer', [LandingController::class, 'explore'])->name('landing.explorer');
Route::get('/booking/{id}', [LandingController::class, 'booking'])->name('landing.booking');
Route::get('/booking/{id}/detail', [LandingController::class, 'detail_booking'])->name('landing.detail_booking');
Route::get('/detail/{id}', [LandingController::class, 'detail'])->name('landing.detail');

Route::prefix('member')->as('member.')->middleware(['auth:sanctum', 'verified'])->group(function () {
    // dashboard
    Route::resource('dashboard', MemberController::class);

    // service
    Route::resource('service', ServiceController::class);

    // request
    Route::get('request/{id}/approve', [RequestController::class, 'approve'])->name('request.approve');
    Route::resource('request', RequestController::class);
    // order
    Route::resource('order', MyOrderController::class);
    // Route::get('order/{id}/submit', [MyOrderController::class, 'submit'])->name('submit.order');
    // Route::post('order/{id}/submit', [MyOrderController::class, 'submit_post'])->name('submit.order.post');

    // profile
    Route::get('photo/delete', [ProfileController::class, 'delete'])->name('delete.photo.profile');
    Route::resource('profile', ProfileController::class);
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

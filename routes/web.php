<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/events/{event}/reserve', [EventController::class, 'reserve'])->name('events.reserve');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:ADMIN'])->group(function () {
    // Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('events', EventController::class);
    Route::resource('reservations', ReservationController::class);
});

Route::middleware(['auth', 'role:CLIENT'])->group(function () {
    Route::get('list-events', [EventController::class, 'listEvents'])->name('events.list');
    Route::get('details-events/{id}', [EventController::class, 'show'])->name('events.details');
    Route::delete('my-reservations/{id}', [ReservationController::class, 'delete'])->name('reservations.delete');
    Route::get('my-reservations', [ReservationController::class, 'myReservations'])->name('reservations.my');
});

require __DIR__.'/auth.php';

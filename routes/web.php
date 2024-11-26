<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController as AdminEvent;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\CheckUserType;

Route::get('/', [LandingController::class, 'index'])->name('landing'); // Halaman landing publik

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// Admin Routes
Route::middleware(['auth', CheckUserType::class . ':admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');  // admin.dashboard
    Route::resource('events', AdminEvent::class); // CRUD untuk Events
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/{registration}', [PaymentController::class, 'update'])->name('payments.update'); // Update pembayaran
    // Route::post('/payments/{eventId}', [PaymentController::class, 'store'])->name('payments.store');
});

// User Routes
Route::middleware(['auth', CheckUserType::class . ':user'])->group(function () {
Route::get('/dashboard', [LandingController::class, 'index'])->name('user.landing');
// Route::resource('registrasi', RegistrationController::class)->only([
//     'create', 'store'
// ]);
Route::get('/registrasi/{event}', [RegistrationController::class, 'create'])->name('registrations.create');
Route::post('/registrasi/{event}', [RegistrationController::class, 'store'])->name('registrations.store');
Route::get('/bayar/{event}', [RegistrationController::class, 'pay'])->name('payments.show');
Route::post('/bayar/{event}', [PaymentController::class, 'store'])->name('payments.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

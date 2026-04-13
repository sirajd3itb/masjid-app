<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

// ─── Landing Page ────────────────────────────────────────────────
Route::get('/', function () {
    $events = Event::where('tanggal', '>=', now()->toDateString())
        ->orderBy('tanggal')
        ->take(6)
        ->get();
    return view('welcome', compact('events'));
})->name('home');

// ─── Admin Area (requires auth) ──────────────────────────────────
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Events
    Route::get('events',               [EventController::class, 'index'])->name('events.index');
    Route::get('events/create',        [EventController::class, 'create'])->name('events.create');
    Route::post('events',              [EventController::class, 'store'])->name('events.store');
    Route::get('events/{event}/edit',  [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event}',       [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{event}',    [EventController::class, 'destroy'])->name('events.destroy');

    // Donations
    Route::get('donations',            [DonationController::class, 'index'])->name('donations.index');
    Route::get('donations/create',     [DonationController::class, 'create'])->name('donations.create');
    Route::post('donations',           [DonationController::class, 'store'])->name('donations.store');
    Route::delete('donations/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');

    // Keuangan
    Route::get('keuangan',             [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('keuangan/create',      [KeuanganController::class, 'create'])->name('keuangan.create');
    Route::post('keuangan',            [KeuanganController::class, 'store'])->name('keuangan.store');
    Route::delete('keuangan/{keuangan}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');

    // Profile
    Route::get('profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
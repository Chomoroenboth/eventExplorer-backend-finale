<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRequestController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Events
Route::resource('events', EventController::class);

// Event Requests
Route::get('/event-requests', [EventRequestController::class, 'index'])->name('event-requests.index');
Route::get('/event-requests/{eventRequest}', [EventRequestController::class, 'show'])->name('event-requests.show');
Route::patch('/event-requests/{eventRequest}/approve', [EventRequestController::class, 'approve'])->name('event-requests.approve');
Route::patch('/event-requests/{eventRequest}/reject', [EventRequestController::class, 'reject'])->name('event-requests.reject');
<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // F18 Appointments
    Route::resource('appointments', AppointmentController::class)->except(['show']);
});

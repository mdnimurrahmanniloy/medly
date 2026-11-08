<?php

use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // F7 Visit Records
    Route::resource('visits', VisitController::class)->except(['show']);
});

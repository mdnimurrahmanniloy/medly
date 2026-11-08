<?php

use App\Http\Controllers\DoctorVerificationController;
use Illuminate\Support\Facades\Route;

// F14 Doctor Registration and Admin Verification
Route::middleware('guest')->group(function () {
    Route::get('doctor/register', [DoctorVerificationController::class, 'create'])->name('doctor.register');
    Route::post('doctor/register', [DoctorVerificationController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('doctor/status', [DoctorVerificationController::class, 'status'])->name('doctor.status');

    Route::get('admin/doctors', [DoctorVerificationController::class, 'index'])->name('admin.doctors.index');
    Route::patch('admin/doctors/{profile}/approve', [DoctorVerificationController::class, 'approve'])->name('admin.doctors.approve');
    Route::patch('admin/doctors/{profile}/reject', [DoctorVerificationController::class, 'reject'])->name('admin.doctors.reject');
});

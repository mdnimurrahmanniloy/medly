<?php

use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\HealthProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // F1 Family Member Profiles
    Route::resource('family', FamilyMemberController::class);

    // F2 Health Profile
    Route::get('family/{family}/health', [HealthProfileController::class, 'edit'])->name('health.edit');
    Route::put('family/{family}/health', [HealthProfileController::class, 'update'])->name('health.update');

    Route::post('family/{family}/allergies', [HealthProfileController::class, 'storeAllergy'])->name('allergies.store');
    Route::delete('allergies/{allergy}', [HealthProfileController::class, 'destroyAllergy'])->name('allergies.destroy');

    Route::post('family/{family}/conditions', [HealthProfileController::class, 'storeCondition'])->name('conditions.store');
    Route::delete('conditions/{condition}', [HealthProfileController::class, 'destroyCondition'])->name('conditions.destroy');
});

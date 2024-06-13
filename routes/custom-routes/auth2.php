<?php
use App\Http\Controllers\AuthController;
    // filtered data page of admin page
    Route::get('/filtered-data',[AuthController::class,'filterDataAdmin']);
    Route::get('/filtered-data',[AuthController::class,'filterDataAdmin']);
    Route::get('/search-filtered-data/{dateRange}', [AuthController::class, 'searchFilteredData']);
    Route::post('/filter-manager-date', [AuthController::class, 'searchDateManagerHomePage']);
    Route::get('/unauthorized',[AuthController::class,'unauthorized']);

    Route::get('/change-password',[AuthController::class,'changePassword'])->name('user.chang-password');
    Route::post('/change-password',[AuthController::class,'changePasswordData']);
    // admin front page
    Route::post('/get-date', [AuthController::class, 'getData']);

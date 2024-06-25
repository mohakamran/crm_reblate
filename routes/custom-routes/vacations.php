<?php
use App\Http\Controllers\VacationController;
// vacations
Route::get('/office-vacations', [VacationController::class,'index'])->name('vacations.index');
Route::match(['get', 'post'], '/create-holidays', [VacationController::class, 'createHolidays']);
Route::match(['get', 'post'], '/update-holidays', [VacationController::class, 'createHolidays']);

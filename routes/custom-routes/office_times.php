<?php
use App\Http\Controllers\TimeController;
Route::get('/office-time', [TimeController::class, 'indexPage'])->middleware('AdminCheck');
Route::post('/office-times', [TimeController::class, 'setShift'])->middleware('AdminCheck');
Route::any('/update-office-times', [TimeController::class, 'updateTime'])->middleware('AdminCheck');

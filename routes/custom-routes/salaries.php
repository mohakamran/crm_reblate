<?php
use App\Http\Controllers\SalaryController;

// salaries
Route::get('/generate-new-salary-slip', [SalaryController::class,'generateNewSalarySlip'])->middleware('SalaryCheck');
Route::get('/generate-new/{u_id}', [SalaryController::class,'generateNewSlip'])->middleware('SalaryCheck');
Route::match(['get', 'post'], '/preview-salary/{u_id}', [SalaryController::class,'generateNewSlipTable'])->middleware('SalaryCheck');

Route::post('/send-reciept/{u_id}', [SalaryController::class,'sendReciept'])->middleware('SalaryCheck');
Route::get('/view-slips', [SalaryController::class,'viewReciepts'])->middleware('SalaryCheck');
Route::get('/view-all', [SalaryController::class,'viewAll'])->middleware('SalaryCheck');
Route::get('/view-salaries/{id}', [SalaryController::class,'viewSalaries'])->middleware('SalaryCheck');
Route::get('/update-salary/{id}', [SalaryController::class,'updateSalary'])->middleware('SalaryCheck');
Route::get('/preview-slip-employee-page/{id}', [SalaryController::class,'viewSlipBrowser']);

// employee
Route::get('view-my-slips',[SalaryController::class,'viewSlips']);

// salaries by month
Route::get('/salary-by-month', [SalaryController::class,'showMonthWiseSalaries'])->middleware('AdminUser');
Route::post('/search-salary-by-month', [SalaryController::class,'showMonthWiseSalariesByMonth'])->middleware('AdminUser');

// Salary Dashboard routes
Route::get('/view-slips-dashboard', [SalaryController::class,'viewDashboard']);

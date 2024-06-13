<?php
use App\Http\Controllers\LoginController;

// logins
Route::get('/create-new-login',[LoginController::class,'createLoginView'])->middleware('AdminCheck');
Route::get('/create-new-employee-login',[LoginController::class,'createNewEmployeeLogin'])->middleware('AdminCheck');
Route::post('/create-login-new-employee-access',[LoginController::class,'registerNewEmployeeLogin'])->middleware('AdminCheck');
Route::get('/create-login-emp/{id}',[LoginController::class,'createLoginEmp'])->middleware('AdminCheck');
Route::get('/update-login-emp/{id}',[LoginController::class,'updateLoginEmp'])->middleware('AdminCheck');
Route::post('/register-login-access/{id}',[LoginController::class,'registerLoginEmp'])->middleware('AdminCheck');
Route::post('/update-login-access/{id}',[LoginController::class,'updateLoginAccess'])->middleware('AdminCheck');
Route::get('/view-login',[LoginController::class,'viewLoginEmp'])->middleware('AdminCheck');
Route::get('/delete-employee-login/{id}',[LoginController::class,'delviewLoginEmp'])->middleware('AdminCheck');
Route::get('/reset-password/{id}',[LoginController::class,'resetPassword'])->middleware('AdminCheck');

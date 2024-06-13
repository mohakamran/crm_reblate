<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/send-password/{token}',[AuthController::class,'generateIndexView']);
Route::get('/employee-login',[AuthController::class,'viewLoginEmployee'])->name('user.emp');
Route::post('/employee-login',[AuthController::class,'loginEmployee']);
Route::get('/client-login',[AuthController::class,'viewLoginClient']);
Route::get('/admin-login',[AuthController::class,'viewLoginAdmin']);
Route::get('/manager-login',[AuthController::class,'viewLoginManager'])->name('user.manager');
Route::post('/manager-login',[AuthController::class,'LoginManager']);
Route::post('/admin-login',[AuthController::class,'loginAdmin'])->name('user.admin');
Route::post('/client-login',[AuthController::class,'loginClient'])->name('user.client');
Route::get('/forget-password',[AuthController::class,'forgetPassword']);
Route::post('/forget-password',[AuthController::class,'forgetPasswordView']);
Route::get('/login',[AuthController::class,'index'])->name('login');

Route::get('/password-reset', [AuthController::class, 'showResetForm'])
    ->name('password.reset.link')
    ->middleware('signed');

Route::get('/create-temp-link', [AuthController::class,'createLink']);

Route::get('/temp-pass/{token}', [AuthController::class, 'seeLink'])->name('temp.link')->middleware('signed');

Route::post('/password-update', [AuthController::class, 'updatePassword'])->name('password.update');

Route::get('/clear', function() {
    try {
        // Clear the application cache
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:cache');
        Artisan::call('optimize:clear');
       echo "cache cleared! <a href='/'>Go back</a> ";
    } catch (\Exception $e) {
        return 'Error clearing cache: ' . $e->getMessage();
    }
});

Route::middleware(['auth'])->group(function () {
    // Route::view('/', 'index.index')->name('home');
    Route::get('/',[AuthController::class,'indexHomePage']);
    Route::get('/logout',[AuthController::class,'logout']);
});

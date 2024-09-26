<?php
    use App\Http\Controllers\FinanceController;
    use Illuminate\Support\Facades\Route;

    Route::get('finace-dashboard',[FinanceController::class,'Dashboard'])->name('finance.dashboard');

<?php

use App\Http\Controllers\ExpenseController;

// Expenses Routes
Route::get('/add-new-expense', [ExpenseController::class,'addExpenseRoute'])->name('add-new-expense')->middleware('ExpenseRole');
Route::post('/add-new-expense', [ExpenseController::class,'addExpenseData'])->middleware('ExpenseRole');
Route::get('/view-expenses', [ExpenseController::class,'viewExpenses'])->name('view-expenses')->middleware('ExpenseRole');
Route::get('delete-expense/{expense_id}', [ExpenseController::class,'deleteExpenses'])->middleware('ExpenseRole');
Route::get('/update-expense/{expense_id}', [ExpenseController::class,'updateExpenseRoute'])->middleware('ExpenseRole');
Route::post('/update-expense-data/{expense_id}', [ExpenseController::class,'updateExpenseData'])->middleware('ExpenseRole');

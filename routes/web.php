<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// AuthController


Route::middleware(['guest'])->group(function () {
    Route::get('/login',[AuthController::class,'index'])->name('auth.login');
    // Route::post('/user-login',[AuthController::class,'loginIndex'])->name('auth.user');
    Route::get('/employee-login',[AuthController::class,'viewLoginEmployee'])->name('user.emp');
    Route::post('/employee-login',[AuthController::class,'loginEmployee']);
    Route::get('/client-login',[AuthController::class,'viewLoginClient']);
    Route::get('/admin-login',[AuthController::class,'viewLoginAdmin']);
    Route::post('/admin-login',[AuthController::class,'loginAdmin'])->name('user.admin');
    Route::post('/client-login',[AuthController::class,'loginClient'])->name('user.client');
});


Route::middleware(['auth'])->group(function () {

    // home page

    // Route::view('/', 'index.index')->name('home');
    Route::get('/',[AuthController::class,'indexHomePage']);
    // Route::view('/demo','pages.demo');

    // Employee Routes

    Route::get('/add-new', [EmployeesController::class, 'index'])->name('add-new-employee');
    Route::get('/manage-employees', [EmployeesController::class, 'manage'])->name('manage-employees');
    Route::post('/add-new-employee-data', [EmployeesController::class, 'getData'])->name('add-new-employee-data');
    Route::get('/change-status/{status}', [EmployeesController::class, 'changeStatus']);
    Route::get('/change-shift/{status}', [EmployeesController::class, 'changeShift']);
    Route::get('/delete-employee/{emp_id}', [EmployeesController::class, 'delEmployee'])->name('del-emp');
    Route::get('/update-employee/{emp_id}', [EmployeesController::class, 'updateEmployee']);
    Route::post('/update-employee-data/{emp_id}', [EmployeesController::class, 'updateEmployeeData']);
    Route::get('/view_emp_details/{emp_id}', [EmployeesController::class, 'viewEmployeeData']);

    // users

    Route::get('/logout',[AuthController::class,'logout']);
    Route::get('/change-password/{user_id}',[AuthController::class,'changePassword'])->name('user.chang-password');
    Route::post('/change-password/{user_id}',[AuthController::class,'changePasswordData']);

    //expenses
    Route::get('/add-new-expense', [ExpenseController::class,'addExpenseRoute'])->name('add-new-expense');
    Route::post('/add-new-expense', [ExpenseController::class,'addExpenseData']);
    Route::get('/view-expenses', [ExpenseController::class,'viewExpenses'])->name('view-expenses');
    Route::get('delete-expense/{expense_id}', [ExpenseController::class,'deleteExpenses']);
    Route::get('/update-expense/{expense_id}', [ExpenseController::class,'updateExpenseRoute']);
    Route::post('/update-expense-data/{expense_id}', [ExpenseController::class,'updateExpenseData']);
    // clients
    Route::get('/add-new-client', [ClientController::class,'addClientRoute'])->name('add-new-client');
    Route::post('/add-new-client', [ClientController::class,'addClientData']);
    Route::get('/delete-client/{client_id}', [ClientController::class,'deleteClientData']);
    Route::get('/view-clients', [ClientController::class,'viewClients'])->name('view-clients');
    Route::get('/view-client-detail/{client_id}', [ClientController::class,'viewClientDetail'])->name('view-client-detail');
    Route::get('/update_client/{client_id}', [ClientController::class,'updateClientRoute'])->name('update_client');
    Route::post('/update-client/{client_id}', [ClientController::class,'updateClientData'])->name('update_client_data');
    // salaries
    Route::get('/generate-new-salary-slip', [SalaryController::class,'generateNewSalarySlip']);
    Route::get('/generate-new/{u_id}', [SalaryController::class,'generateNewSlip']);
    Route::post('/preview-salary/{u_id}', [SalaryController::class,'generateNewSlipTable']);
    Route::post('/send-reciept/{u_id}', [SalaryController::class,'sendReciept']);
    Route::get('/view-slips', [SalaryController::class,'viewReciepts']);
    Route::get('/view-salaries/{id}', [SalaryController::class,'viewSalaries']);
    // Route::get('/testpdf', [SalaryController::class,'testPdf']);

    // invoices
    Route::get('/create-new-invoice',[InvoiceController::class,'createNewInvoice']);
    Route::get('/create-invoice/{id}',[InvoiceController::class,'createNewInvoiceTable']);
    Route::post('/confirm-invoice/{id}',[InvoiceController::class,'previewInvoice']);
    Route::post('/send-invoice/{id}',[InvoiceController::class,'sendInvoice']);
    Route::get('/view-invoices',[InvoiceController::class,'viewInvoices']);
    Route::get('/preview-invoices/{id}',[InvoiceController::class,'viewIndividualInvoices']);

    // logins
    Route::get('/create-new-login',[LoginController::class,'createLoginView']);
    Route::get('/create-new-employee-login',[LoginController::class,'createNewEmployeeLogin']);
    Route::post('/register-new-emp-login-access',[LoginController::class,'registerNewEmployeeLogin']);
    Route::get('/create-login-emp/{id}',[LoginController::class,'createLoginEmp']);
    Route::get('/update-login-emp/{id}',[LoginController::class,'updateLoginEmp']);
    Route::post('/register-login-access/{id}',[LoginController::class,'registerLoginEmp']);
    Route::post('/update-login-access/{id}',[LoginController::class,'updateLoginAccess']);
    Route::get('/view-login',[LoginController::class,'viewLoginEmp']);
    Route::get('/delete-employee-login/{id}',[LoginController::class,'delviewLoginEmp']);
    Route::get('/reset-password/{id}',[LoginController::class,'resetPassword']);

    // client logins
    Route::get('/create-client-logins',[ClientController::class,'createClientLoginView']);
});

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

// Route::group(['middleware' => 'admin'], function () {
//     // users maangement for super admin
//     Route::get('/view-users/{user_id}', [AuthController::class,'viewUsersData']);
//     Route::get('/delete-user/{user_id}', [AuthController::class,'deleteUser']);
//     Route::get('/user-register',[AuthController::class,'registerUser'])->name('auth.register');
//     Route::post('/user-register',[AuthController::class,'registerUserData']);
//     Route::get('/user-details/{user_id}',[AuthController::class,'changeUserDetails'])->name('user.change-details');
//     Route::post('/user-details/{user_id}',[AuthController::class,'changeUserDetailsData']);
//     Route::get('/send-reset/{user_id}',[AuthController::class,'sendUserResetPassword']);

// });

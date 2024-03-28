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
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\AttendenceController;
use App\Http\Controllers\TimeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AnnouncementController;
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

// Route::get('/generate',[AuthController::class,'generateIndex']);
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



Route::middleware(['auth'])->group(function () {
// Route::view('/', 'index.index')->name('home');
Route::get('/',[AuthController::class,'indexHomePage']);



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

Route::group(['middleware' => 'admin'], function () {
//     // users maangement for super admin
//     Route::get('/view-users/{user_id}', [AuthController::class,'viewUsersData']);
//     Route::get('/delete-user/{user_id}', [AuthController::class,'deleteUser']);
//     Route::get('/user-register',[AuthController::class,'registerUser'])->name('auth.register');
//     Route::post('/user-register',[AuthController::class,'registerUserData']);
//     Route::get('/user-details/{user_id}',[AuthController::class,'changeUserDetails'])->name('user.change-details');
//     Route::post('/user-details/{user_id}',[AuthController::class,'changeUserDetailsData']);
//     Route::get('/send-reset/{user_id}',[AuthController::class,'sendUserResetPassword']);

    // home page


    // Route::view('/demo','pages.demo');

    // filtered data page of admin page
    Route::get('/filtered-data',[AuthController::class,'filterDataAdmin']);
    Route::get('/search-filtered-data/{dateRange}', [AuthController::class, 'searchFilteredData']);
    Route::get('/unauthorized',[AuthController::class,'unauthorized']);

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
    Route::get('/view_info', [EmployeesController::class, 'viewInfo']);
    Route::get('/view_profile/{id}', [EmployeesController::class, 'viewProfile']);

    // users

    Route::get('/logout',[AuthController::class,'logout']);
    Route::get('/change-password',[AuthController::class,'changePassword'])->name('user.chang-password');
    Route::post('/change-password',[AuthController::class,'changePasswordData']);

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
    Route::get('/send-credentials-clients/{id}',[ClientController::class,'sendDetailsClients']);
    Route::post('/create-credentials/{id}',[ClientController::class,'sendDetails']);
    Route::get('/view-clients-logins',[ClientController::class,'viewClientLogins']);
    Route::get('/delete-client-login/{id}',[ClientController::class,'deleteClientLogin']);
    Route::get('/reset-password-client/{id}',[ClientController::class,'resetPasswordClient']);

    // employee
    Route::get('view-my-slips',[SalaryController::class,'viewSlips']);

    //google 2fa
    // Route::get('/google-2fa',[SecurityController::class,'google2FA']);

    // Route::get('/mark-attendence',[AttendenceController::class,'index']);
    Route::get('/check-in',[AttendenceController::class,'checkInTime']);
    Route::get('/check-out',[AttendenceController::class,'checkOutTime']);
    Route::get('/break-start',[AttendenceController::class,'breakStart']);
    Route::get('/break-end',[AttendenceController::class,'breakEnd']);

    // attendence
    Route::get('/view-attendence',[AttendenceController::class,'viewAttendenceEmp']);
    Route::post('/view-attendence-emp',[AttendenceController::class,'viewEachAttendenceEmp']);
    Route::post('/search-emp-details',[AttendenceController::class,'searchAttendenceEmp']);
    Route::get('/view-emp-attendence',[AttendenceController::class,'viewEmpAttendence']);
    // Route::get('/view-attendence-emp', [AttendenceController::class, 'viewAttendanceEmployee']);
    Route::post('/search-emp-attendence', [AttendenceController::class, 'searchEmpAttendenceAdmin'])->name('view-attendence');
    Route::post('/apply-for-leave', [AttendenceController::class, 'empApplyForLeave']);
    Route::get('/leave-records', [AttendenceController::class, 'empLeaveRecords']);
    Route::post('/search-emp-leaves', [AttendenceController::class, 'empSearchRecords']);
    Route::post('/show-update-attendence-form', [AttendenceController::class, 'showUpdateAttendenceForm']);
    Route::post('/update-emp-attendence-details', [AttendenceController::class, 'updateEmpAttendenceDetails'])->name('update-emp-attendence-details');

    // office time controller

    Route::get('/office-time', [TimeController::class, 'indexPage']);
    Route::post('/office-times-morning', [TimeController::class, 'setMorningShift']);
    Route::post('/office-times-night', [TimeController::class, 'setEveningShift']);

    // employee dashboard
    Route::get('/view_info_emp',[EmployeesController::class,'viewEmpSlips']);
    Route::post('/update-emp-info',[EmployeesController::class,'updateEmpInfo']);

    // tasks
    Route::get('/create-new-task',[TaskController::class,'index']);
    Route::get('/view-tasks',[TaskController::class,'viewTasks']);
    Route::post('/add-new-task',[TaskController::class,'addNewTask']);
    Route::post('/search-emp-tasks',[TaskController::class,'searchEmpAttendenceAdmin']);
    Route::post('/view-tasks-employees', [TaskController::class, 'viewTaskEachEmployee']);
    Route::get('/update-tasks/{id}', [TaskController::class, 'updateTaskEachEmployee']);
    Route::post('/update-each-task', [TaskController::class, 'updateEachTask']);
    Route::post('/update-each-task-emp', [TaskController::class, 'updateEachTaskEmp']);
    Route::get('/view-emp-tasks-each', [TaskController::class, 'employeeCanSeeTask']);

    // leaves
    Route::get('/leave-requests',[AttendenceController::class,'leaveRequests']);
    Route::get('/leave-request/approve/{empCode}', [AttendenceController::class, 'approveLeaveRequest']);
    Route::get('/leave-request/decline/{empCode}', [AttendenceController::class, 'declineLeaveRequest']);

    // announcement
    Route::get('/announcements',[AnnouncementController::class,'viewindexPage']);
    Route::post('/add-annoucement', [AnnouncementController::class, 'addAnnouncement']);

    // attendence time sheets
    Route::get('/attendence-time-sheet',[AttendenceController::class,'viewTimeSheet']);
    // Route::get('/highest-paid',[SalaryController::class,'viewHighPaidEmployee']);

    // admin front page
    Route::post('/get-date', [AuthController::class, 'getData']);
    // Route::get('/exchange-rate', [AuthController::class, 'getExchangeRate']);

    // task side of employee/ manager
    Route::get('/task-update/{id}',[TaskController::class, 'taskUpdateForm']);
    Route::post('/task-save-update/{id}',[TaskController::class, 'taskUpdateDatabase']);


});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

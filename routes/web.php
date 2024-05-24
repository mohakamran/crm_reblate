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
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\VacationController;





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
    Route::get('/filtered-data',[AuthController::class,'filterDataAdmin']);
    Route::get('/search-filtered-data/{dateRange}', [AuthController::class, 'searchFilteredData']);
    Route::post('/filter-manager-date', [AuthController::class, 'searchDateManagerHomePage']);
    Route::get('/unauthorized',[AuthController::class,'unauthorized']);

    // Employee Routes

    Route::get('/add-new', [EmployeesController::class, 'index'])->name('add-new-employee')->middleware('checkUserRole');
    Route::get('/manage-employees', [EmployeesController::class, 'manage'])->name('manage-employees')->middleware('checkUserRole');
    Route::get('/terminated-employees', [EmployeesController::class, 'terminatedEmp'])->middleware('checkUserRole');
    Route::post('/search-emp-attendence', [AttendenceController::class, 'searchEmpAttendenceAdmin'])->name('view-attendence')->middleware('checkUserRole');
    Route::get('/show-all-employees', [EmployeesController::class, 'showAllEmployees'])->middleware('checkUserRole');
    Route::post('/add-new-employee-data', [EmployeesController::class, 'getData'])->name('add-new-employee-data');
    Route::get('/change-status/{status}', [EmployeesController::class, 'changeStatus'])->middleware('checkUserRole');
    Route::get('/change-shift/{status}', [EmployeesController::class, 'changeShift'])->middleware('checkUserRole');
    Route::get('/change-status/{emp_id}', [EmployeesController::class, 'changeStatus'])->middleware('checkUserRole');
    Route::get('/update-employee/{emp_id}', [EmployeesController::class, 'updateEmployee'])->middleware('checkUserRole');
    Route::post('/update-employee-data/{emp_id}', [EmployeesController::class, 'updateEmployeeData']);
    Route::get('/view_emp_details/{emp_id}', [EmployeesController::class, 'viewEmployeeData'])->middleware('checkUserRole');
    Route::get('/view_info', [EmployeesController::class, 'viewInfo']);
    Route::get('/view_profile/{id}', [EmployeesController::class, 'viewProfile'])->middleware('checkUserRole');

    // users

    Route::get('/logout',[AuthController::class,'logout']);
    Route::get('/change-password',[AuthController::class,'changePassword'])->name('user.chang-password');
    Route::post('/change-password',[AuthController::class,'changePasswordData']);

    //expenses
    Route::get('/add-new-expense', [ExpenseController::class,'addExpenseRoute'])->name('add-new-expense')->middleware('ExpenseRole');
    Route::post('/add-new-expense', [ExpenseController::class,'addExpenseData'])->middleware('ExpenseRole');
    Route::get('/view-expenses', [ExpenseController::class,'viewExpenses'])->name('view-expenses')->middleware('ExpenseRole');
    Route::get('delete-expense/{expense_id}', [ExpenseController::class,'deleteExpenses'])->middleware('ExpenseRole');
    Route::get('/update-expense/{expense_id}', [ExpenseController::class,'updateExpenseRoute'])->middleware('ExpenseRole');
    Route::post('/update-expense-data/{expense_id}', [ExpenseController::class,'updateExpenseData'])->middleware('ExpenseRole');
    // clients
    Route::get('/add-new-client', [ClientController::class,'addClientRoute'])->name('add-new-client')->middleware('ClienteCheck');
    Route::post('/add-new-client', [ClientController::class,'addClientData'])->middleware('ClienteCheck');
    Route::get('/delete-client/{client_id}', [ClientController::class,'deleteClientData'])->middleware('ClienteCheck');
    Route::get('/view-clients', [ClientController::class,'viewClients'])->name('view-clients')->middleware('ClienteCheck');
    Route::get('/view-client-detail/{client_id}', [ClientController::class,'viewClientDetail'])->name('view-client-detail')->middleware('ClienteCheck');
    Route::get('/update_client/{client_id}', [ClientController::class,'updateClientRoute'])->name('update_client')->middleware('ClienteCheck');
    Route::post('/update-client/{client_id}', [ClientController::class,'updateClientData'])->name('update_client_data')->middleware('ClienteCheck');
    // salaries
    Route::get('/generate-new-salary-slip', [SalaryController::class,'generateNewSalarySlip'])->middleware('SalaryCheck');
    Route::get('/generate-new/{u_id}', [SalaryController::class,'generateNewSlip'])->middleware('SalaryCheck');
    Route::match(['get', 'post'], '/preview-salary/{u_id}', [SalaryController::class,'generateNewSlipTable'])->middleware('SalaryCheck');

    Route::post('/send-reciept/{u_id}', [SalaryController::class,'sendReciept'])->middleware('SalaryCheck');
    Route::get('/view-slips', [SalaryController::class,'viewReciepts'])->middleware('SalaryCheck');
    Route::get('/view-salaries/{id}', [SalaryController::class,'viewSalaries'])->middleware('SalaryCheck');
    Route::get('/update-salary/{id}', [SalaryController::class,'updateSalary'])->middleware('SalaryCheck');
    Route::get('/preview-slip-employee-page/{id}', [SalaryController::class,'viewSlipBrowser']);
    // Route::get('/testpdf', [SalaryController::class,'testPdf']);

    // salaries by month
    Route::get('/salary-by-month', [SalaryController::class,'showMonthWiseSalaries'])->middleware('AdminUser');
    Route::post('/search-salary-by-month', [SalaryController::class,'showMonthWiseSalariesByMonth'])->middleware('AdminUser');

    // invoices
    Route::get('/create-new-invoice',[InvoiceController::class,'createNewInvoice'])->middleware('ClienteCheck');
    Route::get('/create-invoice/{id}',[InvoiceController::class,'createNewInvoiceTable'])->middleware('ClienteCheck');
    Route::post('/confirm-invoice/{id}',[InvoiceController::class,'previewInvoice'])->middleware('ClienteCheck');
    Route::post('/send-invoice/{id}',[InvoiceController::class,'sendInvoice'])->middleware('ClienteCheck');
    Route::get('/view-invoices',[InvoiceController::class,'viewInvoices'])->middleware('ClienteCheck');
    Route::get('/preview-invoices/{id}',[InvoiceController::class,'viewIndividualInvoices'])->middleware('ClienteCheck');
    Route::get('/preview/{id}',[InvoiceController::class,'previewOnBrowser'])->middleware('ClienteCheck');


    // vacations
    Route::get('/office-vacations', [VacationController::class,'index'])->middleware('AdminUser');
    Route::match(['get', 'post'], '/create-holidays', [VacationController::class, 'createHolidays'])->middleware('AdminUser');
    Route::match(['get', 'post'], '/update-holidays', [VacationController::class, 'createHolidays'])->middleware('AdminUser');

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

    // client logins
    Route::get('/create-client-logins',[ClientController::class,'createClientLoginView'])->middleware('AdminCheck');
    Route::get('/send-credentials-clients/{id}',[ClientController::class,'sendDetailsClients'])->middleware('AdminCheck');
    Route::post('/create-credentials/{id}',[ClientController::class,'sendDetails'])->middleware('AdminCheck');
    Route::get('/view-clients-logins',[ClientController::class,'viewClientLogins'])->middleware('AdminCheck');
    Route::get('/delete-client-login/{id}',[ClientController::class,'deleteClientLogin'])->middleware('AdminCheck');
    Route::get('/reset-password-client/{id}',[ClientController::class,'resetPasswordClient'])->middleware('AdminCheck');

    // employee
    Route::get('view-my-slips',[SalaryController::class,'viewSlips']);

    //google 2fa
    // Route::get('/google-2fa',[SecurityController::class,'google2FA']);

    // Route::get('/mark-attendence',[AttendenceController::class,'index']);
    Route::get('/check-in',[AttendenceController::class,'checkInTime']);
    Route::get('/check-out',[AttendenceController::class,'checkOutTime']);
    Route::get('/break-start',[AttendenceController::class,'breakStart']);
    Route::get('/break-end',[AttendenceController::class,'breakEnd']);
    Route::get('/overtime-start',[AttendenceController::class,'overTimeStart']);
    Route::get('/overtime-end',[AttendenceController::class,'overTimeEnd']);

    // attendenceleave-requests
    Route::get('/view-attendence',[AttendenceController::class,'viewAttendenceEmp']);
    Route::get('/view-attendence-emp/{id}',[AttendenceController::class,'viewEachAttendenceEmp'])->middleware('AttendenceCheck');
    Route::post('/search-emp-details',[AttendenceController::class,'searchAttendenceEmp'])->middleware('AttendenceCheck');
    Route::get('/view-emp-attendence',[AttendenceController::class,'viewEmpAttendence'])->middleware('AttendenceCheck');
    // Route::get('/view-attendence-emp', [AttendenceController::class, 'viewAttendanceEmployee']);

    Route::post('/apply-for-leave', [AttendenceController::class, 'empApplyForLeave']);
    Route::get('/leave-records', [AttendenceController::class, 'empLeaveRecords']);

    Route::post('/search-emp-leaves', [AttendenceController::class, 'empSearchRecords']);
    Route::post('/show-update-attendence-form', [AttendenceController::class, 'showUpdateAttendenceForm']);
    Route::post('/update-emp-attendence-details', [AttendenceController::class, 'updateEmpAttendenceDetails'])->name('update-emp-attendence-details');
    Route::post('/filter_emp_date',[AttendenceController::class,'filterEmpDateWise']);
    Route::post('/save-attendance',[AttendenceController::class,'saveAttendence']);
    // Route::post('/save-attendance', [AttendanceController::class, 'saveAttendence'])->name('save.attendance');




    // office time controller

    Route::get('/office-time', [TimeController::class, 'indexPage'])->middleware('AdminCheck');
    Route::post('/office-times', [TimeController::class, 'setShift'])->middleware('AdminCheck');
    // Route::post('/office-times-night', [TimeController::class, 'setEveningShift'])

    // employee dashboard
    Route::get('/view_info_emp',[EmployeesController::class,'viewEmpSlips']);
    Route::post('/update-emp-info',[EmployeesController::class,'updateEmpInfo']);

    // tasks
    Route::get('/create-new-task',[TaskController::class,'index'])->middleware('TasksCheck');
    Route::get('/view-tasks',[TaskController::class,'viewTasks'])->middleware('TasksCheck');
    Route::post('/add-new-task',[TaskController::class,'addNewTask'])->middleware('TasksCheck');
    Route::post('/search-emp-tasks',[TaskController::class,'searchEmpAttendenceAdmin'])->middleware('TasksCheck');
    Route::post('/view-tasks-employees', [TaskController::class, 'viewTaskEachEmployee'])->middleware('TasksCheck');
    Route::get('/update-tasks/{id}', [TaskController::class, 'updateTaskEachEmployee'])->middleware('TasksCheck');
    Route::post('/update-each-task', [TaskController::class, 'updateEachTask'])->middleware('TasksCheck');
    Route::post('/update-each-task-emp', [TaskController::class, 'updateEachTaskEmp']);
    Route::get('/view-emp-tasks-each', [TaskController::class, 'employeeCanSeeTask']);

    // leaves
    Route::get('/leave-requests',[AttendenceController::class,'leaveRequests']);
    Route::get('/leave-request/{action}/{id}',[AttendenceController::class,'updateLeaveStatus'])->name('leave.handle');
    // Route::get('/leave-request/{action}/{id}/{emp_code}', 'LeaveController@handleLeaveRequest')->name('leave.handle');


    // announcement
    Route::get('/announcements',[AnnouncementController::class,'viewindexPage'])->middleware('AdminCheck');
    Route::post('/add-annoucement', [AnnouncementController::class, 'addAnnouncement'])->middleware('AdminCheck');

    // attendence time sheets
    Route::get('/attendence-time-sheet',[AttendenceController::class,'viewTimeSheet']);
    Route::get('/highest-paid',[SalaryController::class,'viewHighPaidEmployee']);

    // admin front page
    Route::post('/get-date', [AuthController::class, 'getData']);
    // Route::get('/exchange-rate', [AuthController::class, 'getExchangeRate']);

    // task side of employee/ manager
    Route::get('/task-update/{id}',[TaskController::class, 'taskUpdateForm']);
    Route::post('/task-save-update/{id}',[TaskController::class, 'taskUpdateDatabase']);
    Route::post('/save_task_database',[TaskController::class, 'taskSaveDatabase']);


    Route::get('/view_reports',[ReportingController::class, 'viewReports']);
    Route::post('/saveReportsDatabase', [ReportingController::class, 'saveReportsDatabase']);

    // projectController

    Route::get('/projects',[ProjectController::class,'index']);


});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


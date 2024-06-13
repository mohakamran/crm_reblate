<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\EmployeesController;

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

    Route::get('/view_profile/{id}', [EmployeesController::class, 'viewProfile']);

    Route::post('/update-info-emp', [EmployeesController::class, 'updateInfoEmp']);
    Route::post('/update-info-salary', [EmployeesController::class, 'updateInfoSalary']);
    Route::post('/update-info-bank', [EmployeesController::class, 'updateInfoBank']);
    Route::post('/update-info-contact', [EmployeesController::class, 'updateInfoContact']);
    Route::match(['get', 'post'],'/add-emp-edu', [EmployeesController::class, 'addEducationEmp']);
    Route::match(['get', 'post'],'/update-info-company', [EmployeesController::class, 'updateInfoCom']);
    Route::match(['get', 'post'],'/add-emp-work', [EmployeesController::class, 'addWorkEmp']);

    Route::match(['get', 'post'],'/del-emp-edu/{id}', [EmployeesController::class, 'removeEduEmp']);
    Route::match(['get', 'post'],'/update-emp-edu', [EmployeesController::class, 'updateEduEmp']);

    Route::match(['get', 'post'],'/del-emp-work/{id}', [EmployeesController::class, 'removeWorkEmp']);
    Route::match(['get', 'post'],'/update-emp-work', [EmployeesController::class, 'updateWorkEmp']);

    Route::match(['get', 'post'],'/update-photo-emp', [EmployeesController::class, 'updatePhotoEmp']);

    // employee dashboard
    Route::get('/view_info_emp',[EmployeesController::class,'viewEmpSlips']);
    Route::post('/update-emp-info',[EmployeesController::class,'updateEmpInfo']);

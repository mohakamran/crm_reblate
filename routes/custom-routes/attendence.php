<?php
    use App\Http\Controllers\AttendenceController;

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
    Route::post('/search-emp-details',[AttendenceController::class,'searchAttendenceEmp']);
    Route::get('/view-emp-attendence',[AttendenceController::class,'viewEmpAttendence'])->middleware('AttendenceCheck');
    // Route::get('/view-attendence-emp', [AttendenceController::class, 'viewAttendanceEmployee']);


    Route::match(['get', 'post'],'/apply-for-leave', [AttendenceController::class, 'empApplyForLeave'])->name('apply-for-leave');

    Route::get('/leave-records', [AttendenceController::class, 'empLeaveRecords'])->name('leaves.record');
    
    Route::get('/update-leave/{id}', [AttendenceController::class, 'updateLeaves']);
    Route::post('/update-leave/{id}', [AttendenceController::class, 'updateLeavesSave']);

    Route::post('/search-emp-leaves', [AttendenceController::class, 'empSearchRecords']);
    Route::post('/show-update-attendence-form', [AttendenceController::class, 'showUpdateAttendenceForm']);
    Route::post('/update-emp-attendence-details', [AttendenceController::class, 'updateEmpAttendenceDetails'])->name('update-emp-attendence-details');
    Route::post('/filter_emp_date',[AttendenceController::class,'filterEmpDateWise']);
    Route::post('/save-attendance',[AttendenceController::class,'saveAttendence']);
    Route::match(['get', 'post'], '/add-attendance', [AttendenceController::class, 'addAttendence']);

        // leaves
        Route::get('/leave-requests',[AttendenceController::class,'leaveRequests']);
        Route::get('/leave-request/{action}/{id}',[AttendenceController::class,'updateLeaveStatus'])->name('leave.handle');

    // Route::post('/save-attendance', [AttendanceController::class, 'saveAttendence'])->name('save.attendance');
    // attendence time sheets
    Route::get('/attendence-time-sheet',[AttendenceController::class,'viewTimeSheet']);

    Route::post('/search-emp-attendence', [AttendenceController::class, 'searchEmpAttendenceAdmin'])->name('view-attendence')->middleware('checkUserRole');

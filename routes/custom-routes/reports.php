<?php
    use App\Http\Controllers\ReportingController;
    use Illuminate\Support\Facades\Route;

    Route::get('/view_reports',[ReportingController::class, 'viewReports'])->name('report.index');
    Route::get('/add-reports',[ReportingController::class, 'addReports'])->name('report.add');
    Route::get('/edit-reports/{id}',[ReportingController::class, 'editReports'])->name('report.edit');
    Route::post('/report', [ReportingController::class, 'submitForm'])->name('report.store');
    Route::delete('/Delete-Report/{id}',[ReportingController::class,'deleteReport'])->name('report.destroy');
    Route::put('/reports/{id}', [ReportingController::class, 'updateReport'])->name('report.update');
    Route::get('/Show-Weekly-report/{employeeId}', [ReportingController::class, 'reportRecords'])->name('report.record');
    Route::post('admin/report/{id}/update', [ReportingController::class, 'Adminupdate'])->name('report.update.admin');
    Route::post('manager/report/{id}/update', [ReportingController::class, 'Managerupdate'])->name('report.update.manager');
    Route::get('Show-admin-monthly-report/{id}', [ReportingController::class, 'ShowAdminRecords'])->name('report.record.admin');
    Route::get('Show-emp/{id}', [ReportingController::class, 'ShowEmpRecords'])->name('report.empShow');
    Route::get('/reports', [ReportingController::class, 'index'])->name('report.index');
    Route::get('/weekly-report', [ReportingController::class, 'getWeeklyReport']);
    Route::post('/submit-weekly-report', [ReportingController::class, 'submitWeeklyReport'])->name('submit-weekly-report');
    Route::post('/task/{id}/approve', [ReportingController::class, 'approve'])->name('task.approve');
    Route::post('/task/{id}/not-approve', [ReportingController::class, 'notApprove'])->name('task.not_approve');
    Route::get('/check-out/validate-weekly-report', [ReportingController::class, 'validateWeeklyReport']);





<?php
    use App\Http\Controllers\ReportingController;
    use Illuminate\Support\Facades\Route;

    Route::get('/view_reports',[ReportingController::class, 'viewReports'])->name('report.index');
    Route::get('/add-reports',[ReportingController::class, 'addReports'])->name('report.add');
    Route::get('/edit-reports/{id}',[ReportingController::class, 'editReports'])->name('report.edit');
    Route::post('/report', [ReportingController::class, 'submitForm'])->name('report.store');
    Route::delete('/Delete-Report/{id}',[ReportingController::class,'deleteReport'])->name('report.destroy');
    Route::put('/reports/{id}', [ReportingController::class, 'updateReport'])->name('report.update');
    Route::get('/monthly-report', [ReportingController::class, 'reportRecords'])->name('report.record');
    Route::post('admin/report/{id}/update', [ReportingController::class, 'Adminupdate'])->name('report.update.admin');
    Route::post('manager/report/{id}/update', [ReportingController::class, 'Managerupdate'])->name('report.update.manager');
    Route::get('Show-admin-monthly-report/{id}', [ReportingController::class, 'ShowAdminRecords'])->name('report.record.admin');



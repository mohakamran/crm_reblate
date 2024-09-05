<?php
    use App\Http\Controllers\ReportingController;
    use Illuminate\Support\Facades\Route;

    Route::get('/view_reports',[ReportingController::class, 'viewReports'])->name('report.index');
    Route::get('/add-reports',[ReportingController::class, 'addReports'])->name('report.add');
    Route::post('/report', [ReportingController::class, 'submitForm'])->name('report.store');

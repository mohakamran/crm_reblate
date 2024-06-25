<?php
    use App\Http\Controllers\ReportingController;

    Route::get('/view_reports',[ReportingController::class, 'viewReports']);
    Route::post('/saveReportsDatabase', [ReportingController::class, 'saveReportsDatabase']);

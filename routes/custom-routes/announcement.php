<?php
use App\Http\Controllers\AnnouncementController;
    // announcement
    Route::get('/announcements',[AnnouncementController::class,'viewindexPage'])->middleware('AdminCheck');
    Route::post('/add-annoucement', [AnnouncementController::class, 'addAnnouncement'])->middleware('AdminCheck');

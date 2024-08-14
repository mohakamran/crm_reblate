<?php
use App\Http\Controllers\AnnouncementController;
// announcement
Route::get('/announcements',[AnnouncementController::class,'viewindexPage'])->middleware('AdminManager');
Route::post('/add-annoucement', [AnnouncementController::class, 'addAnnouncementSave'])->middleware('AdminManager');
Route::get('/add-annoucement', [AnnouncementController::class, 'addAnnouncement'])->middleware('AdminManager');
Route::get('/view-announcement/{id}', [AnnouncementController::class, 'viewAnnouncement']);
Route::get('/view-announcements', [AnnouncementController::class, 'viewAnnouncements']);
Route::get('/change-announcement/{id}', [AnnouncementController::class, 'changeAnnouncement'])->middleware('AdminManager');
Route::post('/change-annoucement/{id}', [AnnouncementController::class, 'changeAnnouncementSave'])->middleware('AdminManager');
Route::get('/del-announcement/{id}', [AnnouncementController::class, 'deleteAnnouncement'])->middleware('AdminManager');

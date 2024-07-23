<?php
     use App\Http\Controllers\HelpController;
    // Help Page File Uploader
    Route::get('/file-upload', [HelpController::class,'index'])->name('help.index');
    Route::match(['get', 'post'], '/save-help-file', [HelpController::class, 'saveFile'])->name('help.save');
    Route::match(['get', 'post'], '/delete-help-file/{id}', [HelpController::class, 'deleteFile'])->name('help.delete');
    Route::get('/view-page/{id}', [HelpController::class, 'viewPage']);
    Route::any('/ckeditor/upload', [HelpController::class, 'upload'])->name('ckeditor.upload');

    Route::get('/upload-new-file', [HelpController::class, 'showNewFileForm']);
    Route::post('/save-file', [HelpController::class, 'saveFile'])->name('save-file');
    Route::get('/update-file/{id}', [HelpController::class, 'updateFile'])->name('update-file');
    Route::post('/update-file/{id}', [HelpController::class, 'updateFileDatabase'])->name('update-file');
    Route::get('/del-file/{id}', [HelpController::class, 'delFile']);
    Route::get('/page-view/{id}', [HelpController::class, 'viewFile']);

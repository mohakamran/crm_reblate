<?php
     use App\Http\Controllers\HelpController;
    // Help Page File Uploader
    Route::get('/help', [HelpController::class,'index'])->name('help.index');
    Route::match(['get', 'post'], '/save-help-file', [HelpController::class, 'saveFile'])->name('help.save');
    Route::match(['get', 'post'], '/delete-help-file/{id}', [HelpController::class, 'deleteFile'])->name('help.delete');

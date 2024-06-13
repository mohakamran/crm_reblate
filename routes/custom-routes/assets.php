<?php
use App\Http\Controllers\AssetController;
    // Assets Controller
    Route::get('/view-assets',[AssetController::class,'index']);

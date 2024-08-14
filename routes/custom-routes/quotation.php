<?php
use App\Http\Controllers\QuotationController;
Route::get('/quotations',[QuotationController::class,'index']);
Route::get('/create-quotation',[QuotationController::class,'createQuotation'])->middleware('AdminCheck');
Route::post('/create-quotation',[QuotationController::class,'saveQuotation']);
Route::get('/view-quotation/{id}',[QuotationController::class,'viewQuotation']);
Route::get('/del-quotation/{id}',[QuotationController::class,'delQuotation']);

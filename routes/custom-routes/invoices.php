<?php
use App\Http\Controllers\InvoiceController;
// invoices
Route::get('/create-new-invoice',[InvoiceController::class,'createNewInvoice'])->middleware('ClienteCheck');
Route::get('/create-invoice/{id}',[InvoiceController::class,'createNewInvoiceTable'])->middleware('ClienteCheck');
Route::post('/confirm-invoice/{id}',[InvoiceController::class,'previewInvoice'])->middleware('ClienteCheck');
Route::post('/send-invoice/{id}',[InvoiceController::class,'sendInvoice'])->middleware('ClienteCheck');
Route::get('/view-invoices',[InvoiceController::class,'viewInvoices'])->middleware('ClienteCheck');
Route::get('/preview-invoices/{id}',[InvoiceController::class,'viewIndividualInvoices'])->middleware('ClienteCheck');
Route::get('/preview/{id}',[InvoiceController::class,'previewOnBrowser'])->middleware('ClienteCheck');

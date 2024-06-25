<?php
use App\Http\Controllers\ClientController;

// clients
Route::get('/add-new-client', [ClientController::class,'addClientRoute'])->name('add-new-client')->middleware('ClienteCheck');
Route::post('/add-new-client', [ClientController::class,'addClientData'])->middleware('ClienteCheck');
Route::get('/delete-client/{client_id}', [ClientController::class,'deleteClientData'])->middleware('ClienteCheck');
Route::get('/view-clients', [ClientController::class,'viewClients'])->name('view-clients')->middleware('ClienteCheck');
Route::get('/view-client-detail/{client_id}', [ClientController::class,'viewClientDetail'])->name('view-client-detail')->middleware('ClienteCheck');
Route::get('/update_client/{client_id}', [ClientController::class,'updateClientRoute'])->name('update_client')->middleware('ClienteCheck');
Route::post('/update-client/{client_id}', [ClientController::class,'updateClientData'])->name('update_client_data')->middleware('ClienteCheck');

// client logins
Route::get('/create-client-logins',[ClientController::class,'createClientLoginView'])->middleware('AdminCheck');
Route::get('/send-credentials-clients/{id}',[ClientController::class,'sendDetailsClients'])->middleware('AdminCheck');
Route::post('/create-credentials/{id}',[ClientController::class,'sendDetails'])->middleware('AdminCheck');
Route::get('/view-clients-logins',[ClientController::class,'viewClientLogins'])->middleware('AdminCheck');
Route::get('/delete-client-login/{id}',[ClientController::class,'deleteClientLogin'])->middleware('AdminCheck');
Route::get('/reset-password-client/{id}',[ClientController::class,'resetPasswordClient'])->middleware('AdminCheck');

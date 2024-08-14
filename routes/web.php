<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\SecurityController;

use App\Http\Controllers\QuotationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require_once __DIR__.'/custom-routes/auth.php';

Route::group(['middleware' => 'admin'], function () {

    // auth routes 2
    require_once __DIR__.'/custom-routes/auth2.php';

    // employees routes
    require_once __DIR__.'/custom-routes/employees.php';

    // expenses
    require_once __DIR__.'/custom-routes/expenses.php';

    // clients
    require_once __DIR__.'/custom-routes/clients.php';

    // salaries
    require_once __DIR__.'/custom-routes/salaries.php';

    // invoices
    require_once __DIR__.'/custom-routes/invoices.php';

    // vacations
    require_once __DIR__.'/custom-routes/vacations.php';

    // logins
    require_once __DIR__.'/custom-routes/logins.php';

    // attendence
    require_once __DIR__.'/custom-routes/attendence.php';

    // tasks
    require_once __DIR__.'/custom-routes/tasks.php';

    // projectController
    require_once __DIR__.'/custom-routes/projects.php';

    // office_times
    require_once __DIR__.'/custom-routes/office_times.php';
    // announcements
    require_once __DIR__.'/custom-routes/announcement.php';
    // reports
    require_once __DIR__.'/custom-routes/reports.php';
    // reports
    require_once __DIR__.'/custom-routes/assets.php';
    // help page
    require_once __DIR__.'/custom-routes/help.php';
    // notifications page
    require_once __DIR__.'/custom-routes/notifications.php';
    // quotation page
    // require_once __DIR__.'/custom-routes/quotation.php';


    Route::middleware('AdminManager')->group(function () {
        Route::get('/view-quotations', [QuotationController::class, 'index']);
        Route::get('/create-quotation', [QuotationController::class, 'createQuotation']);
        Route::post('/create-quotation', [QuotationController::class, 'saveQuotation']);
        Route::get('/view-quotation/{id}', [QuotationController::class, 'viewQuotation']);
        Route::get('/del-quotation/{id}', [QuotationController::class, 'delQuotation']);
        Route::get('/send-quotation/{id}/{status}', [QuotationController::class, 'sendQuotation']);
    });

    //google 2fa
    // Route::get('/google-2fa',[SecurityController::class,'google2FA']);

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Notifications;

Route::match(['get','post'],'/mark-as-read', [Notifications::class, 'markAsRead']);

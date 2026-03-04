<?php

use App\Http\Controllers\PaymentNotificationController;
use Illuminate\Support\Facades\Route;

Route::post('/webhook/midtrans', PaymentNotificationController::class)
    ->name('webhook.midtrans');

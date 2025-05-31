<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/send-bulk-emails', function () {
    return view('sendbulkemails');
});

Route::post('/send/bulk/emails', [EmailController::class, 'sendBulkEmail'])->name('emails.send');

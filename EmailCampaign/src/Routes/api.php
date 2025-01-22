<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailCompaignController;

Route::prefix('api/email-campaign')->group(function () {
    Route::post('/create-campaign', [EmailCompaignController::class, 'store']);
    Route::get('/filter-audience', [EmailCompaignController::class, 'filterAudience']);
    Route::post('/send-emails', [EmailCompaignController::class, 'sendCampaign']);
});
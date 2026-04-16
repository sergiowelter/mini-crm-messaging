<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::apiResource('contacts', ContactController::class);
Route::apiResource('campaigns', CampaignController::class);

Route::post('/campaigns/{id}/send', [CampaignController::class, 'send']);
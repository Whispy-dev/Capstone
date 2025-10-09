<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DeviceTokenController;

Route::middleware('auth:sanctum')->post('/device-token', [DeviceTokenController::class, 'store']);
<?php

use App\Http\Controllers\AuthenticableController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user', [UserController::class,'store']);

Route::post('/login', [AuthenticableController::class,'login']);
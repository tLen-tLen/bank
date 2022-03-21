<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// действия со счетом
Route::post('/openAccount', [AccountController::class, 'openAccount']);
Route::get('/account', [AccountController::class, 'getAccount']);
Route::post('/changeAmount', [AccountController::class, 'changeAmount']);
Route::post('/changeBaseCurrency', [AccountController::class, 'changeBaseCurrency']);

// действия с курсом
Route::post('/changeCourse', [CourseController::class, 'changeCourse']);

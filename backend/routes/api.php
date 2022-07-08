<?php

use App\Http\Controllers\ExchangeRatesController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('exchange-rates')->group(function () {
    Route::get('/by-date/{date}/{code?}', [ExchangeRatesController::class, 'getRateByDate']);
    Route::post('/add-note/{rate}', [ExchangeRatesController::class, 'setNote']);
});

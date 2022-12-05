<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\GoodMarketController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(MarketController::class)->group( function() {
  Route::post('/markets','save');
  Route::get('/markets','list');
  Route::get('/markets/{id}','get');
  Route::put('/markets/{id}','update');
});

Route::controller(GoodController::class)->group( function() {
  Route::post('/goods','save');
  Route::get('/goods','list');
  Route::get('/goods/{id}','get');
  Route::put('/goods/{id}','update');
});

Route::controller(GoodMarketController::class)->group( function() {
  Route::post('/markets/{market_id}/goods','addGoodToMarket');
  Route::post('/markets/{market_id}/goods/{good_id}','addExistingGoodToMarket');
  Route::put('/markets/{market_id}/goods/{good_id}','updateGoodMarket');
});

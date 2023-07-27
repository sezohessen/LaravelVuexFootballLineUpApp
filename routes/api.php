<?php

use App\Http\Controllers\API\FormationController;
use App\Http\Controllers\API\LineController;
use App\Http\Controllers\API\PlayerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('player',PlayerController::class);
Route::resource('lines',LineController::class);
Route::resource('formation',FormationController::class);
Route::get('goalkeepers',[FormationController::class,'goalkeepers']);
Route::get('defenders',[FormationController::class,'defenders']);
Route::get('midfielders',[FormationController::class,'midfielders']);
Route::get('attackers',[FormationController::class,'attackers']);

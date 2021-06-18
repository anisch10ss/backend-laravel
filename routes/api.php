<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssuranceController;
use App\Http\Controllers\RemboursementController;
use App\Http\Controllers\ClientController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['cors'])->group(function () {
    Route::post('/hogehoge', 'Controller@hogehoge');
});

Route::post("login",[UserController::class,'index']);
Route::post("registre",'UserController@create');
Route::apiResource('cour','CourController');
Route::post('/login2', 'ClientController@index');
Route::post('/signup', 'ClientController@create');

Route::group(['middleware' => 'auth:sanctum'], function(){
    // Route::apiResource('client','ClientController');
    // Route::apiResource('facture','FactureController');
    // Route::apiResource('objet','ObjetController');
    // Route::apiResource('remboursement','RemboursementController');
    // Route::apiResource('assurance','AssuranceController');
    // Route::apiResource('message','MessageController');
    // Route::apiResource('notification','NotificationController');
    
    Route::post('/assurance2', 'AssuranceController@store');
    Route::get('/assurance', 'AssuranceController@index');
    Route::get('/remboursement', 'RemboursementController@index');
    Route::post('/remboursement2', 'RemboursementController@store');
    Route::post('/editprofile', 'ClientController@store');
    Route::get('/getprofile', 'ClientController@get');
    });


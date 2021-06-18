<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Auth::routes();



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('/assurance', 'AssuranceController@index');
Route::get('/remboursement', 'RemboursementController@index')->name('home');
Route::post("login",[UserController::class,'index']);
Route::post("registre",'UserController@create');
Route::apiResource('cour','CourController');
Route::post('/assurance2', 'AssuranceController@store');
Route::post('/editprofile', 'ClientController@store'); 

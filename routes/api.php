<?php

use Illuminate\Http\Request;
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

Route::post('login', 'PassportController@login');

Route::post('register', 'PassportController@register');

Route::middleware('auth:api')->group(function (){

    Route::put('staff/citizens/health-status/{id}','staffController@updateHealthStatus');

    Route::put('citizens/location-update/{id}', 'CitizenController@locationupdate');

    Route::post('citizens/addContacts', 'CitizenController@addContacts');

    Route::get('staff/allCitizens','staffController@getCitizens');

    Route::get('staff/allCitizens/{id}','staffController@getCitizensById');

    Route::get('staff/citizens/{id}/contacts', 'staffController@getCitizenContacts');

    Route::delete('citizens/{id}','staffController@deactivateAccounts');

    Route::post('citizens/location-update/{id}/confirm','citizenController@');
});



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

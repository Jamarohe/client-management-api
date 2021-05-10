<?php
 
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
 //----------------------------- CRUD CLIENT  -----------------------------
Route::POST('createClient', 'ClientController@createClient');
Route::POST('updateClient', 'ClientController@updateClient');
Route::DELETE('deleteClient/{id}', 'ClientController@deleteClient');
Route::POST('clientFilters', 'ClientController@getClientFilters');
Route::POST('imageUploadPost', 'ClientController@imageUploadPost');
Route::GET('getClients/{id?}', 'ClientController@getClient');

//-----------------------------  TRAVEL  -----------------------------
Route::POST('createTravel', 'TravelController@createTravel');
Route::POST('createTravelXML', 'TravelController@createTravelXML');
Route::POST('getTravelFilters', 'TravelController@getTravelFilters');
Route::GET('getTravel/{id?}', 'TravelController@getTravel');


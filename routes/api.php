<?php

use Illuminate\Http\Request;

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

Route::get('/kitchen/tickets', 'api\v1\KitchenController@getTickets');
Route::post('/kitchen/{id}/delete', 'api\v1\KitchenController@deleteTicket');

Route::get('/bar/tickets', 'api\v1\BarController@getTickets');
Route::post('/bar/{id}/delete', 'api\v1\BarController@deleteTicket');

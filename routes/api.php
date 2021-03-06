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

Route::get('/tickets/kitchen', 'api\v1\TicketController@getKitchenTickets');
Route::post('/tickets/{id}/delete', 'api\v1\TicketController@deleteTicket');

Route::get('/tickets/bar', 'api\v1\TicketController@getBarTickets');
Route::post('/tickets/{id}/delete', 'api\v1\TicketController@deleteTicket');

Route::get('/tickets/all', 'api\v1\TicketController@getTickets');
Route::post('/tickets/{id}/delete', 'api\v1\TicketController@deleteTicket');

Route::get('/sales/today', 'api\v1\SalesController@getToday');
Route::get('/sales/month', 'api\v1\SalesController@getMonth');
Route::get('/sales/year', 'api\v1\SalesController@getYear');
Route::get('/sales/table/{id}', 'api\v1\SalesController@getByTable');

Route::post('/tickets/deleteAll', 'api\v1\TicketController@deleteAll');
Route::post('/tickets/deleteAllKitchen', 'api\v1\TicketController@deleteAllKitchen');
Route::post('/tickets/deleteAllBar', 'api\v1\TicketController@deleteAllBar');

Route::post('/table/create', 'api\v1\TableController@createTable');
Route::post('/table/rename', 'api\v1\TableController@renameTable');
Route::post('/table/delete', 'api\v1\TableController@deleteTable');
Route::post('/table/save', 'api\v1\TableController@save');
Route::post('/table/nosave', 'api\v1\TableController@nosave');
Route::get('/table/{id}/status', 'api\v1\TableController@status');

Route::post('/sale/{id}/delete', 'api\v1\SalesController@delete');

Route::post('/bill/{id}/pay', 'api\v1\BillController@pay');
Route::post('/bill/{id}/delete', 'api\v1\BillController@delete');

Route::post('/settings/set', 'api\v1\SettingsController@set');

Route::get('/products/sales', 'api\v1\ProductController@getSales');

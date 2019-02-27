<?php

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
    return view('landing');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::get('/inventory', 'HomeController@inventory');
Route::get('/inventory/category', 'HomeController@category');
Route::get('/inventory/category/{id}/product', 'HomeController@addProduct');
Route::get('/inventory/product/{id}/edit', 'HomeController@editProduct');
Route::post('/inventory/product/{id}/edit', 'ProductController@update');

Route::get('/pos', 'HomeController@posTable');
Route::get('/pos/{iTable}', 'HomeController@pos');
Route::get('/pos/{iTable}/cat/{iCat}', 'HomeController@posCategory');
Route::get('/pos/{iTable}/cat/{iCat}/prod/{iProd}', 'HomeController@posProduct');
Route::get('/pos/{iTable}/pay', 'HomeController@posPay');
Route::post('/pos/product', 'OrderController@order');

Route::post('/inventory/category', 'ProductCategoryController@add');
Route::get('/inventory/category/{id}/delete', 'ProductCategoryController@delete');

Route::post('/inventory/product', 'ProductController@add');
Route::get('/inventory/product/{id}/delete', 'ProductController@delete');

Route::get('tickets/kitchen', 'HomeController@kitchen');
Route::get('tickets/bar', 'HomeController@bar');
Route::get('/tickets', 'HomeController@tickets');

Route::get('/settings/table', 'HomeController@tableSettings');
Route::get('/settings/table/layout', 'KonvaTableController@getLayout');
Route::post('/settings/table/layout', 'KonvaTableController@saveLayout');
Route::get('/settings/table/poslayout', 'KonvaTableController@getPosLayout');
Route::post('/settings/table/poslayout', 'KonvaTableController@savePosLayout');
Route::get('/settings/table/analyticslayout', 'KonvaTableController@getAnalyticsLayout');
Route::post('/settings/table/analyticslayout', 'KonvaTableController@saveAnalyticsLayout');

Route::get('/settings/management', 'HomeController@managementSettings');
Route::get('/settings/pos', 'HomeController@posSettings');
Route::get('/user/preferences', 'Homecontroller@userPreferences');
Route::get('/user/profile', 'HomeController@userProfile');

Route::get('/analytics/sales', 'HomeController@analyticsSales');
Route::get('/analytics/products', 'HomeController@analyticsProducts');
Route::get('/analytics/tables', 'HomeController@analyticsTables');

Route::get('/reservations', 'HomeController@reservations');
Route::post('/reservations', 'ReservationController@create');
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
Route::get('/inventory/category/{id}/product', 'HomeController@product');

Route::get('/pos', 'HomeController@pos');
Route::get('/pos/{id}', 'HomeController@posCategory');
Route::get('/pos/product/{id}', 'HomeController@posProduct');
Route::post('/pos/product/{id}', 'OrderController@order');

Route::post('/inventory/category', 'ProductCategoryController@add');
Route::get('/inventory/category/{id}/delete', 'ProductCategoryController@delete');

Route::post('/inventory/product', 'ProductController@add');
Route::get('/inventory/product/{id}/delete', 'ProductController@delete');

Route::get('/kitchen', 'HomeController@kitchen');
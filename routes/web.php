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
    return view('welcome');
})->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController');
    Route::resource('clients', 'ClientsController');
    Route::resource('products', 'ProductsController');
    Route::resource('schedules', 'ServicesController');
    Route::resource('cashflows', 'CashFlowsController');
    Route::resource('scheduleitems', 'ServiceItemsController');
    Route::get('schedule/{schedule}/done', 'ServicesController@done')->name('schedules.done');

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

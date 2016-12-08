<?php
/*
|--------------------------------------------------------------------------
| Package Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.dfdf
|
*/
Route::get('connect', 'Myleshy\Quickbooks\QuickbooksController@connect');
Route::get('create', 'Myleshy\Quickbooks\QuickbooksController@create');
Route::get('update', 'Myleshy\Quickbooks\QuickbooksController@update');
Route::get('get', 'Myleshy\Quickbooks\QuickbooksController@get');
Route::get('delete', 'Myleshy\Quickbooks\QuickbooksController@delete');
Route::get('items', 'Myleshy\Quickbooks\QuickbooksController@items');

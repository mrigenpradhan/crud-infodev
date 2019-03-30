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

Route::get('/', 'CrudController@index')->name('page.index');

Route::post('/new-data','CrudController@newData');

Route::post('/edit/{id}','CrudController@editData');

Route::get('/delete/{id}','CrudController@deleteData');
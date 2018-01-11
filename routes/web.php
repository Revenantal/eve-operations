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

//Auth::routes();

Route::get('/', 'HomeController@index');

// Auth
Route::get('login', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('login/esi/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Operation Management
Route::resource('operations', 'OperationsController');
Route::get('/operations/parts/{part_name}', 'OperationsController@operation_form_part');

// Add discord setting management
Route::group(['middleware' => 'auth'], function(){
    Route::get('/settings', ['as' => 'settings.index', 'uses' => 'SettingsController@index']);
    Route::put('/settings', ['as' => 'settings.update', 'uses' => 'SettingsController@update']);
});
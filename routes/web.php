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

use App\Models\Auth\User;

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@index']);

// Auth Routing
Route::group(['prefix' => 'auth'], function(){
    Route::get('/login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
    Route::get('/callback', ['as' => 'callback', 'uses' => 'Auth\LoginController@callback']);
    Route::post('/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);
});

// Admin Routing
Route::group(['prefix' => 'admin', 'namespace' => 'Auth', 'middleware' => 'auth'], function(){
    Route::get('/', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController');
    Route::resource('/users', 'UserController');
});

Route::resource('operations', 'OperationsController');

if(config('app.debug') === true) {
    Route::get('/debug', function () {
        $user = User::find(1);
        auth()->login($user);
        return redirect('/');
    });
}
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/');
    });
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::match(['GET', 'POST'], 'move', 'HomeController@movement')->name('move');

// user
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function () {
    Route::get('/', 'UserController@index')->name('user');
    Route::match(['GET', 'POST'], 'add', 'UserController@add');
    Route::match(['GET', 'POST'], 'edit/{id}', 'UserController@edit');
    Route::match(['GET', 'POST'], 'delete/{id}', 'UserController@delete');
    Route::match(['GET','POST'], 'disable/{id}', 'UserController@disable');
    Route::match(['GET','POST'], 'enable/{id}', 'UserController@enable');
});

// Profile
Route::group(['prefix' => 'profile','middleware' => 'auth'], function () {
    Route::match(['GET', 'POST'], '/', 'UserController@profile')->name('profile');
});

// Role and permission
Route::group(['prefix' => 'role', 'middleware' => ['auth']], function () {
    Route::get('/', 'RoleController@view')->name('role');
    Route::match(['GET', 'POST'], 'add', 'RoleController@add');
    Route::match(['GET', 'POST'], 'edit/{id}', 'RoleController@edit');
    Route::match(['GET', 'POST'], 'permission/{id}', 'RoleController@permission');
    Route::match(['GET', 'POST'], 'delete/{id}', 'RoleController@delete');
    Route::get('getrole', 'RoleController@getrole')->name('getrole');
    Route::post('/check_role_key', 'RoleController@check_role_key');
});

// discount
Route::group(['prefix' => 'dictionarylist', 'middleware' => ['auth']], function () {
    Route::get('/', 'WordController@index')->name('dictionarylist');
    Route::match(['GET', 'POST'], 'create', 'WordController@create');
    Route::match(['GET', 'POST'], 'edit/{id}', 'WordController@edit');
    Route::match(['GET', 'POST'], 'destroy/{id}', 'WordController@destroy');
    Route::match(['GET','POST'], 'disable/{id}', 'WordController@disable');
    Route::match(['GET','POST'], 'enable/{id}', 'WordController@enable');
});

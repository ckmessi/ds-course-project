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

	if(session()->has('user_id')){
		 return redirect('/home');
	}
    return view('welcome');
});

Route::post('/login', 'UserController@login');
Route::post('/logout', 'UserController@logout');

Route::get('/home', 'UserController@home');
Route::get('/list', 'UserController@showList');

Route::post('/confirm', 'UserController@confirm');

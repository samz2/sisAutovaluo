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
    return view('auth.login');
})->middleware('checkAuth');;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//rutas administrador
Route::post('/addUser', 'personaController@store');
//fin rutas administrador

// Rutas alternas
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');

//rutas para admin/predio
Route::resource('/getPredioList', 'predioController');
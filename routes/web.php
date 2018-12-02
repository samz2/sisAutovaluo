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
})->middleware('checkAuth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//rutas administrador
Route::post('/addUser', 'personaController@store');
//fin rutas administrador

//rutas para admin/predio-------
Route::resource('/getPredioList', 'predioController');
Route::get('/datosSelect', 'predioController@getDatosSelect')->name('predio.datosSelect');
Route::get('/contribuyentes/{e}', 'predioController@getContribuyentesPredio')->name('predio.datosContribuyentes');
Route::get('/datoPredioCont/{e}', 'predioController@getPredioContribuyentes')->name('predio.datosPredioCont');
Route::resource('/predio', 'predioController', ['except' => ['destroy', 'edit', 'show', 'create']]);
Route::get('/getContribuyente/{e}', 'predioController@getContribuyente')->name('predio.getContribuyente');
//------------------------------

// Rutas Notificador
Route::resource('/estado', 'EstadoCuentaController', [
    'except' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
])->middleware('auth');
Route::get('/obtener-estado', 'EstadoCuentaController@getEstado')->middleware('auth');
Route::get('/obtener-personal/{id}', 'EstadoCuentaController@getPersonal')->middleware('auth');

// Rutas alternas
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');
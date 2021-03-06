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
Route::get('/verUsuarios', 'personaController@getDatos');
Route::get('/verReporte/{id}', 'userController@getReporte');
//fin rutas administrador

//rutas para admin/predio-------
Route::resource('/getPredioList', 'predioController');
Route::get('/datosSelect', 'predioController@getDatosSelect')->name('predio.datosSelect');
Route::get('/contribuyentes/{e}', 'predioController@getContribuyentesPredio')->name('predio.datosContribuyentes');
Route::get('/datoPredioCont/{e}', 'predioController@getPredioContribuyentes')->name('predio.datosPredioCont');
Route::resource('/predio', 'predioController', ['except' => ['destroy', 'edit', 'show', 'create']]);
Route::get('/getContribuyente/{e}', 'predioController@getContribuyente')->name('predio.getContribuyente');

//Rutas de localidad
Route::get('/getLocalidad', 'predioController@getLocalidad')->name('predio.getLocalidad');
Route::post('/agregarOrUpdateLocalidad', 'predioController@storeLocalidad')->name('predio.storeLocalidad');
Route::get('/eliminarLocalidad/{id}', 'predioController@destroyLocalidad')->name('predio.destroyLocalidad');

//Rutas de conservacion
Route::get('/getConservacion', 'predioController@getConservacion')->name('predio.getConservacion');
Route::post('/agregarOrUpdateConservacion', 'predioController@storeConservacion')->name('predio.storeConservacion');
Route::get('/eliminarConservacion/{id}', 'predioController@destroyConservacion')->name('predio.destroyConservacion');

// Rutas para materiales
Route::resource('/material', 'MaterialController', ['except' => ['create', 'show', 'edit']])->middleware('auth');

// Rutas para sector
Route::resource('/sector', 'SectorController', ['except' => ['create', 'show', 'edit']])->middleware('auth');

// Rutas para Condicion de Propiedad
Route::resource('/condicion-propiedad', 'CondicionPropiedadController', ['except' => ['create', 'show', 'edit']])->middleware('auth');
Route::get('/getClasificacion', 'predioController@getClasificacion')->name('predio.getClasificacion');
Route::post('/agregarOrUpdateClasificacion', 'predioController@storeClasificacion')->name('predio.storeClasificacion');
Route::get('/eliminarClasificacion/{id}', 'predioController@destroyClasificacion')->name('predio.destroyClasificacion');
//------------------------------

// Rutas Notificador
Route::resource('/estado', 'EstadoCuentaController', [
    'except' => ['index', 'create', 'store', 'edit', 'update', 'destroy']
])->middleware('auth');
Route::get('/obtener-estado', 'EstadoCuentaController@getEstado')->middleware('auth');
Route::get('/obtener-personal/{id}', 'EstadoCuentaController@getPersonal')->middleware('auth');

// Rutas alternas
Route::get('{path}', 'HomeController@index')->where('path', '([A-z\d-\/_.]+)?');
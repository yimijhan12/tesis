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
});
Route::get('/inicio', function () {
    return view('gestion.inicio');
 });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/inicio', 'HomeController@index')->name('inicio');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::get('/fundos', 'FundoController@index');
Route::post('/fundos/registrar', 'FundoController@store');
Route::put('/fundos/actualizar', 'FundoController@update');
Route::put('/fundos/desactivar', 'FundoController@desactivar');
Route::put('/fundos/activar', 'FundoController@activar');
Route::get('/fundos/selectAlpaca', 'FundoController@selectAlpaca');




Route::get('/alpaca', 'AlpacaController@index');
Route::post('/alpaca/registrar', 'AlpacaController@store');
Route::put('/alpaca/actualizar', 'AlpacaController@update');
Route::put('/alpaca/desactivar', 'AlpacaController@desactivar');
Route::put('/alpaca/activar', 'AlpacaController@activar');





Route::get('/cliente', 'ClienteController@index');
Route::post('/cliente/registrar', 'ClienteController@store');
Route::put('/cliente/actualizar', 'ClienteController@update');
Route::post('/cliente/eliminar', 'ClienteController@eliminar');


Route::get('/pastor', 'PastorController@index');
Route::post('/pastor/registrar', 'PastorController@store');
Route::put('/pastor/actualizar', 'PastorController@update');

Route::get('/roles',function(){
	//$users = App\User::findOrFail(1);
//	return $users->roles;
	$rol  = App\Role::findOrFail(1);

	return $rol->users;
});

//Route::get('/alpaca/perfil', 'AlpacaController@perfil');
Route::get('/alpacaperfil', function () {
    return view('gestion.perfil');
 });
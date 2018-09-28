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

Route::get('/viandas', 'ViandasController@index')->name('viandas');
Route::get('/vianda', 'ViandasController@edit')->name('vianda');

Route::get('/personas', 'PersonasController@index')->name('personas');
Route::get('/persona', 'PersonasController@edit')->name('persona');

Route::get('/pedidos', 'PedidosController@index')->name('pedidos');
Route::get('/pedido', 'PedidosController@edit')->name('pedido');

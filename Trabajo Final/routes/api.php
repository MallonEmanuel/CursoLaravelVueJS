<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('viandas', 'Api\ViandaController');

// Route::post('viandas/{id}', 'Api\ViandaController@update');

Route::resource('personas', 'Api\PersonaController');

Route::get('personas/search/{nombre}/{apellido}/{email}', 'Api\PersonaController@search');

Route::resource('pedidos', 'Api\PedidoController');

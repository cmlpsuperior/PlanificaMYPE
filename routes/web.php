<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource ('cliente','ClienteController' );
Route::resource ('articulo','ArticuloController' );

Route::resource ('pedido','PedidoController' );
Route::post('pedido/buscarArticulos', 'PedidoController@buscarArticulos' ); //AJAX
Route::post('pedido/buscarClientes', 'PedidoController@buscarClientes' ); //AJAX
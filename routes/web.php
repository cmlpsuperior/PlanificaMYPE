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

//Route::resource ('pedido','PedidoController' );
Route::post('pedido', 'PedidoController@store' )->name('pedido.store');
Route::get('pedido', 'PedidoController@index' )->name('pedido.index');

Route::post('pedido/buscarArticulos', 'PedidoController@buscarArticulos' )->name('pedido.buscarArticulos'); //AJAX
Route::post('pedido/buscarClientes', 'PedidoController@buscarClientes' )->name('pedido.buscarClientes'); //AJAX
Route::get('pedido/buscarPedidos', 'PedidoController@buscarPedidos' )->name('pedido.buscarPedidos'); //AJAX

Route::get('pedido/confirmar', 'PedidoController@confirmar' )->name('pedido.confirmar');
Route::put('pedido/confirmar_update', 'PedidoController@confirmar_update' )->name('pedido.confirmar_update'); 

Route::get('pedido/create', 'PedidoController@create' )->name('pedido.create');
Route::get('pedido/{pedido}', 'PedidoController@show' )->name('pedido.show');
Route::put('pedido/{pedido}', 'PedidoController@update' )->name('pedido.update');
Route::delete('pedido/{pedido}', 'PedidoController@destroy' )->name('pedido.destroy');
Route::get('pedido/{pedido}/edit', 'PedidoController@edit' )->name('pedido.edit');

//Route::post('pedido/buscarArticulos', 'PedidoController@buscarArticulos' )->name('pedido.buscarArticulos'); 
//Route::post('pedido/buscarClientes', 'PedidoController@buscarClientes' )->name('pedido.buscarclientes'); //AJAX
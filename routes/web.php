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

Route::get('/', 'LoginController@index');
Route::resource ('cliente','ClienteController' );
Route::resource ('articulo','ArticuloController' );
Route::resource ('empleado','EmpleadoController' );

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


//planificacion:
Route::get('planificacion/seleccionarPedido', 'PlanificacionController@seleccionarPedido' )->name('planificacion.seleccionarPedido');
Route::post('planificacion/seleccionarPedido', 'PlanificacionController@seleccionarPedido_procesar' )->name('planificacion.seleccionarPedido_procesar');

Route::get('planificacion/{id}/pedidosCercanos', 'PlanificacionController@pedidosCercanos' )->name('planificacion.pedidosCercanos');
Route::post('planificacion/{id}/pedidosCercanos', 'PlanificacionController@pedidosCercanos_procesar' )->name('planificacion.pedidosCercanos_procesar');

Route::get('planificacion/{id}/vehiculosUtilizados', 'PlanificacionController@vehiculosUtilizados' )->name('planificacion.vehiculosUtilizados');
Route::post('planificacion/{id}/vehiculosUtilizados', 'PlanificacionController@vehiculosUtilizados_procesar' )->name('planificacion.vehiculosUtilizados_procesar');

Route::get('planificacion/{id}/viajes', 'PlanificacionController@viajes' )->name('planificacion.viajes');
Route::post('planificacion/{id}/viajes', 'PlanificacionController@viajes_procesar' )->name('planificacion.viajes_procesar');


//viaje:
Route::get('asignarViaje/seleccionarViaje', 'AsignarViajeController@seleccionarViaje' )->name('asignarViaje.seleccionarViaje');
Route::post('asignarViaje/seleccionarViaje', 'AsignarViajeController@seleccionarViaje_procesar' )->name('asignarViaje.seleccionarViaje_procesar');

Route::get('asignarViaje/{id}/seleccionarEmpleado', 'AsignarViajeController@seleccionarEmpleado' )->name('asignarViaje.seleccionarEmpleado');
Route::post('asignarViaje/{id}/seleccionarEmpleado', 'AsignarViajeController@seleccionarEmpleado_procesar' )->name('asignarViaje.seleccionarEmpleado_procesar');


//Login
Route::get('login', 'LoginController@index' )->name('login.index');
Route::post('login', 'LoginController@autenticar' )->name('login.autenticar');
Route::get('login/logout', 'LoginController@logout' )->name('login.logout');


//viaje
Route::get('envio/seleccionarViaje', 'EnvioController@seleccionarViaje' )->name('envio.seleccionarViaje');
Route::post('envio/seleccionarViaje', 'EnvioController@seleccionarViaje_procesar' )->name('envio.seleccionarViaje_procesar');

	//Seleccionar Vehiculo
	Route::get('envio/{id}/seleccionarVehiculo', 'EnvioController@seleccionarVehiculo' )->name('envio.seleccionarVehiculo');
	Route::post('envio/{id}/seleccionarVehiculo', 'EnvioController@seleccionarVehiculo_procesar' )->name('envio.seleccionarVehiculo_procesar');

	//Llegada a almacen
	Route::get('envio/{id}/llegadaAlmacen', 'EnvioController@llegadaAlmacen' )->name('envio.llegadaAlmacen');
	Route::post('envio/{id}/llegadaAlmacen', 'EnvioController@llegadaAlmacen_procesar' )->name('envio.llegadaAlmacen_procesar');

	//Seleccionamos los pedidos
	Route::get('envio/{id}/seleccionarDestino', 'EnvioController@seleccionarDestino' )->name('envio.seleccionarDestino');

		Route::get('envio/{id}/{idPedido}/buscarCliente', 'EnvioController@buscarCliente' )->name('envio.buscarCliente');
		Route::post('envio/{id}/{idPedido}/buscarCliente', 'EnvioController@buscarCliente_procesar' )->name('envio.buscarCliente_procesar');

		Route::get('envio/{id}/{idPedido}/entregarMateriales', 'EnvioController@entregarMateriales' )->name('envio.entregarMateriales');
		Route::post('envio/{id}/{idPedido}/entregarMateriales', 'EnvioController@entregarMateriales_procesar' )->name('envio.entregarMateriales_procesar');


	Route::get('envio/{id}/seleccionarDestino_procesar', 'EnvioController@seleccionarDestino_procesar' )->name('envio.seleccionarDestino_procesar');

	//retornar a la empresa
	Route::get('envio/{id}/regresarEmpresa', 'EnvioController@regresarEmpresa' )->name('envio.regresarEmpresa');
	Route::post('envio/{id}/regresarEmpresa', 'EnvioController@regresarEmpresa_procesar' )->name('envio.regresarEmpresa_procesar');



//Control
Route::get('control', 'ControlController@monitorearPedidos' )->name('envio.monitorearPedidos');
Route::post('control', 'ControlController@monitorearPedidos_procesar' )->name('envio.monitorearPedidos_procesar');

Route::get('control/{id}/verMateriales', 'ControlController@verMateriales' )->name('envio.verMateriales');
Route::get('control/{id}/verViajes', 'ControlController@verViajes' )->name('envio.verViajes');



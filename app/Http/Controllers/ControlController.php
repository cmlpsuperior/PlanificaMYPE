<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

class ControlController extends Controller
{
    public function monitorearPedidos (){
    	$pedidos = Pedido::where('estado', '<>', 'Finalizado')->get();

    	return view('control.monitorearPedidos', ['pedidos'=>$pedidos]);
    }
}

<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

use PlanificaMYPE\Pedido;
use DB;
use PlanificaMYPE\Viaje;

class ControlController extends Controller
{
    public function monitorearPedidos (){
    	$hoy = date("Y-m-d") ;
    	$hoyHora= $hoy.' '.'23:59:59';

    	$hoyHoraInicio = $hoy.' '.'00:00:00';
    
    	$pedidosPendientes = Pedido::where('estado', '<>', 'Finalizado')
    								->where('fechaEnvio', '<=', $hoyHora)
    								->get();

    	$pedidosFinalizados = Pedido::where('estado', '=', 'Finalizado')
    								->where('fechaEnvio', '<=', $hoyHora)
    								->where('fechaEnvio', '>=', $hoyHoraInicio)
    								->get();

    	return view('control.monitorearPedidos', ['pedidosPendientes'=>$pedidosPendientes, 'pedidosFinalizados'=>$pedidosFinalizados]);
    }

    public function verMateriales (){

    }

    public function verViajes ($id){

        $detallesViajes = DB::table('detalleviaje')->select('idViaje')->distinct()->where('idPedido','=', $id)->get();
        
        $viajes= array();
        foreach ($detallesViajes as $detalleviaje){
            $viajes[] = Viaje::findOrFail($detalleviaje->idViaje);
        }        

        return view('control.monitorearViajes', [ 'viajes'=>$viajes, 'idPedido'=>$id ]);
    }
}

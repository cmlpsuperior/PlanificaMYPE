<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;
use Illuminate\Pagination\Paginator;
use PlanificaMYPE\Viaje;
use PlanificaMYPE\Empleado;
use PlanificaMYPE\Pedido;
use PlanificaMYPE\Articulo;
use PlanificaMYPE\Vehiculo;
use DB;
use Illuminate\Support\Facades\Auth;

use PlanificaMYPE\Http\Requests\SeleccionarViajeRequest;
use PlanificaMYPE\Http\Requests\CargarMaterialesRequest;

class EnvioController extends Controller
{    
    public function seleccionarViaje(){ //Request $request
    	
    	$empleado = Auth::User()->empleado;
    	$viajes = Viaje::where('idEmpleado','=',$empleado->idEmpleado)
    				->where('estado','=', 'Asignado')
    				->orderBy('fechaRegistro', 'asc')
                    ->simplePaginate(8);

        $viajesPlus = array();
        foreach ($viajes as $viaje ){
            $detalleViaje = DB::table('detalleviaje')->select('idPedido')->where('idViaje','=', $viaje->idViaje)->first();
            $nViaje['zona'] =  Pedido::findOrFail($detalleViaje->idPedido)->zona;
            $nViaje['viaje'] = $viaje;
            $nViaje['cantidadDestinos'] = count (   DB::table('detalleviaje')->distinct()->select('idPedido')->where('idViaje','=', $viaje->idViaje)   );
                
            $viajesPlus []= $nViaje;                
        }
        $pViajesPlus = new Paginator ($viajesPlus, 8);
        

        return view('envio.seleccionarViaje', ['viajes'=>$pViajesPlus]);

    }

    public function seleccionarViaje_procesar (SeleccionarViajeRequest $request){

    	$idViaje = $request->get('seleccionarViaje');   

    	return redirect()->action('EnvioController@cargarMateriales', ['id' => $idViaje] ); 
    }

    public function cargarMateriales ($id){
        $viaje= Viaje::findOrFail($id);

        //actualizamos la hora de salida y su estado:
        $viaje->estado='Enviando';
        $viaje->fechaSalida = date("Y-m-d H:i:s");
        $viaje->save();

    	$detallesViajes = DB::table('detalleviaje') //obtengo los idArticulos y sus cantidades, sin importar a quien va.
                     ->select(DB::raw('idArticulo, sum(cantidad) as cantidadTotal'))
                     ->where('idViaje', '=', $id)
                     ->groupBy('idArticulo')
                     ->get();
       	$detallesPlus = array();
        foreach ($detallesViajes as $detalleViaje){
        	$nArticulo['articulo'] = Articulo::findOrFail($detalleViaje->idArticulo);
        	$nArticulo['cantidad'] = $detalleViaje->cantidadTotal;

        	$detallePlus[] = $nArticulo;
        }

        //obtenemos los vehiculos:
        $vehiculos = Vehiculo::where('idTipoVehiculo','=', $viaje->idTipoVehiculo )->get();
       
    	return view('envio.cargarMateriales', ['articulos'=>$detallePlus, 'viaje'=> $viaje, 'vehiculos'=> $vehiculos]);  
        
    }

    public function cargarMateriales_procesar (CargarMaterialesRequest $request, $id){
        $viaje= Viaje::findOrFail($id);

        //actualizamos la   su estado:
        $viaje->estado='En almacén';
        $viaje->idVehiculo = $request->get ('idVehiculo');
        $viaje->save();

        return redirect()->action('EnvioController@seleccionarDestino', ['id' => $id] ); 
        //return redirect()->action('EnvioController@destinos', ['id' => $idViaje] ); 
    }


    public function seleccionarDestino ($id){
        $viaje= Viaje::findOrFail($id);
      
        $detallesViajes = DB::table('detalleviaje') //obtengo los idArticulos y sus cantidades, sin importar a quien va.
                     ->select('idPedido')
                     ->distinct()
                     ->where('idViaje', '=', $id)
                     ->get();

        $pedidos = array();
        foreach ($detallesViajes as $detalleViaje){
            $pedidos[] = Pedido::findOrFail($detalleViaje->idPedido);
        }
        
        return view('envio.seleccionarDestino', ['pedidos'=>$pedidos, 'viaje'=> $viaje]); 
    }


    public function entregarMateriales ($idViaje, $idPedido){
        $pedido = Pedido::findOrFail($idPedido);
        $viaje = Viaje::findOrFail($idViaje);

        $detallesViajes = DB::table('detalleviaje') //obtengo los idArticulos y sus cantidades, sin importar a quien va.                    
                     ->where('idViaje', '=', $idViaje)
                     ->where('idPedido', '=', $idPedido)
                     ->get();

        $articulosPlus = array();
        foreach ($detallesViajes as $detalleViaje){
            $articulo['articulo'] = Articulo::findOrFail($detalleViaje->idArticulo);
            $articulo['cantidad'] = $detalleViaje->cantidad;

            $articulosPlus[] = $articulo;
        }

        return view('envio.entregarMateriales', ['articulos'=>$articulosPlus, 'viaje'=> $viaje, 'pedido' =>$pedido]); 
    }
  


}

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
use PlanificaMYPE\Http\Requests\SeleccionarVehiculoRequest;
use PlanificaMYPE\Http\Requests\LlegadaAlmacenRequest;
use PlanificaMYPE\Http\Requests\BuscarClienteRequest;
use PlanificaMYPE\Http\Requests\EntregarMaterialesRequest;

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

    	return redirect()->action('EnvioController@seleccionarVehiculo', ['id' => $idViaje] ); 
    }

    public function seleccionarVehiculo ($id){
        $viaje= Viaje::findOrFail($id);

        //obtenemos los vehiculos:
        $vehiculos = Vehiculo::where('idTipoVehiculo','=', $viaje->idTipoVehiculo )->get();
          

        return view('envio.seleccionarVehiculo', ['vehiculos' => $vehiculos, 'viaje'=> $viaje] ); 
    }

    public function seleccionarVehiculo_procesar (SeleccionarVehiculoRequest $request, $id){
        $idVehiculo = $request->get('idVehiculo');

        $viaje= Viaje::findOrFail($id);
        $viaje->idVehiculo = $idVehiculo;
        $viaje->fechaSalida = date("Y-m-d H:i:s");
        $viaje->estado='Enviando';
        $viaje->save();

        return redirect()->action('EnvioController@llegadaAlmacen', ['id' => $id] ); 

    }

    public function llegadaAlmacen ($id){
        $viaje= Viaje::findOrFail($id);

        //obtengo los idArticulos y sus cantidades, sin importar a quien va.
        $detallesViajes = DB::table('detalleviaje') 
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
       
        return view('envio.llegadaAlmacen', ['articulos'=>$detallePlus, 'viaje'=> $viaje]); 

    }

    public function llegadaAlmacen_procesar (LlegadaAlmacenRequest $request, $id){
        
        $viaje= Viaje::findOrFail($id);
        $viaje->estado='En almacen';
        $viaje->save();

        return redirect()->action('EnvioController@seleccionarDestino', ['id' => $id] ); 

    }



    public function seleccionarDestino ($id){
        $viaje= Viaje::findOrFail($id); 
        
        /*
        $detallesViajes = DB::table('detalleviaje')
                     ->select('idPedido')
                     ->distinct()
                     ->where('idViaje', '=', $id)
                     ->get();

        $pedidos = array();
        foreach ($detallesViajes as $detalleViaje){
            $pedidos[] = Pedido::findOrFail($detalleViaje->idPedido);
        }
        */
        $pedidos = $viaje->pedidos;
        //dd($pedidos[0]->pivot);
        
        return view('envio.seleccionarDestino', ['pedidos'=>$pedidos, 'viaje'=> $viaje]); 
    }

    public function buscarCliente ($idViaje, $idPedido){

        $pedido = Pedido::findOrFail($idPedido);
        $viaje= Viaje::findOrFail($idViaje);

        return view('envio.buscarCliente', [ 'pedido' => $pedido, 'viaje' => $viaje]); 
    }

    public function buscarCliente_procesar (BuscarClienteRequest $request, $idViaje, $idPedido){

        DB::beginTransaction();
            $viaje= Viaje::findOrFail($idViaje);
            $viaje->estado ='En el cliente';
            $viaje->save();

            //actualizo la tabla pedidoxviaje
            $viaje->pedidos()->updateExistingPivot($idPedido, ['fechaUbicado'=>date("Y-m-d H:i:s")]);
        DB::commit();

        return redirect()->action('EnvioController@entregarMateriales', ['id' => $idViaje, 'idPedido' => $idPedido] ); 
    }

    public function entregarMateriales ($idViaje, $idPedido){
        $pedido = Pedido::findOrFail($idPedido);
        $viaje = Viaje::findOrFail($idViaje);

        $detallesViajes = DB::table('detalleviaje')                     
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

    public function entregarMateriales_procesar (EntregarMaterialesRequest $request, $idViaje, $idPedido){
        $montoCobrado = $request->get('cobrado');

        $cantidadesDescargados = $request->get('cantidadesDescargados');
        $idArticulos = $request->get('idArticulos');

        DB::beginTransaction();

            //actualizamos el estado del viaje
            $viaje = Viaje::findOrFail($idViaje);
            $viaje->estado = 'Continuando';
            $viaje->save();

            //actualizo la tabla pedidoxviaje
            $viaje->pedidos()->updateExistingPivot($idPedido, ['fechaEntrega'=>date("Y-m-d H:i:s"),
                                                                'montoCobrado'=> $montoCobrado]
                                                    );


            foreach($cantidadesDescargados as $key=>$cantidadDescargado){
                //ahora actualizamos el monto descargado en detalleviaje:
                DB::table('detalleviaje')
                    ->where('idViaje', $idViaje)
                    ->where('idPedido', $idPedido)
                    ->where('idArticulo', $idArticulos[$key])
                    ->update(['cantidadDescargado' => $cantidadDescargado ]);


                //ahora sumamos lo descargado en detallepedido:
                $detallePedido= DB::table('detallepedido')->select('cantidadAtendida')
                    ->where('idPedido', $idPedido)
                    ->where('idArticulo', $idArticulos[$key])
                    ->first();

                $nuevaCantidad = $detallePedido->cantidadAtendida + $cantidadDescargado;
                $pedido = Pedido::findOrFail($idPedido);
                $pedido->articulos()->updateExistingPivot($idArticulos[$key], ['cantidadAtendida'=> $nuevaCantidad]);
            }

        DB::commit();

        return redirect()->action('EnvioController@seleccionarDestino', ['id' => $idViaje] ); 

    }
  


}

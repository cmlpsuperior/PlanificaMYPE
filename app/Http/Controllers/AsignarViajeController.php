<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

use PlanificaMYPE\Viaje;
use PlanificaMYPE\Empleado;
use PlanificaMYPE\Pedido;
use DB;
use PlanificaMYPE\Http\Requests\SeleccionarViajeRequest;
use PlanificaMYPE\Http\Requests\SeleccionarEmpleadoRequest;
use Illuminate\Pagination\Paginator;

class AsignarViajeController extends Controller
{
    public function __construct (){

    }

    public function seleccionarViaje(){ //Request $request
        
    		$viajes = Viaje::orderBy('fechaRegistro', 'asc')
                        ->where('estado','=', 'Planificado')
                        ->get();
                       

            $viajesPlus = array();
            foreach ($viajes as $viaje ){
                $detalleViaje = DB::table('detalleviaje')->select('idPedido')->where('idViaje','=', $viaje->idViaje)->first();
                $nViaje['zona'] =  Pedido::findOrFail($detalleViaje->idPedido)->zona;
                $nViaje['viaje'] = $viaje;
                $nViaje['cantidadDestinos'] = count (   DB::table('detalleviaje')->distinct()->select('idPedido')->where('idViaje','=', $viaje->idViaje)   );
                
                $viajesPlus []= $nViaje;                
            }
            $pViajesPlus = new Paginator ($viajesPlus, 8);
            
            
            return view('asignarViaje.seleccionarViaje', ['viajes'=>$pViajesPlus]);    	           

    }

    public function seleccionarViaje_procesar(SeleccionarViajeRequest $request ){

        $idViaje = $request->get('seleccionarViaje');
        return redirect()->action('AsignarViajeController@seleccionarEmpleado', ['id' => $idViaje] );   	           

    }

    public function seleccionarEmpleado ($id){
        $empleados = Empleado::orderBy('apellidoPaterno', 'asc')
                            ->simplePaginate(8); 

        return view('asignarViaje.seleccionarEmpleado', ['empleados'=>$empleados, 'idViaje'=>$id]);   

    }

    public function seleccionarEmpleado_procesar (SeleccionarEmpleadoRequest $request , $id){
        $idEmpleado = $request->get('seleccionarEmpleado');

        //actualizamos el estado del viaje
        $viaje = Viaje::findOrFail($id);
        $viaje->idEmpleado = $idEmpleado;
        $viaje->estado = 'Asignado';
        $viaje->save();

        //actualizamos el estado del o los pedidos del viaje:
        $detallesViajes = DB::table('detalleviaje')
                        ->distinct()
                        ->select ( 'idPedido')
                        ->where ('idViaje', '=', $viaje->idViaje)
                        ->get();
        
        foreach ($detallesViajes as $detalleViaje){
            $pedido = Pedido::findOrFail($detalleViaje->idPedido);            
            $pedido->estado = 'En proceso';
            $pedido->save();
        }

        return redirect()->action('AsignarViajeController@seleccionarViaje' ); 

    }
}

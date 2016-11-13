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


class AsignarViajeController extends Controller
{
    public function __construct (){

    }

    public function seleccionarViaje(){ //Request $request
        
    		$viajes = Viaje::orderBy('fechaRegistro', 'asc')
                        ->where('estado','=', 'Planificado')
                        //->get();
                        ->simplePaginate(8); 

            return view('asignarViaje.seleccionarViaje', ['viajes'=>$viajes]);    	           

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

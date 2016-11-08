<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;
use PlanificaMYPE\Pedido;
use PlanificaMYPE\TipoVehiculo;
use PlanificaMYPE\Http\Requests\SeleccionarPedidoRequest;
use PlanificaMYPE\Http\Requests\VehiculosUtilizadosRequest;
use Illuminate\Http\RedirectResponse; //para el redirect

class PlanificacionController extends Controller
{
    public function seleccionarPedido (){
    	//muestro los pedidos hasta con dos dias de rezado
    	$pedidos= Pedido::where('estado', '=', 'Confirmado' )
    				->orWhere('estado', '=', 'Pedido pendiente' )
    				->orderBy('fechaEnvio','asc')
    				->simplePaginate(8);
    	
    	return view('planificacion.seleccionarPedido', ['pedidos'=>$pedidos]); 
    }

    public function seleccionarPedido_procesar (SeleccionarPedidoRequest $request){
        $idPedido = $request->get('selecionarPedido');
        
        return redirect()->action('PlanificacionController@pedidosCercanos', ['id' => $idPedido] );        
    }



    public function pedidosCercanos ($id){
    	
		$pedidoPrincipal = Pedido::findOrFail($id);
        //asegurarme que no estan entrando por el url
        if ($pedidoPrincipal->estado != 'Confirmado' && $pedidoPrincipal->estado != 'Pedido pendiente' ){ 
            return redirect()->action('PlanificacionController@seleccionarPedido' )->withErrors ('Debe selecionar un pedido válido'); 
        }
        else {
    		$pedidosCercanos = Pedido::where ('idzona', '=', $pedidoPrincipal->idZona)
    							->where ('idPedido','<>', $pedidoPrincipal->idPedido)
                                ->where('estado', '=', 'Confirmado' )
                                ->orWhere('estado', '=', 'Pedido pendiente' )
    							->get();

    		return view('planificacion.pedidosCercanos', ['pedidoPrincipal'=>$pedidoPrincipal, 'pedidosCercanos'=> $pedidosCercanos]);  
        }     	
    }

    public function pedidosCercanos_procesar (Request $request, $id){

        $pedidoPrincipal = Pedido::findOrFail($id);

        $idPedidosCercanos=[];
        if ( $request->has('idPedidosCercanos') ){
            $idPedidosCercanos = $request->get('idPedidosCercanos');
        }        
        
        //lo almaceno en la session por ahora:
        session(['idPedidosCercanos' => $idPedidosCercanos]);

        return redirect()->action('PlanificacionController@vehiculosUtilizados', ['id' => $id] );    
        //return view('planificacion.vehiculosUtilizados', ['pedidoPrincipal'=>$pedidoPrincipal, 'idPedidosCercanos'=> $idPedidosCercanos]); 
    }



    public function vehiculosUtilizados ($id){
    	
        $pedidoPrincipal = Pedido::findOrFail($id);

        if ($pedidoPrincipal->estado != 'Confirmado' && $pedidoPrincipal->estado != 'Pedido pendiente' ){ 
            return redirect()->action('PlanificacionController@seleccionarPedido' )->withErrors ('Debe selecionar un pedido válido'); 
        }
        else {            

            $tiposVehiculos = TipoVehiculo::all();

            return view('planificacion.vehiculosUtilizados', ['pedidoPrincipal'=>$pedidoPrincipal, 'tiposVehiculos'=> $tiposVehiculos]);

        }
        
    }

    public function vehiculosUtilizados_procesar (VehiculosUtilizadosRequest $request, $id){
        
        //$pedidoPrincipal = Pedido::findOrFail($id);       
        $idTiposVehiculos = $request->get('idTiposVehiculos');            
        session(['idTiposVehiculos' => $idTiposVehiculos]);

        return redirect()->action('PlanificacionController@viajes', ['id' => $id] );
    }


    //aqui se ejecuta el algoritmo :)
    public function viajes ($id){ 

        //verificamos que existan las dos variables nesesarias:
        if (session()->has('idTiposVehiculos') && session()->has('idPedidosCercanos') ){
            $idPedidosCercanos = session('idPedidosCercanos');
            $idTiposVehiculos = session('idTiposVehiculos');

            //obtengo todos los pedidos cercanos
            $pedidoPrincipal = Pedido::findOrFail($id);
            $pedidosCercanos= Pedido::whereIn ('idPedido', $idPedidosCercanos )->get();
            $tiposVehiculos= TipoVehiculo::whereIn ('idTipoVehiculo', $idTiposVehiculos )->get();

            $viajes = generarViajes($pedidoPrincipal, $pedidosCercanos, $tiposVehiculos);

            return view('planificacion.viajes', ['pedidoPrincipal'=>$pedidoPrincipal, 'tiposVehiculos'=> $tiposVehiculos, 'pedidosCercanos'=> $pedidosCercanos, 'viajes'=>$viajes]);
            /*
            //borramos los valores de la session
            session()->forget('idPedidosCercanos');
            session()->forget('idTiposVehiculos');
            */            
        }
        else{
            //sino, vuelve al inicio del flujo
            return redirect()->action('PlanificacionController@seleccionarPedido' )->withErrors ('Debe selecionar un pedido válido'); 
        }
        //return 'cercanos: '. var_dump(session('idPedidosCercanos')). '. tipos de vehiculos: '. session('idTiposVehiculos');
      
    }


    //que comienze el juego:
    public function generarViajes ($pedidoPrincipal, $pedidosCercanos, $tiposVehiculos){
        /*Primer paso: solucion inicial: */
        $vehiculoMasGrande = obtenerVehiculoMasGrande ($tiposVehiculos);
        $listaVehiculos =    distribuirPedidoEnVehiculoMasGrande ($pedidoPrincipal, $vehiculoMasGrande);

        /*Segundo paso: usar vehiculos mas pequeños*/
        $tiposVehiculosOrdenados = ordenarMayorAMenorListaVehiculosDisponibles ($tiposVehiculos);
        $listaFinalVehiculos = cambiarAVehiculosMasPequenios ($listaVehiculos, $tiposVehiculosOrdenados);

        /*Tercer paso: Agregar otros pedidos a los vehiculos*/
        $viajes= agregarOtrosPedidos ($listaFinalVehiculos, $pedidosCercanos);

        return $viajes;

    }

    public function obtenerVehiculoMasGrande ($tiposVehiculos){
        //analizamos la carga normal: ya que de eso depende el tamaño de la camioneta:
        $volumenMaximo=0;
        $iMaximo= 0; //ningun id
        $tamanoArreglo = count($tiposVehiculos);
        for ($i=0; $i< $tamanoArreglo; $i++){
            $unTipo = $tiposVehiculos[$id];
            $cargaNormal = $unTipo->cargas[0]->pivot->volumen; //la carga 0 es del tipo nomral
            if ($cargaNormal>=$volumenMaximo){
                $volumenMaximo = $cargaNormal;
                $iMaximo= $i;
            }
        }

        return $tiposVehiculos[$iMaximo];
    }
}

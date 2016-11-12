<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;
use PlanificaMYPE\Pedido;
use PlanificaMYPE\TipoVehiculo;
use PlanificaMYPE\TipoCarga;
use PlanificaMYPE\Http\Requests\SeleccionarPedidoRequest;
use PlanificaMYPE\Http\Requests\VehiculosUtilizadosRequest;
use Illuminate\Http\RedirectResponse; //para el redirect
use DB;

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




    

    public function viajes ($id){ 

        //verificamos que existan las dos variables nesesarias:
        if (session()->has('idTiposVehiculos') && session()->has('idPedidosCercanos') ){
            $idPedidosCercanos = session('idPedidosCercanos');
            $idTiposVehiculos = session('idTiposVehiculos');

            //obtengo los datos que nesesito procesar
            $pedidoPrincipal = Pedido::findOrFail($id);
            $pedidosCercanos= Pedido::whereIn ('idPedido', $idPedidosCercanos )->get();          
            $contenedoresDisponibles= $this->obtenerTodosContenedores($idTiposVehiculos); //los contenedores que utilizare.
            
            //llamo al algoritmo
            $viajes = $this->generarViajes($pedidoPrincipal, $pedidosCercanos, $contenedoresDisponibles);

            /*
            dd($viajes);
            //return $viajes->nombre. ' carga: '. $viajes->tiposCargas[0]->pivot->volumen.' Carga pequeña: '.$viajes->tiposCargas[1]->pivot->volumen. ' Crga aerea '. $viajes->tiposCargas[2]->pivot->cantidad ;
            //return view('planificacion.viajes', ['pedidoPrincipal'=>$pedidoPrincipal, 'tiposVehiculos'=> $tiposVehiculos, 'pedidosCercanos'=> $pedidosCercanos, 'viajes'=>$viajes]);
            
            //borramos los valores de la session
            session()->forget('idPedidosCercanos');
            session()->forget('idTiposVehiculos');
          
            print_r($viajes) ;
            foreach ($viajes as $key => $viaje){
                echo $key.' :<br>';
                
                echo 'Capacidad maxima : '.$viaje['maximo'].' <br>'; 
                echo 'ocupado : '.$viaje['ocupado'].' <br>';
                echo 'disponible : '.$viaje['disponible'].' <br>';
                
            }
            */       
        }
        else{
            //sino, vuelve al inicio del flujo
            return redirect()->action('PlanificacionController@seleccionarPedido' )->withErrors ('Debe selecionar un pedido válido'); 
        }
        //return 'cercanos: '. var_dump(session('idPedidosCercanos')). '. tipos de vehiculos: '. session('idTiposVehiculos');
      
    }

    /*Ordena de mayor a menor los contenedores, con sus capacidades. FUNCIONANDO*/
    public function obtenerTodosContenedores ($idTiposVehiculos){
        $contenedores = array();
        
        //obtengo los tipos de vehiculos existentes y los ordeno de grande a pequeño.
        $tipoVehiculosOrdenados = DB::table('tipoVehiculoxtipocarga')
                                    ->whereIn('idTipoVehiculo', $idTiposVehiculos)
                                    ->where('idTipoCarga','=',1) //solo veo el 1 que el la carga normal
                                    ->orderBy('volumen', 'desc')
                                    ->get(); 

        $tipoCargaTotal = TipoCarga::orderBy('idTipoCarga', 'asc')->get();

        foreach ($tipoVehiculosOrdenados as $tipoVehiculo) {
            $contenedor = array();
            $contenedor['idTipoVehiculo']= $tipoVehiculo->idTipoVehiculo;
            $contenedor['articulos']= array();
            $contenedor['cargas']= array();

            foreach($tipoCargaTotal as $tipoCarga){ //podriamos hacerlo por busqueda en el mismo php, y que no vaya al BD
                $cargaVehiculo = DB::table('tipoVehiculoxtipocarga')
                                            ->where('idTipoCarga','=',$tipoCarga->idTipoCarga)
                                            ->where('idTipoVehiculo','=',$tipoVehiculo->idTipoVehiculo)
                                            ->get(); //solo veo el 1 que el la carga normal

                if ( $cargaVehiculo->isEmpty() )  // no tiene carga asiganda en la base de datos.
                    $contenedor['cargas'][$tipoCarga->idTipoCarga] = array( "maximo"=>0, 
                                                            "ocupado"=>0,
                                                            "disponible"=>0,
                                                            "haynocombinable" => 0
                                                            );            
                else {
                    //dd($cargaVehiculo);
                    $contenedor['cargas'][$tipoCarga->idTipoCarga] = array( "maximo"=>$cargaVehiculo[0]->volumen, //se le pone [0] ya que la consulta query devulve arreglo, y yo solo queiro el primero
                                                            "ocupado"=>0,
                                                            "disponible"=>$cargaVehiculo[0]->volumen,
                                                            "haynocombinable" => 0
                                                            ); 

                }
            }

            $contendores[] = $contenedor;       
            
        }

        return $contendores;
    }


    public function generarViajes ($pedidoPrincipal, $pedidosCercanos, $maestraContenedores){

        /*Primer paso: solucion inicial: */
        $contenedorMasGrande = $maestraContenedores[0]; //como esta ordenado de mayor a menor, el mayor es el primero
        $contenedoresUtilizados = $this->distribuirPedidoEnContenedorMasGrande ($pedidoPrincipal, $contenedorMasGrande);
                
        /*Segundo paso: usar vehiculos mas pequeños*/
        $this->cambiarAVehiculosMasPequenios ($contenedoresUtilizados, $maestraContenedores);

        /*Tercer paso: Agregar otros pedidos a los vehiculos*/
        $viajes= agregarOtrosPedidos ($contenedoresUtilizados, $pedidosCercanos);

        //return $viajes;
        
        return $contenedoresUtilizados;

    }


    /**PARTE2 **/
    public function cambiarAVehiculosMasPequenios (&$contenedoresUtilizados, $maestraContenedores){
        foreach ($contenedoresUtilizados as &$contenedorUtilizado){

            $contenedorMenor = $this->buscarMenorContenedor($contenedorUtilizado, $maestraContenedores);
            if ( empty($contenedorMenor) ){ // no encotro ningun contenedor, esto no deberia pasar
                //nada
            }
            else{
                $contenedorUtilizado['cargas']= $contenedorMenor['cargas']; //actualizo las cargas
                $contenedorUtilizado['idTipoVehiculo']= $contenedorMenor['idTipoVehiculo']; //cambio el tipo de contenedor

            }

        }
    }

    public function buscarMenorContenedor ($contenedorUtilizado, $maestraContenedores){
        $contenedorMenor = array(); 

        foreach ($maestraContenedores as $contenedorMaestro){
            $cargasMenor = array();
            foreach($contenedorUtilizado['cargas'] as $key => $carga){
                

                if ($carga['ocupado'] > $contenedorMaestro['cargas'][$key]['maximo']){
                    return $contenedorMenor; //como esta de mayor a menor, si este contenedor es uy pequeño, entonces los que restan tambien.
                }
                else{
                    $cargasMenor[$key]['maximo']= $contenedorMaestro['cargas'][$key]['maximo'];
                    $cargasMenor[$key]['ocupado']= $carga['ocupado'];
                    
                    $cargasMenor[$key]['disponible']= $cargasMenor[$key]['maximo'] - $cargasMenor[$key]['ocupado'];
                    $cargasMenor[$key]['haynocombinable']= $carga['haynocombinable'];


                }
            }

            $contenedorMenor['cargas']= $cargasMenor;            
            $contenedorMenor['idTipoVehiculo']= $contenedorMaestro['idTipoVehiculo'];
            
        }

        return $contenedorMenor;
    }
    /**fin parte 2**/
 
    /**PARTE1 **/
    public function distribuirPedidoEnContenedorMasGrande ($pedidoPrincipal, $contenedorMasGrande){ 

        $contenedoresUtilizados[0] = $contenedorMasGrande;  //hago una copia de un contenedor y lo meto en mi lista   
        
        $valor=-1;
        foreach ($pedidoPrincipal->articulos as $articulo ){  
            $valor= $this->insertarAContenedores($contenedoresUtilizados, $articulo, $contenedorMasGrande, $pedidoPrincipal->idPedido); 
        }
        //dd($valor);
        return $contenedoresUtilizados;
    }

    public function insertarAContenedores(&$contenedoresUtilizados, $articulo, $contenedorMasGrande, $idPedido){
        $arIdArticulo = $articulo->idArticulo;
        $arIdTipoCarga = $articulo->idTipoCarga;
        $arMinimoDivisible = $articulo->minimoDivisible; //cantidad
        $arCombinable = $articulo->combinable; //1: si        0: no;

        $arCantidad = round($articulo->pivot->cantidad, 2); // redondeo a 2 decimales
        $arVolumen = $articulo->pivot->cantidad * $articulo->volumen;
        
        //1: vemos si entra de manera completa
        for ($i=0; $i<count($contenedoresUtilizados); $i++ ){
            $contenedor = &$contenedoresUtilizados[$i];
            $cargas = &$contenedoresUtilizados[$i]['cargas'];

            if ($arCombinable ==0 && $cargas[$arIdTipoCarga]['haynocombinable']==1 ){ // es un articulo no combinable, y ya hay en el contenedor un no combinable
                continue; // no puede ingresar 
            }
            else{
                if ($cargas[$arIdTipoCarga]['disponible']>= $arVolumen ){ // sí cabe
                    
                    $cargas[$arIdTipoCarga]['disponible'] = $cargas[$arIdTipoCarga]['disponible'] - $arVolumen;
                    $cargas[$arIdTipoCarga]['ocupado'] = $cargas[$arIdTipoCarga]['ocupado'] + $arVolumen;

                    $contenedor['articulos'][]= array('idArticulo'=>$arIdArticulo, 'idPedido'=> $idPedido, 'cantidad'=> $arCantidad);
                    if ($arCombinable == 0) //el articulo no es combinable
                        $cargas[$arIdTipoCarga]['haynocombinable']=1; //indico que ahora ya tiene un no combinable;

                    return 1; //1: todo ok, salgo de la funcion. se llego a ingresar por completo el articulo en un contenedor;

                }
                

            }


        }

        //si llego aqui, es porque no cabe el articulo completamnete en algun contenedor:
        //2: intentamos ingresarlo por partes:
        $VolumenMinimoDivisible = $arMinimoDivisible * $articulo->volumen;  

        for ($i=0; $i<count($contenedoresUtilizados); $i++ ){
            $contenedor = &$contenedoresUtilizados[$i];
            $cargas = &$contenedoresUtilizados[$i]['cargas'];

            $arVolumen = $arCantidad * $articulo->volumen;

            if ($arCombinable ==0 && $cargas[$arIdTipoCarga]['haynocombinable']==1 ){ // es un articulo no combinable, y ya hay en el contenedor un no combinable
                continue; // no puede ingresar 
            }
            else{
                if ($cargas[$arIdTipoCarga]['disponible']>= $arVolumen ){ //la primera iteracion nunca entrara aca, pero las que siguen quisas si

                    $cargas[$arIdTipoCarga]['disponible'] = $cargas[$arIdTipoCarga]['disponible'] - $arVolumen;
                    $cargas[$arIdTipoCarga]['ocupado'] = $cargas[$arIdTipoCarga]['ocupado'] + $arVolumen;

                    $contenedor['articulos'][]= array('idArticulo'=>$arIdArticulo, 'idPedido'=> $idPedido, 'cantidad'=> $arCantidad);
                    if ($arCombinable == 0) //el articulo no es combinable
                        $cargas[$arIdTipoCarga]['haynocombinable']=1; //indico que ahora ya tiene un no combinable;

                    return 2; //se llego a ingresar por completo, salgo de la funcion

                }
                else if ($cargas[$arIdTipoCarga]['disponible'] >= $VolumenMinimoDivisible){ //almenos puede entrar uno

                    $vecesMinimoPosible =  floor( $cargas[$arIdTipoCarga]['disponible'] / $VolumenMinimoDivisible ); //redondeado hacia abajo, nunca sera 0;
                    $cantidadPosible = round ($vecesMinimoPosible* $arMinimoDivisible, 2);

                    //actualizo la cantidad del articulo:
                    $arCantidad = round ($arCantidad - $cantidadPosible, 2); //disminuye cantidad

                    //actualizo los contenedores:
                    $cargas[$arIdTipoCarga]['disponible'] = $cargas[$arIdTipoCarga]['disponible'] - $articulo->volumen*$cantidadPosible;
                    $cargas[$arIdTipoCarga]['ocupado'] = $cargas[$arIdTipoCarga]['ocupado'] + $articulo->volumen*$cantidadPosible;

                    $contenedor['articulos'][]= array('idArticulo'=>$arIdArticulo, 'idPedido'=> $idPedido, 'cantidad'=> $cantidadPosible);
                    if ($arCombinable == 0) //el articulo no es combinable
                        $cargas[$arIdTipoCarga]['haynocombinable']=1; //indico que ahora ya tiene un no combinable;


                }
            }


        }
        

        //si llego aqui es porque aun tengo cantidades que no pudieron ser ingresados en ningun contenedor.
        //3: ahora lo metere en nuevos contenedores hasta que no haya ninguna cantidad:
        $arCantidad = round($arCantidad, 2);

        while ($arCantidad >0){
            
            $arVolumen = $arCantidad * $articulo->volumen;            
            $nuevoContenedor = $contenedorMasGrande;
            $cargas = &$nuevoContenedor['cargas'];

            if ($cargas[$arIdTipoCarga]['disponible'] >= $arVolumen ){ // si cabe todo:

                $cargas[$arIdTipoCarga]['disponible'] = $cargas[$arIdTipoCarga]['disponible'] - $arVolumen;
                $cargas[$arIdTipoCarga]['ocupado'] = $cargas[$arIdTipoCarga]['ocupado'] + $arVolumen;

                $nuevoContenedor['articulos'][]= array('idArticulo'=>$arIdArticulo, 'idPedido'=> $idPedido, 'cantidad'=> $arCantidad);
                if ($arCombinable == 0) //el articulo no es combinable
                    $cargas[$arIdTipoCarga]['haynocombinable']=1; //indico que ahora ya tiene un no combinable;


                //agregamos el nuevo contenedor a la lista:
                $contenedoresUtilizados[]= $nuevoContenedor;
                return 3; //se llego a ingresar por completo, salgo de la funcion
            }

            else if ($cargas[$arIdTipoCarga]['disponible'] >= $VolumenMinimoDivisible){ //no cabe todo, pero si una parte
                
                $vecesMinimoPosible =  floor( $cargas[$arIdTipoCarga]['disponible'] / $VolumenMinimoDivisible ); //redondeado hacia abajo, nunca sera 0;
                $cantidadPosible = round ($vecesMinimoPosible* $arMinimoDivisible, 2);     

                //actualizo la cantidad del articulo:
                $arCantidad = round($arCantidad - $cantidadPosible, 2); //disminuye cantidad

                //actualizo los contenedores:
                $cargas[$arIdTipoCarga]['disponible'] = $cargas[$arIdTipoCarga]['disponible'] - $articulo->volumen*$cantidadPosible;
                $cargas[$arIdTipoCarga]['ocupado'] = $cargas[$arIdTipoCarga]['ocupado'] + $articulo->volumen*$cantidadPosible;

                $nuevoContenedor['articulos'][]= array('idArticulo'=>$arIdArticulo, 'idPedido'=> $idPedido, 'cantidad'=> $cantidadPosible);
                if ($arCombinable == 0) //el articulo no es combinable
                    $cargas[$arIdTipoCarga]['haynocombinable']=1; //indico que ahora ya tiene un no combinable;

                //agregamos el nuevo contenedor a la lista:
                $contenedoresUtilizados[]= $nuevoContenedor;

            }
            else{ //esto nunca debe pasar, a menos que un articulo sea tan grande que no pueda ser llevado en un vehiculo. saldre del bucle;
                return -1; 
            }
        }
        //dd($VolumenMinimoDivisible);


        //no deberia llegar nunca aqui:
        return -2; 


    }
    /**fin parte 1**/
    
}

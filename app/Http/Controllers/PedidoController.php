<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

use PlanificaMYPE\Articulo;
use PlanificaMYPE\Pedido;
use PlanificaMYPE\Cliente;
use PlanificaMYPE\Empleado;
use PlanificaMYPE\Zona;
use PlanificaMYPE\Marca;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use PlanificaMYPE\Http\Requests\ArticuloFormRequest;
use PlanificaMYPE\Http\Requests\ConfirmarRequest;
use Illuminate\Contracts\Routing\ResponseFactory;

class PedidoController extends Controller
{
    public function __construct (){

    }

    public function index(){ //Request $request
        
    		$pedidos = Pedido::orderBy('fechaRegistro', 'desc')
                        //->orderBy('fechaRegistro', 'asc')
                        //->where('activo','=', 1)
                        //->get();
                        ->simplePaginate(8); // 1) cuando lleva paginate, ya no va el ->get() al final
                                                // 2) simplePaginate es mas eficiente que paginate
            
            return view('pedido.index', ['pedidos'=>$pedidos]);    	           

    }

    public function create (){

        $zonas= Zona::orderBy('nombre', 'asc')->get();
        $clientes= Cliente::orderBy('apellidoPaterno', 'asc')->get();
        $empleados= Empleado::orderBy('apellidoPaterno', 'asc')->get();
        $articulos= Articulo::orderBy('nombre', 'asc')->get();

    	return view('pedido.create', ['zonas'=>$zonas, 'clientes'=> $clientes, 'empleados' => $empleados, 'articulos'=>$articulos]);
    }

    public function store (Request $request){

        
        //inicio una transaccion
        DB::beginTransaction();
		    $pedido= new Pedido();

	    	//datos generales del pedido
	    	$pedido->fechaRegistro= date("Y-m-d H:i:s");

	    	$pedido->FechaEnvio= $request->get('fechaEnvio'); //date("Y-m-d H:i:s");//
	    	$pedido->montoTotal= $request->get('montoTotal');
	    	$pedido->montoPagado=0;
	        $pedido->estado= 'Pre-pedido';
	    	$pedido->idCliente= $request->get('idCliente');
	    	//$pedido->idEmpleado= 1; //$request->get('idEmpleado');
            $pedido->idEmpleado= Auth::User()->idEmpleado;
	    	$pedido->idZona= $request->get('idZona');

            $pedido->direccion = $request->get('direccion');
            $pedido->referencia = $request->get('referencia');
            $pedido->telefono = $request->get('telefono');

	    	$pedido->save();


	    	//obtengo todos los arreglos de mi vista:
	    	$idArticulos= $request->get('idArticulos');
	    	$cantidad= $request->get('cantidades');
	    	$preciosUnitarios= $request->get('preciosUnitarios');	

		    //datos del detalle del pedido:
	    	$contador=0;
	    	$cantidadFilas= count($idArticulos); //cuento cuantas filas tiene el detalle de pedido
	    	while ($contador<$cantidadFilas){
                //inserto en la tabla detallePedido
	    		$pedido->articulos()->attach($idArticulos[$contador], [
											'cantidad'=>$cantidad[$contador],
											'cantidadAtendida'=>0,
											'precioUnitario'=>$preciosUnitarios[$contador],
											'monto'=> $preciosUnitarios[$contador]*$cantidad[$contador]
	    									]);

                //resto el stock en la tabla articulo:
                $articuloStock= Articulo::findOrFail($idArticulos[$contador]);
                $articuloStock->stock = $articuloStock->stock - $cantidad[$contador];
                $articuloStock->save();

                //siguiente fila
	    		$contador++;
	    	}

		 DB::commit();
        
    	return Redirect('pedido'); //es una URL
    }

    public function show ($id){
        return 'Legue al show porque?'.$id;
    }

    public function destroy ($id){
    	$pedido = Pedido::find($id);
        if ($pedido->estado== 'Pre-pedido'){
            $pedido->estado= 'Anulado';
            $pedido->save();
        }       

        
        return Redirect('pedido'); //es una URL
    }

    public function confirmar (){
        return view('pedido.confirmar');  
    }

    public function confirmar_update (ConfirmarRequest $request){
        $pedido = Pedido::findOrFail($request->get('idPedido'));

        $pedido->montoPagado = $request->get('montoPagado');
        $pedido->estado = 'Confirmado';

        $pedido->save();
        return Redirect('pedido');  
    }


    //Peticiones AJAX:
    public function buscarArticulos (Request $request){
        $buscarMarca = $request->get('marca');
        $buscarNombre = $request->get('nombre');

        $articulos= null;

        //primero buscamos en nombre
        if ($buscarNombre != ''){
            $articulos =  DB::table('articulo')
                ->join('marca', 'articulo.idMarca', '=', 'marca.idMarca')
                ->join('unidadmedida', 'articulo.idUnidadMedida', '=', 'unidadmedida.idUnidadMedida')

                ->select('articulo.*', 'marca.nombre as nombreMarca', 'unidadmedida.nombre as nombreUnidadMedida')

                ->where ('articulo.nombre','like','%'.$buscarNombre.'%')
                ->where('articulo.activo','=',1)

                ->orderBy('articulo.nombre', 'asc')
                //->where('marca.nombre' ,'like','%'.$buscarMarca.'%' )
                ->get();
        }
        
        
        //luego buscamos por marca
        else if ($buscarMarca != ''){
            $articulos =  DB::table('articulo')
                ->join('marca', 'articulo.idMarca', '=', 'marca.idMarca')
                ->join('unidadmedida', 'articulo.idUnidadMedida', '=', 'unidadmedida.idUnidadMedida')

                ->select('articulo.*', 'marca.nombre as nombreMarca', 'unidadmedida.nombre as nombreUnidadMedida')

                //->where ('articulo.nombre','like','%'.$buscarNombre.'%')
                ->where('articulo.activo','=',1)
                ->Where('marca.nombre' ,'like','%'.$buscarMarca.'%' )

                ->orderBy('articulo.nombre', 'asc')
                ->get();  
        }

        //si no se ingreso ningun campo, listamos todos los articulos
        else{
            $articulos =  DB::table('articulo')
                ->join('marca', 'articulo.idMarca', '=', 'marca.idMarca')
                ->join('unidadmedida', 'articulo.idUnidadMedida', '=', 'unidadmedida.idUnidadMedida')

                ->select('articulo.*', 'marca.nombre as nombreMarca', 'unidadmedida.nombre as nombreUnidadMedida')

                //->where ('articulo.nombre','like','%'.$buscarNombre.'%')
                ->where('articulo.activo','=',1)

                ->orderBy('articulo.nombre', 'asc')
                //->where('marca.nombre' ,'like','%'.$buscarMarca.'%' )
                ->get();
        }

        return response()->json([
                            'Articulos' => $articulos
                            
                        ]);
        
    }

    public function buscarClientes (Request $request){
        $buscarNumeroDocumento = $request->get('numeroDocumento');
        $buscarNombre = $request->get('nombre');

        $clientes= null;

        //primero buscamos en nombre
        if ($buscarNombre != ''){
            $clientes =  DB::table('cliente')
                ->join('zona', 'cliente.idZona', '=', 'zona.idZona')

                ->select('cliente.*', 'zona.nombre as nombreZona')

                ->where ('cliente.nombres', 'like', '%'.$buscarNombre.'%')
                ->orWhere('cliente.apellidoPaterno', 'like', '%'.$buscarNombre.'%')
                ->orWhere('cliente.apellidoMaterno', 'like', '%'.$buscarNombre.'%')

                ->orderBy('cliente.apellidoPaterno', 'asc')
                ->get(); 
         
        }
        //luego por documento
        else if ($buscarNumeroDocumento != ''){
            $clientes =  DB::table('cliente')
                ->join('zona', 'cliente.idZona', '=', 'zona.idZona')

                ->select('cliente.*', 'zona.nombre as nombreZona')

                ->where ('numeroDocumento', 'like', '%'.$buscarNumeroDocumento.'%')

                ->orderBy('cliente.apellidoPaterno', 'asc')
                ->get(); 
         
        }
        //si no se ingreso ningun campo, listamos todos los clientes
        else {
            $clientes =  DB::table('cliente')
                ->join('zona', 'cliente.idZona', '=', 'zona.idZona')

                ->select('cliente.*', 'zona.nombre as nombreZona')

                ->orderBy('cliente.apellidoPaterno', 'asc')
                ->get(); 
        }

        return response()->json([
                            'clientes' => $clientes
                            
                        ]);
    }

    public function buscarPedidos (Request $request){
        $buscarNumeroDocumento = $request->get('numeroDocumento');
        $buscarIdPedido = $request->get('idPedido');

        $pedidos= null;

        //
        if ($buscarNumeroDocumento != ''){
            $pedidos =  DB::table('pedido')
                ->join('cliente', 'cliente.idCliente', '=', 'pedido.idCliente')

                ->select('pedido.*', 'cliente.nombres as nombreCliente', 'cliente.apellidoPaterno as apellidoPaternoCliente', 'cliente.apellidoMaterno as apellidoMaternoCliente', 'cliente.numeroDocumento as numeroDocumentoCliente')

                ->where ('cliente.numeroDocumento', 'like', '%'.$buscarNumeroDocumento.'%')
                ->where ('pedido.estado', '=', 'Pre-pedido')

                ->orderBy('cliente.numeroDocumento', 'asc')
                ->get(); 
         
        }
        //luego por id
        else if ($buscarIdPedido != ''){
            $pedidos =  DB::table('pedido')
                ->join('cliente', 'cliente.idCliente', '=', 'pedido.idCliente')

                ->select('pedido.*', 'cliente.nombres as nombreCliente', 'cliente.apellidoPaterno as apellidoPaternoCliente', 'cliente.apellidoMaterno as apellidoMaternoCliente', 'cliente.numeroDocumento as numeroDocumentoCliente')
                
                ->where ('pedido.idPedido', '=', $buscarIdPedido)
                ->where ('pedido.estado', '=', 'Pre-pedido')

                ->orderBy('pedido.idPedido', 'desc')
                ->get(); 
         
        }
        //si no se ingreso ningun campo, listamos los pedidos registrados en el dia:
        else {
            $pedidos =  DB::table('pedido')
                ->join('cliente', 'cliente.idCliente', '=', 'pedido.idCliente')

                ->select('pedido.*', 'cliente.nombres as nombreCliente', 'cliente.apellidoPaterno as apellidoPaternoCliente', 'cliente.apellidoMaterno as apellidoMaternoCliente', 'cliente.numeroDocumento as numeroDocumentoCliente')

                ->where ('pedido.fechaRegistro', '>=', 'DATE(NOW())')
                ->where ('pedido.estado', '=', 'Pre-pedido')

                ->orderBy('pedido.fechaRegistro', 'desc')
                ->get(); 
        }

        return response()->json([
                            'pedidos' => $pedidos
                            
                        ]);
    }
}

<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

use PlanificaMYPE\Articulo;
use PlanificaMYPE\Pedido;
use PlanificaMYPE\Cliente;
use PlanificaMYPE\Empleado;
use PlanificaMYPE\Zona;

use PlanificaMYPE\Http\Requests\ArticuloFormRequest;

class PedidoController extends Controller
{
    public function __construct (){

    }

    public function index(){ //Request $request
        
    		$pedidos = Pedido::orderBy('idPedido', 'desc')
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

    	return view('pedido.create', ['zonas'=>$zonas, 'clientes'=> $clientes, 'empleados' => $empleados]);
    }

    public function store (PedidoFormRequest $request){
        //inicio una transaccion
        DB::transaction(function () {
		    $pedido= new Pedido();

	    	//datos generales del pedido
	    	$pedido->fechaRegistro= date("Y-m-d H:i:s");

	    	$pedido->FechaEnvio= $request->get('fechaEnvio');
	    	$pedido->montoTotal=$request->get('montoTotal');
	    	$pedido->montoPagado=0;
	        $pedido->estado= 'pre-pedido';
	    	$pedido->idCliente= $request->get('idCliente');
	    	$pedido->idEmpleado= $request->get('idEmpleado');
	    	$pedido->idZona= $request->get('idZona');

	    	$pedido->save();

	    	//obtengo todos los arreglos de mi vista:
	    	$idArticulos= $request->get('idArticulos');
	    	$cantidad= $request->get('cantidades');
	    	$preciosUnitarios= $request->get('preciosUnitarios');	

		    //datos del detalle del pedido:
	    	$contador=0;
	    	$cantidadFilas= count($idArticulos); //cuento cuantas filas tiene el detalle de pedido
	    	while ($contador<$cantidadFilas){
	    		$pedido->articulos()->attach($idArticulos[$contador], [
											'cantidad'=>$cantidad[$contador],
											'cantidadAtendida'=>0,
											'precioUnitario'=>$preciosUnitarios[$contador],
											'monto'=> $preciosUnitarios[$contador]*$cantidad[$contador]
	    									]);
	    		$contador++;
	    	}

		});

    	return Redirect('pedido'); //es una URL
    }

    public function show ($id){
        return 'Legue al show';
    	//return view('cliente.show', ["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id){
        //obtengo todas las zonas registradas:
        $unidadesMedida= UnidadMedida::orderBy('nombre', 'asc')->get();
        $marcas= Marca::orderBy('nombre', 'asc')->get();
        $tiposCarga= TipoCarga::orderBy('nombre', 'asc')->get();

    	return view('articulo.edit', [ 'articulo'=>Articulo::findOrFail($id), 
                                       'unidadesMedida'=>$unidadesMedida, 
                                       'marcas'=>$marcas, 
                                       'tiposCarga'=>$tiposCarga]);
    }

    public function update (ArticuloFormRequest $request, $id){
    	$articulo = Articulo::find($id);

        $articulo->nombre=$request->get('nombre');
        $articulo->precioBase=$request->get('precioBase');
        $articulo->stock=$request->get('stock');
        $articulo->volumen=$request->get('volumen');
        //$articulo->tiempoHorasAbastecer= null;

        if ($request->idTipoCarga!=  1 || $request->combinable=='check')  // solo pueden ser no combinables los tipo 1, si no son tipo 1, entonces siempre son combinables
            $articulo->combinable= 1; 
        else 
            $articulo->combinable= 0; //todos inician sin credito asignado (0)

        $articulo->idMarca= $request->get('idMarca');
        $articulo->idTipoCarga= $request->get('idTipoCarga');
        $articulo->idUnidadMedida=$request->get('idUnidadMedida');

        $articulo->save();

        return Redirect('articulo'); //es una URL

    }

    public function destroy ($id){
    	$articulo = Articulo::find($id);

        $articulo->activo= 0;

        $articulo->save();
        return Redirect('articulo'); //es una URL
    }
}

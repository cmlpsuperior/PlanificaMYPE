<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;
use PlanificaMYPE\Articulo;
use PlanificaMYPE\TipoCarga;
use PlanificaMYPE\UnidadMedida;
use PlanificaMYPE\Marca;


use PlanificaMYPE\Http\Requests;
use PlanificaMYPE\Http\Requests\ArticuloFormRequest;

class ArticuloController extends Controller
{
    public function __construct (){

    }

    public function index(){ //Request $request
        
    	
    		$articulos = Articulo::orderBy('idArticulo', 'desc')
                      //->get();
                      ->simplePaginate(8); // 1) cuando lleva paginate, ya no va el ->get() al final
                                            // 2) simplePaginate es mas eficiente que paginate
            /*
            $fechaHoy = new DateTime();
            $years = array();

            foreach ($clientes as $cliente){
                $fechaNacimiento = new DateTime ($cliente->fechaNacimiento);
                $year = $fechaNacimiento->diff($fechaHoy);
                $years[] = $year->y;
            }
           
            return var_dump($years); */
            
            return view('articulo.index', ['articulos'=>$articulos]);    	           

    }

    public function create (){

        //obtengo todas las zonas registradas:
        $unidadesMedida= UnidadMedida::orderBy('nombre', 'asc')->get();
        $marcas= Marca::orderBy('nombre', 'asc')->get();
        $tiposCarga= TipoCarga::orderBy('nombre', 'asc')->get();

    	return view('articulo.create', ['unidadesMedida'=>$unidadesMedida, 'marcas'=> $marcas, 'tiposCarga' => $tiposCarga]);
    }

    public function store (ArticuloFormRequest $request){
        
    	$articulo= new Articulo();
    	$articulo->nombre=$request->get('nombre');
    	$articulo->precioBase=$request->get('precioBase');
    	$articulo->stock=$request->get('stock');
        $articulo->volumen=$request->get('volumen');
    	$articulo->tiempoHorasAbastecer= null;
        
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

    public function show ($id){
        return 'Legue al show';
    	//return view('cliente.show', ["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id){
        $zonas= Zona::all();
    	return view('cliente.edit', ['cliente'=>Cliente::findOrFail($id), 'zonas'=>$zonas]);
    }

    public function update (ClienteUpdateFormRequest $request, $id){
    	$cliente = Cliente::find($id);

    	$cliente->nombres=$request->get('nombres');
        $cliente->apellidoPaterno=$request->get('apellidoPaterno');
        $cliente->apellidoMaterno=$request->get('apellidoMaterno');
        $cliente->razonSocial= null;
        //$cliente->numeroDocumento=$request->get('numeroDocumento');
        $cliente->fechaNacimiento= $request->get('fechaNacimiento');
        $cliente->genero= $request->get('genero');

        $cliente->telefono=$request->get('telefono');
        $cliente->correo=$request->get('correo');
        $cliente->direccion=$request->get('direccion');
        $cliente->referencia=$request->get('referencia');

        $cliente->idTipoDocumento=$request->get('idTipoDocumento');
        $cliente->idZona=$request->get('idZona');

        if ($request->credito=='check')
            $cliente->credito= 1; 
        else 
            $cliente->credito= 0; //todos inician sin credito asignado (0)

    	$cliente->save();

        return Redirect('cliente');
    }

    public function destroy ($id){
    	
    }
}

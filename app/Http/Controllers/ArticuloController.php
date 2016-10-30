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
                        ->where('activo','=', 1)
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

        $articulo->activo= 1; //cuando creo siempre esta activo
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

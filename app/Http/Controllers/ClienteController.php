<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

use PlanificaMYPE\Cliente;
use PlanificaMYPE\Zona;

use Illuminate\Support\Facedes\Redirect;

use PlanificaMYPE\Http\Requests\ClienteFormRequest;

use DB;
use DateTime;

class ClienteController extends Controller
{
    public function __construct (){

    }

    public function index(){ //Request $request
        
    	
    		$clientes = Cliente::orderBy('idCliente', 'desc')
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
            
            return view('cliente.index', ['clientes'=>$clientes]);    	           

    }

    public function create (){

        //obtengo todas las zonas registradas:
        $zonas= Zona::all();

    	return view('cliente.create', ['zonas'=>$zonas]);
    }

    public function store (ClienteFormRequest $request){
        
        
    	$cliente= new Cliente();
    	$cliente->nombres=$request->get('nombres');
    	$cliente->apellidoPaterno=$request->get('apellidoPaterno');
    	$cliente->apellidoMaterno=$request->get('apellidoMaterno');
    	$cliente->razonSocial= null;
        $cliente->numeroDocumento=$request->get('numeroDocumento');
        $cliente->fechaNacimiento= $request->get('fechaNacimiento');
        $cliente->genero= $request->get('genero');

    	$cliente->telefono=$request->get('telefono');
    	$cliente->correo=$request->get('correo');
    	$cliente->direccion=$request->get('direccion');
        $cliente->referencia=$request->get('referencia');
    	
    	$cliente->credito= $request->get('credito'); //todos inician sin credito asignado (0)

    	$cliente->idTipoDocumento=$request->get('idTipoDocumento');
    	$cliente->idZona=$request->get('idZona');

    	$cliente->save();

    	return Redirect('cliente'); //es una URL*/
        //return "entro a stroe";
    }

    public function show ($id){
        return 'Legue al show';
    	//return view('cliente.show', ["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id){
        $zonas= Zona::all();
    	return view('cliente.edit', ['cliente'=>Cliente::findOrFail($id), 'zonas'=>$zonas]);
    }

    public function update (ClienteFormRequest $request, $id){
    	$cliente = Cliente::find($id);

    	$cliente->nombres=$request->get('nombres');
        $cliente->apellidoPaterno=$request->get('apellidoPaterno');
        $cliente->apellidoMaterno=$request->get('apellidoMaterno');
        $cliente->razonSocial= null;
        $cliente->numeroDocumento=$request->get('numeroDocumento');
        $cliente->fechaNacimiento= $request->get('fechaNacimiento');
        $cliente->genero= $request->get('genero');

        $cliente->telefono=$request->get('telefono');
        $cliente->correo=$request->get('correo');
        $cliente->direccion=$request->get('direccion');
        $cliente->referencia=$request->get('referencia');
        
        $cliente->credito= $request->get('credito'); //todos inician sin credito asignado

        $cliente->idTipoDocumento=$request->get('idTipoDocumento');
        $cliente->idZona=$request->get('idZona');

    	$cliente->save();

        return Redirect('cliente');

    }

    public function destroy ($id){
    	
    }
}

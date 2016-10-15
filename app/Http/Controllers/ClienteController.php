<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

use PlanificaMYPE\Cliente;

use Illuminate\Support\Facedes\Redirect;

use PlanificaMYPE\Http\Requests\ClienteFormRequest;

use DB;

class ClienteController extends Controller
{
    public function __construct (){

    }

    public function index(Request $request){
        
    	if ($request){
    		$query = trim($request->get('searchDni'));
    		$clientes = DB::table('cliente')
    		->where('numeroDocumento', 'LIKE', '%'.$query.'%')
    		->orderBy('idCliente', 'desc');

    		return view('cliente.index', ["clientes"=>$clientes, "searchDni"=>$query]);
    	}
            
        //esto no estoy seguro XD
        return view('cliente.index');

    }

    public function create (){
    	return view('cliente.create');
    }

    public function store (ClienteFormRequest $request){
    	$cliente= new Cliente();
    	$cliente->nombre=$request->get('nombre');
    	$cliente->apellidoPaterno=$request->get('apellidoPaterno');
    	$cliente->apellidoMaterno=$request->get('apellidoMaterno');
    	$cliente->razonSocial=$request->get('razonSocial');
    	$cliente->telefono=$request->get('telefono');
    	$cliente->correo=$request->get('correo');
    	$cliente->direccion=$request->get('direccion');
    	$cliente->numeroDocumento=$request->get('numeroDocumento');
    	$cliente->habilitado=$request->get('habilitado');

    	$cliente->idTipoDocumento=$request->get('idTipoDocumento');
    	$cliente->idZona=$request->get('idZona');

    	$cliente->save();
    	return Redirect::to ('cliente');
    }

    public function show ($id){
    	return view('cliente.show', ["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id){
    	return view('cliente.edit', ["cliente"=>Cliente::findOrFail($id)]);
    }

    public function update (ClienteFormRequest $request, $id){
    	$cliente = Cliente::findOrFail($id);

    	$cliente->nombre=$request->get('nombre');
    	$cliente->apellidoPaterno=$request->get('apellidoPaterno');
    	$cliente->apellidoMaterno=$request->get('apellidoMaterno');
    	$cliente->razonSocial=$request->get('razonSocial');
    	$cliente->telefono=$request->get('telefono');
    	$cliente->correo=$request->get('correo');
    	$cliente->direccion=$request->get('direccion');
    	$cliente->numeroDocumento=$request->get('numeroDocumento');
    	$cliente->habilitado=$request->get('habilitado');

    	$cliente->idTipoDocumento=$request->get('idTipoDocumento');
    	$cliente->idZona=$request->get('idZona');

    	$cliente->update();

    	return Redirect::to('cliente');

    }

    public function destroy ($id){
    	
    }
}

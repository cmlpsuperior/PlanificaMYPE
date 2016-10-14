<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;

use PlanificaMYPE\TipoCarga;

use Illuminate\Support\Facedes\Redirect;

use PlanificaMYPE\Http\Requests\TipoCargaFormRequest;

use DB;

class TipoCargaController extends Controller
{
    public function __construct (){

    }

    public function index(Request $request){

    	if ($request){
    		$query = trim($request->get('searchText'));
    		$tiposCarga = DB::table('tipocarga')
    		->where('nombre', 'LIKE', '%'.$query.'%')
    		->orderBy('idtipocarga', 'desc');

    		return view('tipoCarga.index', ["tiposCarga"=>$tiposCarga, "searchText"=>$query]);
    	}

    }
    public function create (){
    	return view('tipoCarga.create');
    }
    public function store (TipoCargaFormRequest $request){
    	$tipoCarga= new TipoCarga();
    	$tipoCarga->nombre=$request->get('nombre');
    	$tipoCarga->descripcion=$request->get('descripcion');

    	$tipoCarga->save();
    	return Redirect::to ('tipoCarga');
    }
    public function show ($id){
    	return view('tipoCarga.show', ["tipoCarga"=>TipoCarga::findOrFail($id)]);
    }
    public function edit($id){
    	return view('tipoCarga.edit', ["tipoCarga"=>TipoCarga::findOrFail($id)]);
    }
    public function update (TipoCargaFormRequest $request, $id){
    	$tipoCarga = TipoCarga::findOrFail($id);

    	$tipoCarga->nombre= $request->get('nombre');
    	$tipoCarga->descripcion= $request->get('descripcion');

    	$tipoCarga->update();

    	return Redirect::to('tipoCarga');

    }
    public function destroy ($id){
    	
    }
}

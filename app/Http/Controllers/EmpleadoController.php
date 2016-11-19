<?php

namespace PlanificaMYPE\Http\Controllers;

use Illuminate\Http\Request;

use PlanificaMYPE\Http\Requests;
use PlanificaMYPE\Http\Requests\EmpleadoRequest;
use PlanificaMYPE\Http\Requests\EmpleadoEditRequest;
use Illuminate\Support\Facades\Hash;

use PlanificaMYPE\Empleado;
use PlanificaMYPE\Usuario;
use PlanificaMYPE\TipoDocumento;
use PlanificaMYPE\Cargo;

use DB;


class EmpleadoController extends Controller
{
    
    public function index(Request $request){ //Request $request
        
        $bIdCargo ="";
        $cargos= Cargo::orderBy('nombre', 'asc')->get();

        if ($request->get('bNombre') != '' || 
            $request->get('bNumeroDocumento') != '' || 
            $request->get('bIdCargo') != '' ){

            if ($request->get('bNumeroDocumento') != ''){ //si hay cargo
                $empleados = Empleado::where('numeroDocumento','like','%'.$request->get('bNumeroDocumento').'%')
                                    
                                    ->orderBy('apellidoPaterno', 'asc')
                                    ->orderBy('apellidoMaterno', 'asc')
                                    ->orderBy('Nombres', 'asc')                     
                                    ->simplePaginate(8);
            }
            else if ($request->get('bNombre') != ''){
                $empleados = Empleado::where('nombres','like', '%'.$request->get('bNombre').'%' )
                                    ->orWhere('apellidoPaterno','like', '%'.$request->get('bNombre').'%' )
                                    ->orWhere('apellidoMaterno','like', '%'.$request->get('bNombre').'%' )

                                    ->orderBy('apellidoPaterno', 'asc')
                                    ->orderBy('apellidoMaterno', 'asc')
                                    ->orderBy('Nombres', 'asc')                     
                                    ->simplePaginate(8);
            }
            else{ //no hay cargo seleciondo
                $empleados = Empleado::where('idCargo','=', $request->get('bIdCargo') )

                                    ->orderBy('apellidoPaterno', 'asc')
                                    ->orderBy('apellidoMaterno', 'asc')
                                    ->orderBy('Nombres', 'asc')                     
                                    ->simplePaginate(8);
            }            
        }
    	else{ // no se llenó ningun filtro
    		$empleados = Empleado::orderBy('apellidoPaterno', 'asc')->orderBy('apellidoMaterno', 'asc')->orderBy('Nombres', 'asc')                     
                        ->simplePaginate(8);
            
            
            
               	           
        }

        return view('empleado.index', ['empleados'=>$empleados, 'cargos'=> $cargos, 'bIdCargo'=>$bIdCargo]); 
    }

    public function create (){

        //obtengo todas las zonas registradas:
        $tiposDocumentos= TipoDocumento::orderBy('nombre', 'asc')->get();
        $cargos= Cargo::orderBy('nombre', 'asc')->get();

    	return view('empleado.create', ['tiposDocumentos'=>$tiposDocumentos, 'cargos'=> $cargos]);
    }

    public function store (EmpleadoRequest $request){
        
        //una transaccion, ya que ambos deben registrar, sino ninguno.
        DB::beginTransaction();
        	//creamos el empleado
	    	$empleado= new Empleado();
	    	$empleado->nombres=$request->get('nombres');
	    	$empleado->apellidoPaterno=$request->get('apellidoPaterno');
	    	$empleado->apellidoMaterno=$request->get('apellidoMaterno');
	        $empleado->numeroDocumento=$request->get('numeroDocumento');

	    	$empleado->correo= $request->get('correo');
	        $empleado->estado = 'Activo';

	        $empleado->sueldo= $request->get('sueldo');
	        if ($request->get('licencia')=='')
	        	$empleado->licencia=null;
	        else
	        	$empleado->licencia= $request->get('licencia');
	        $empleado->fechaIngreso= $request->get('fechaIngreso');
	        $empleado->fechaSalida = null;
	    	$empleado->idCargo=$request->get('idCargo');
	    	$empleado->idTipoDocumento=$request->get('idTipoDocumento');

	    	$empleado->save();

            /*
	    	//creamos el usuario del sistema:
	    	$usuario = new Usuario();
	    	$usuario->usuario = $request->get('numeroDocumento');
	    	$usuario->contrasenia = Hash::make( $request->get('numeroDocumento') ); //la clave pre-definida es el dni
	    	$usuario->idEmpleado = $empleado->idEmpleado;

            $usuario->save();
*/
            //creo para la tabal USERs
            DB::table('users')->insert(
                        [   'name' =>  $request->get('numeroDocumento'),
                            'usuario' => $request->get('numeroDocumento'),
                            'password'=> Hash::make( $request->get('numeroDocumento') ),
                            'idEmpleado' => $empleado->idEmpleado
                        ]);

    	DB::commit();

    	return Redirect('empleado'); //es una URL
    }

    public function show ($id){
        return 'Legue al show';
    	//return view('cliente.show', ["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id){

        //obtengo todas las zonas registradas:
        $tiposDocumentos= TipoDocumento::orderBy('nombre', 'asc')->get();
        $cargos= Cargo::orderBy('nombre', 'asc')->get();

    	return view('empleado.edit', [ 'tiposDocumentos'=>$tiposDocumentos, 'cargos'=> $cargos, 'empleado'=> Empleado::findOrFail($id) ]);
    }

    public function update (EmpleadoEditRequest $request, $id){
    	$empleado = Empleado::findOrFail($id);

        $empleado->nombres=$request->get('nombres');
    	$empleado->apellidoPaterno=$request->get('apellidoPaterno');
    	$empleado->apellidoMaterno=$request->get('apellidoMaterno');
        //$empleado->numeroDocumento=$request->get('numeroDocumento'); //no sepuede cambiar de dni sino tambein se tendria que cambia el usuario.

    	$empleado->correo= $request->get('correo');
        //$empleado->estado = 

        $empleado->sueldo= $request->get('sueldo');
        $empleado->licencia= $request->get('licencia');
        //$empleado->fechaIngreso= $request->get('fechaIngreso');
        //$empleado->fechaSalida = null;
    	$empleado->idCargo=$request->get('idCargo');

        $empleado->save();

        return Redirect('empleado'); //es una URL

    }

    public function destroy ($id){
    	//desactivamos el empleado
    	$empleado = Empleado::findOrFail($id);

        $articulo->activo= 'Anulado';

        $articulo->save();

        return Redirect('empleado'); //es una URL
    }
}

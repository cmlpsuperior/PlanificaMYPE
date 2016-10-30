@extends ('layouts.base')

@section ('contenido')


        <!-- Estos linea es para las migajas-->
        <nav class="teal">
          <div class="nav-wrapper container">
            <div class="col s12">
              <a href="#!" class="breadcrumb">Mant.</a>
              <a href="{{ url('articulo')}}" class="breadcrumb">Articulo</a>
              <a href="{{ url('articulo/create')}}" class="breadcrumb">Editar</a>
            </div>
          </div>
        </nav>






        


        <!--Contenido del cuerpo-->
        <br>
        <div class="container">

          <div class="row">
            <div class="col s12 m10 l8 offset-m1 offset-l2 ">
              <div class="card">
                <div class="card-content">
                  {{Form::model ($articulo, array('action' => array('ArticuloController@update', $articulo->idArticulo), 'method'=>'put')) }} <!--para llamar al store, se le llama igual que al index, pero con metodo post-->
                    <div class="row">
                      <h4 class="teal-text">Editar articulo</h4>
                    </div>
                    <br>
                    
                    <!--Mostrara los errores que se hayan cometido:-->
                    @if (count($errors)>0)
                    <div class="alert">
                      <ul>
                          @foreach ($errors -> all() as $error)
                            <li>{{$error}}</li>
                          @endforeach
                      </ul>
                    </div>
                    @endif

                    <div class="row">
                      <h5>Datos del articulo</h5>
                    </div>


                    <div class="row">

                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <select name="idUnidadMedida">                          
                          <option value="">Seleccionar</option>
                          @foreach ($unidadesMedida as $unidadMedida)
                            <option value="{{$unidadMedida->idUnidadMedida}}" @if ($unidadMedida->idUnidadMedida == $articulo->idUnidadMedida) selected @endif>{{$unidadMedida->nombre}}</option>
                          @endforeach
                        </select>
                        <label>Unidad de medida *</label>
                      </div> 

                      <div class="input-field col s6">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="Nombre" type="text" class="validate"  required value="{{ $articulo->nombre }}" name="nombre">
                        <label for="Nombre">Nombre *</label>
                      </div>
                                  
                    </div>

                    <div class="row">   

                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <select name="idMarca">                          
                          <option value="">Seleccionar</option>
                          @foreach ($marcas as $marca)
                            <option value="{{$marca->idMarca}}" @if ( $marca->idMarca == $articulo->idMarca ) selected @endif >{{$marca->nombre}}</option>
                          @endforeach
                        </select>
                        <label>Marca *</label>
                      </div> 

                      <div class="input-field col s6">
                        <i class="material-icons prefix">assignment_ind</i>
                        <input id="precioBase" type="number" step="0.01" min="0.01" class="validate" required value="{{ $articulo->precioBase }}" name="precioBase">
                        <label for="precioBase">Precio *</label>
                      </div>

                    </div>
                    
                    <br>
                    <div class="row">
                      <h5>Datos de carga</h5>
                    </div>

                    <div class="row">  

                      <div class="input-field col s6">
                        <i class="material-icons prefix">location_on</i>
                        <select name="idTipoCarga" id="idTipoCarga">                          
                          <option value="">Seleccionar</option>
                          @foreach ($tiposCarga as $tipoCarga)
                            <option value="{{$tipoCarga->idTipoCarga}}" @if ( $tipoCarga->idTipoCarga == $articulo->idTipoCarga ) selected @endif >{{$tipoCarga->nombre}}</option>
                          @endforeach
                        </select>
                        <label>Tipo de carga *</label>
                      </div> 

                      <div class="input-field col s6">

                        <div class="switch">
                          <i class="material-icons prefix">location_on</i>
                          <label>
                            Combinable
                            <input type="checkbox"  id="combinable" value="check" name="combinable" @if ($articulo->combinable ===1 )  checked="checked" @endif >
                            <span class="lever"></span>
                            
                          </label>
                        </div>
                      </div>

                    </div>


                    <div class="row">
                      <div class="input-field col s6">
                        <i class="material-icons prefix">phone</i>
                        <input id="stock" type="number" min="0" class="validate" value="{{ $articulo->stock }}" name="stock">
                        <label for="stock" data-error="wrong" data-success="right">Stock *</label>
                      </div>

                      <div class="input-field col s6">
                        <i class="material-icons prefix">email</i>
                        <input id="volumen" type="number" step="0.001" min="0" class="validate" value="{{ $articulo->volumen }}" name="volumen">
                        <label for="volumen" data-error="wrong" data-success="right">Volumen (m3) *</label>
                      </div>
                    </div>
                    <br>
          
                    <!--Los botones del formulario-->
                    <div class="row">
                      <div class="input-field col s12 right-align">
                        <a class="waves-effect waves-light btn" href="{{ url('articulo')}}">Cancelar</a>
                        <button class="btn waves-effect waves-light" type="submit" name="action">Guardar
                          <i class="material-icons right">send</i>
                        </button>                
                      </div>              
                    </div>
                    
                  {{ Form::close()}}
                </div>
              </div>
            </div>
          </div>
        </div>

@stop

@section ('scriptcontenido')
<script>  
    

    $(document).ready(function() {

        

      /*Para inicar el select*/
      $('select').material_select();     

      

  });

  
  
</script>

@stop

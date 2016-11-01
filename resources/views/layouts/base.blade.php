<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css')}}"  media="screen,projection"/>
      <!--Mis stilos-->
      <link type="text/css" rel="stylesheet" href="{{ asset('css/main.css')}}"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
  
    <body>

        <!--La barra superior principal-->
        <nav class="teal">
          <div class="nav-wrapper container ">

            <!--Menu de barra de haburguesa-->
            <ul id="slide-out" class="side-nav">
              <li><div class="userView">
                <img class="background" width= "100%" src="{{ asset('img/md_noche.png')}}">
                <i class="material-icons center">account_circle</i>
                <a href="#!"><span class="white-text name">Henry Espinoza</span></a>
                <a href="#!"><span class="white-text email">henryEspinozat@gmail.com</span></a>
              </div></li>             
              
              <li><a class="subheader">Menu</a></li>
              <li><div class="divider"></div></li>

              <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                  <li class="">
                    
                    <a class="collapsible-header waves-effect waves-teal"><i class="material-icons">store</i>Recepción</a>  

                    <div class="collapsible-body">
                      <ul>
                        <li><a href="#!">Nuevo pedido</a></li>
                        <li><a href="#!">Confirmar pedido</a></li>
                        <li><a href="{{ url('cliente/create')}}">Registrar cliente</a></li>
                      </ul>
                    </div>

                  </li>

                  <li class="bold">
                    <a class="collapsible-header waves-effect waves-teal"><i class="material-icons">assessment</i>Gestión</a>

                    <div class="collapsible-body">
                      <ul>
                        <li><a href="#!">Planificación</a></li>
                        <li><a href="#!">Asignar viajes</a></li>
                        <li><a href="#!">Control</a></li>
                      </ul>
                    </div>

                  </li>

                  <li class="bold">
                    <a class="collapsible-header waves-effect waves-teal"><i class="material-icons">navigation</i>Viajes</a>

                    <div class="collapsible-body">
                      <ul>
                        <li><a href="#!">Pendientes</a></li>
                        <li><a href="#!">Historial</a></li>
                      </ul>
                    </div>

                  </li>

                  <li class="bold">
                    <a class="collapsible-header waves-effect waves-teal"><i class="material-icons">settings</i>Mantenimiento</a>

                    <div class="collapsible-body">
                      <ul>
                        <li><a href="{{ url('pedido') }}">Pedidos</a></li> 
                        <li><a href="{{ url('cliente') }}">Clientes</a></li>                        
                        <li><a href="{{ url('articulo') }}">Artículos</a></li>          
                        <li><a href="#!">Zonas</a></li>          
                        <li><a href="#!">Empleados</a></li>
                        <li><a href="#!">Vehículos</a></li>
                      </ul>
                    </div>

                  </li>

                </ul>   
              </li>
            </ul> 
            
            <a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
            <!--Fin barra de hamburgauesa-->            

            <a href="#" class="brand-logo center">PlanificaMYPE</a>

          </div>
        </nav>
        

        







        @yield('contenido')
      







      <footer class="page-footer grey darken-2">
        <div class="container">
          <div class="row">

            <div class="col l8 s12">
              <h5 class="white-text">PlanificaMYPE</h5>
              <p class="grey-text text-lighten-4">PlanificaMYPE es un proyecto de tesis que busca ayudar a las pequeñas empresas a planificar de manera sencilla la distribución de sus pedidos.</p>
            </div>
            
            <div class="col l4 s12">
              <h5 class="white-text">Contacto</h5>
              <ul>
                <li><a class="white-text" href="#!">henryespinozat@gmail.com</a></li>
                <li><a class="white-text" href="#!">(01) 606-3477</a></li>
                <li><a class="white-text" href="#!">Facebook</a></li>
                <li><a class="white-text" href="#!">PUCP</a></li>
              </ul>
            </div>

          </div>
        </div>

        <div class="footer-copyright">
          <div class="container">
          Desarrollado por <a class="orange-text text-lighten-3" href="https://www.facebook.com/henry.espinozatorres">Henry A. Espinoza</a>
          </div>
        </div>

      </footer>


      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="{{ asset('js/materialize.min.js')}}"></script>
      
      
      <script>
        $(document).ready(function() {
                  
          $(".dropdown-button").dropdown();
          $(".button-collapse").sideNav();      /*es para que boton de hamburgesa funcione*/
          
          $('select').material_select(); 
          $('.datepicker').pickadate({ /*es para que funcione e datepicker*/
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 200, // Creates a dropdown of 15 years to control year
            format: 'yyyy/mm/dd'
          });
        
          
        });
      </script>

      @yield('scriptcontenido')
      
    </body>
  </html>
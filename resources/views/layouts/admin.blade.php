<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}">

        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
   
        <link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">

        <script src="{{asset('js/vendor/modernizr-2.8.3-respond-1.4.2.min.js')}}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
       

       <!--barra de menu-->
       <nav class="navbar navbar-default navbar-fixed-top" role="navegation">
          <div class="container-fluid">
            
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mynavbar1">
                <span class="sr-only">toggle navegation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="indice.html"><strong>Planifica MYPE</strong></a>

            </div>
            


            <!--opciones del menu-->
            <div class="collapse navbar-collapse" id="mynavbar1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">Recepción<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">Nuevo pedido</a></li>
                            <li><a href="">Confirmar pedido</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button">Gestión<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="" >Planificación</a></li>
                            <li><a href="">Asignación</a></li>
                            <li><a href="">Control</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="">Mantenimiento</a></li>

                        </ul>
                    </li>
                    <li class="active"><a href="">Mis envíos</a></li>

                </ul>

                
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="">Iniciar sesión</a></li>
                    <li><a href="">Registrarse</a></li>

                </ul>

            </div>

          </div><!-- /.container-fluid -->

        </nav>


        @yield('contenido');




        <footer>
          <div class="container">
            <div class="row text-center">
                <div class="col-xs-12">
                    <h5>Proyecto de tesis</h5>
                </div> 
                
                <div class="col-xs-12">
                    <h6>Desarrollador: Henry Antonio Espinoza Torres</h6>
                </div> 

                <div class="col-xs-12">
                    <h6>Copyright &copy; 2016</h6>
                </div>              

            </div>
          </div>
        </footer>



        
        <script>window.jQuery || document.write('<script src="{{asset('js/vendor/jquery-1.11.2.min.js')}}"><\/script>')</script>
        <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/main.js')}}"></script>
    </body>
</html>

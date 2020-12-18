<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
	if (!isset($_SESSION["nomyape"])){  
            redireccionar("/login");
    }  
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>InfoDP | Tienda</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Para ICONOS -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php asset("img/icoDP/apple-icon-57x57.png") ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php asset("img/icoDP/apple-icon-60x60.png") ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php asset("img/icoDP/apple-icon-72x72.png") ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php asset("img/icoDP/apple-icon-76x76.png") ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php asset("img/icoDP/apple-icon-114x114.png") ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php asset("img/icoDP/apple-icon-120x120.png") ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php asset("img/icoDP/apple-icon-144x144.png") ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php asset("img/icoDP/apple-icon-152x152.png") ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php asset("img/icoDP/apple-icon-180x180.png") ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php asset("img/icoDP/android-icon-192x192.png") ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php asset("img/icoDP/favicon-32x32.png") ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php asset("img/icoDP/favicon-96x96.png") ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php asset("img/icoDP/favicon-16x16.png") ?>">
    <link rel="manifest" href="<?php asset("img/icoDP/manifest.json") ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php asset("img/icoDP/ms-icon-144x144.png") ?>">
    <meta name="theme-color" content="#ffffff">
	<link rel="shortcut icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
	<link rel="icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
	
    <!-- ARCHIVOS CSS-->
    <!-- Bootstrap Core CSS -->
    <link href="<?php asset("bower_components/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
	 <!-- MetisMenu CSS -->
    <link href="<?php asset("bower_components/metisMenu/dist/metisMenu.min.css")?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php asset("bower_components/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css">
	 <!-- Custom CSS -->
    <link href="<?php asset("bower_components/css/sb-admin-2.css")?>" rel="stylesheet">		
	
	 <!--Archivos CSS para DataTables -->
    <link rel="stylesheet" href="<?php asset("bower_components/datatables/css/dataTables.bootstrap.min.css") ?>">
	<!--extension BUTTONS para DataTables -->
    <link rel="stylesheet" href="<?php asset("bower_components/datatables/extensions/Buttons/css/buttons.dataTables.min.css") ?>">	
	<!--estilo bootstrap para extension BUTTONS -->
	<!--<link rel="stylesheet" href="<?php asset("bower_components/datatables/extensions/Buttons/css/buttons.bootstrap.min.css") ?>">-->	
	 <!--extension SELECT para DataTables -->
    <link rel="stylesheet" href="<?php asset("bower_components/datatables/Select/css/select.bootstrap.min.css") ?>">
	<!--scroller para datatables -->
	<link rel="stylesheet" href="<?php asset("bower_components/datatables/extensions/scroller/css/scroller.bootstrap.min.css") ?>">    
	
    <!--Archivos CSS para JQuery UI -->
    <link rel="stylesheet" href="<?php asset("bower_components/jqueryUI/css/jquery-ui.min.css") ?>">
    <link rel="stylesheet" href="<?php asset("bower_components/jqueryUI/css/jquery-ui.theme.min.css") ?>">		
    <!--Archivos CSS para Alertify -->
	<!-- include the style -->
	<link href="<?php asset("bower_components/alertify/css/alertify.min.css") ?>" rel="stylesheet">
	<!-- include a theme -->
	<link href="<?php asset("bower_components/alertify/css/themes/default.min.css") ?>" rel="stylesheet">    
	
	<!--ARCHIVOS JS-->	
	 <!-- JQuery -->
    <script src="<?php asset("bower_components/js/jquery.min.js")?>"></script>
    <!-- Bootstrap -->
    <script src="<?php asset("bower_components/bootstrap/js/bootstrap.min.js")?>"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php asset("bower_components/metisMenu/dist/metisMenu.min.js")?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php asset("bower_components/js/sb-admin-2.js")?>"></script>
    
	<!--Archivos JS para DataTables -->
    <script src="<?php asset("bower_components/datatables/js/jquery.dataTables.min.js")?>"></script>
	<!--Archivos JS para DataTables estilo Bootstrap -->
    <script src="<?php asset("bower_components/datatables/js/dataTables.bootstrap.min.js")?>"></script>
    <!--extension BUTTONS para DataTables -->
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/dataTables.buttons.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.bootstrap.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/jszip.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/pdfmake.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/vfs_fonts.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.html5.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.print.min.js")?>"></script>
	<script src="<?php asset("bower_components/datatables/extensions/Buttons/js/buttons.colVis.min.js")?>"></script>
	<!--extension SELECT para DataTables -->
    <script src="<?php asset("bower_components/datatables/Select/js/dataTables.select.min.js")?>"></script>    
	<!--extension KEYTABLES para DataTables -->
	<script src="<?php asset("bower_components/datatables/extensions/keytable/dataTables.keyTable.min.js")?>"></script>    
	<!--scroller para datatables -->
	<!--	<script src="<?php asset("bower_components/datatables/extensions/scroller/js/dataTables.scroller.min.js")?>"></script>-->
    <!--Código JS para JQuery UI -->
    <script src="<?php asset("bower_components/jqueryUI/js/jquery-ui.min.js")?>"></script>
    
    <!--Plugin para Imprimir -->
    <script src="<?php asset("bower_components/jquery-PrintArea/jquery.PrintArea.js")?>"></script>	
	<!--Código custom JS para alertify -->
    <script src="<?php asset("bower_components/alertify/alertify.min.js")?>"></script>
	<!--NUEVO Código para Codigo de barra -->
    <script src="<?php asset("bower_components/jsBarcode/JsBarcode.all.min.js")?>"></script>
			
	<!--Código JS propio base -->
    <script src="<?php asset("bower_components/js/codigo_base.js")?>"></script>	    
    <!--Código JS propio para VENTAS -->
    <script src="<?php asset("bower_components/js/codigo_ventas.js")?>"></script>	
    		
</head>
<body>
	<div id="page-loader"><span class="preloader-interior"></span></div>
    <div id="wrapper"><!-- Inicio "wrapper" -->
        <!-- Navigation -->
<!--        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">-->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
				<!--boton tipo menu aparece solo en pantallas pequeñas-->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Menú de navegación</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
   				<a class="navbar-brand" href='<?php url("admin")?>'><img src="<?php asset("img/LogoMenuSup.png") ?>"> InfoDP Tienda</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right"> 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $_SESSION["user"];?>
					<img src="<?php asset("img/Fotos_usuarios/user.png") ?>" alt="" height="32" width="36">	
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a><i class="fa fa-user fa-fw"></i> <?php echo $_SESSION["nomyape"];?></a>
                        </li>                        
                        <!--Contiene el id del usuario en modo oculto -->
                        <input id="idUsuario" type="hidden" value="<?php echo $_SESSION['id'];?>">                     
                        <li>             
                        <a href="<?php url("usuarios/editar_perfil?id=".$_SESSION['id']) ?>"><i class="fa fa-gear fa-fw"></i> Perfil de Usuario</a>
                        </li>
                        <li class="divider"></li>
                        <li class="active"><a href='<?php url("login/cerrarSesion") ?>'><i class="fa fa-sign-out fa-fw"></i> Cerrar Sesión</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
<!--        <div class="navbar-default sidebar" role="navigation">-->
			<div class="collapse navbar-collapse sidebar" role="navigation">
                <div class="sidebar-nav ">
                    <ul class="nav" id="side-menu">                        
						<li>
                            <a href='<?php url("admin")?>'><i class="fa fa-home fa-fw"></i> Inicio</a>
                        </li>					                            
                        <li>
                            <a href='#'><i class="fa fa-money fa-fw"></i> Flujo de Dinero<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level collapse">
                                 <li>
                                    <a href='<?php url("flujodecajas")?>'>Movimientos</a>
                                </li>
                            </ul>
                        </li>                        
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Productos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href='<?php url("productos")?>'><strong>Productos</strong></a>
                                </li>
								<li>
                                    <a href='<?php url("rubros")?>'>Rubros</a>
                                </li>
                                <li>
                                    <a href='<?php url("generos")?>'>Géneros</a>
                                </li>                                
								<li>
                                    <a href='<?php url("categorias")?>'>Categorías</a>
                                </li>
								<li>
                                    <a href='<?php url("estilos")?>'>Estilos</a>
                                </li>
								<li>
                                    <a href='<?php url("marcas")?>'>Marcas</a>
                                </li>
								<li>
                                    <a href='<?php url("talles")?>'>Talles</a>
                                </li>								
								<li>
                                    <a href='<?php url("colores")?>'>Colores</a>
                                </li>
                            </ul>
                        </li>        
						<li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Control de Stock<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href='<?php url("existencias")?>'>Existencias</a>
                                </li>                                                                
                            </ul>
                        </li>                        
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href='<?php url("ventas/")?>'>Gestión de Ventas</a>    
                                </li>
                                <li>
                                    <a href='<?php url("devoluciones/")?>'> Devoluciones 
                                    </a>    
                                </li>                                
                                <li>
                                    <a href='<?php url("clientes")?>'>Clientes
                                    </a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                       
                        <li>
                            <a href="#"><i class="fa fa-truck fa-flip-horizontal fa-fw"></i> Compras<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href='<?php url("compras")?>'>Gestión de Compras
                                    </a>
                                </li>
                                <li>
                                    <a href='<?php url("proveedores")?>'>Proveedores</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                        
                        <li>
                            <a href="#"><i class="fa fa-line-chart fa-fw"></i> Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
                                <li>
                                    <a href='<?php url("reportes")?>'>Reportes Gráficos</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>                        
                        <li>
                            <a href="#"><i class="fa fa-cog fa-fw"></i> Config. del Sistema<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse">
								 <li>
                                    <a href='<?php url("parametros")?>'>Parámetros <i class="fa fa-wrench" aria-hidden="true"></i>
                                    </a> 
                                </li>
                                <li>
                                    <a href='<?php url("usuarios")?>'>Usuarios</a>    
                                </li>
                                <li>
                                    <a href='<?php url("comprobantes")?>'>Comprobantes</a>    
                                </li>
								<li>
                                    <a href='<?php url("tarjetas")?>'>Tarjetas</a>    
                                </li>
                                <li>
									<a href='<?php url("admin/backup") ?>'>Generar Backup <i class="fa fa-database fa-lg" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>		
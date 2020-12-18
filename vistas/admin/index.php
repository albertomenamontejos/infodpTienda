<?php
	include("vistas/includes/menuSupLimpio.php");
	include(CONTROLADORES.'CategoriaController.php');
	include(CONTROLADORES.'ProductoController.php');
	include(CONTROLADORES.'ClienteController.php');
	include(CONTROLADORES.'VentaController.php');
	include(CONTROLADORES.'UsuarioController.php');
	include(CONTROLADORES.'ProveedorController.php');
	include(CONTROLADORES.'MarcaController.php');
	include(CONTROLADORES.'GeneroController.php');
	include(CONTROLADORES.'CompraController.php');
	include(CONTROLADORES.'ComprobanteController.php');
?> 
<!-- Contenido Principal -->
<div id="page-wrapper">
    <div class="container-fluid">
	   <div  style="height:50px"></div>
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-rojo">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
								<?php
									$objeto = new ProductoController();
									$objeto->cantidad();
								?>
								</div>
								<div>Productos</div>
							</div>
						</div>
					</div>
					<a href='<?php url("productos/crear")?>'>
						<div class="panel-footer">
							<span class="pull-left">Nuevo</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-green cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-4x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
								<?php
									$objeto = new VentaController();
									$objeto->cantidad();
								?>
								</div>
								<div>Ventas</div>
							</div>
						</div>
					</div>
					<a href='<?php url("ventas/crear")?>'>
						<div class="panel-footer" style="color:#44B6AE">
							<span class="pull-left">Nueva</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
				<div class="col-lg-3 col-md-6">
				<div class="panel panel-azul cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-truck fa-flip-horizontal fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
								<?php
									$objeto = new CompraController();
									$objeto->cantidad();
								?>    
								</div>
								<div>Compras</div>
							</div>
						</div>
					</div>
					<a href='<?php url("compras/crear") ?>'>
						<div class="panel-footer">
							<span class="pull-left">Nueva</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>		
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-yellow cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-male fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
								<?php
									$objeto = new ClienteController();
									$objeto->cantidad();
								?>
								</div>
								<div>Clientes</div>
							</div>
						</div>
					</div>
					<a href='<?php url("clientes")?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>			
		</div>
		<div class="row">			
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-lila cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-bar-chart fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</div>
								<div>Reportes</div>
							</div>
						</div>
					</div>
					<a href='<?php url("reportes")?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div> 
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-celeste cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-suitcase fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?php
									$objeto = new ProveedorController();
									$objeto->cantidad();
									?>
								</div>
								<div>Proveedores</div>
							</div>
						</div>
					</div>
					<a href='<?php url("proveedores")?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>  
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-naranja cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-users fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
								 <?php
									$objeto = new UsuarioController();
									$objeto->cantidad();
								?>
								</div>
								<div>Usuarios</div>
							</div>
						</div>
					</div>
					<a href='<?php url("usuarios")?>'>
						<div class="panel-footer">
							<span class="pull-left">Ver más</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-bluedark cajasInicio">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-cog fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
								  <i class="fa fa-wrench" aria-hidden="true"></i>
								</div>
								<div>Parámetros</div>
							</div>
						</div>
					</div>
					<a href='<?php url("parametros")?>'>
						<div class="panel-footer">
							<span class="pull-left">Configurar el Sistema</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>        
    </div>
</div>
<!-- Contenido Principal -->
<?php
    include("vistas/includes/menuInferior.php");                               
  $nomyape = $_SESSION["nomyape"];    
    if ($_SESSION["valor"] == "true") {
        $_SESSION["valor"] = "false";
        echo "<script>alertify.warning('Conectado como: $nomyape');</script>";
    }               
?>
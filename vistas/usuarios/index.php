<?php
//comprobamos si tiene privilegios de admin para ver la pag - FUNCIONA OK
if($_SESSION["privilegio"] != "admin" || $_SESSION["user"] != "admin"){
	redireccionar("/admin/error");
}
include("vistas/includes/menuSupDataTable.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">                        
				<h2 class="hstyle">Usuarios</h2>
				<a href="<?php url("usuarios/crear") ?>" class="btn btn-redTienda"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</a>
				<hr>        
			</div>
		</div>	
		<div class="row">
			<div class="col-lg-12"> 
				<div class="table-responsive">    
				<table class="tabla table table-striped table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Usuario</th>
							<th>Nombre y Apellido</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>E-mail</th>
							<th>Rol</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($usuarios as $usuario) {
					?>
						<tr>
							<td><?php echo $usuario->user; ?></td>
							<td><?php echo $usuario->nomyape; ?></td>
							<td><?php echo $usuario->direccion; ?></td>
							<td><?php echo $usuario->telefono; ?></td>
							<td><?php echo $usuario->email; ?></td>
							<td><?php echo $usuario->privilegio; ?></td>
							<td>
							<div class='wrapper text-center'>	
							<div class="btn-group" role="group">
								<a href="<?php url("usuarios/editar?id=".$usuario->id) ?>" class="btn btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<button class="btn btn-danger" onclick="confirmar('<?php url("usuarios/eliminar?id=".$usuario->id) ?>')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>      								
							</div>    
							</div>	
						</td>
						</tr>
					<?php
					} ?>
					</tbody>
				</table>    
				</div>    
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<?php
include("vistas/includes/menuInferior.php");
//revisa que el registro sea eliminado o no, en el caso que esté asociado
if ($_SESSION["temp_elimina"] == "false") {
	echo "<script>     
				alertify.error('No se pudo eliminar!').delay(2);
		  </script>";
	$_SESSION["temp_elimina"] = "true";
}
?>    
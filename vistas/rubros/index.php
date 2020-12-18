<?php
include("vistas/includes/menuSupDataTable.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">                        
				<h2 class="hstyle">Rubros</h2>
				<a href="<?php url("rubros/crear") ?>" class="btn btn-redTienda"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</a>
			</div>
		</div>	
		<hr>
		<div class="row">
			<div class="col-lg-12">                        
				<div class="table-responsive">        
				<table  class="table table-striped table-hover table-condensed tabla" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Id</th>
							<th>Descripción</th>
							<th class="text-center">Acción</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($rubros as $rubro) {
					?>
						<tr>
							<td><?php echo $rubro->id; ?></td>
							<td><?php echo $rubro->descripcion; ?></td>
							<td>
							<div class='wrapper text-center'>	
								<div class="btn-group" role="group">
								<a href="<?php url("rubros/editar?id=".$rubro->id) ?>" class="btn btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

								<button class="btn btn-danger" onclick="confirmar('<?php url("rubros/eliminar?id=".$rubro->id) ?>')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>     
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
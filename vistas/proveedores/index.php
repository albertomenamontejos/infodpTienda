<?php
use \App\modelo\Parametro;
$parametro = Parametro::find("1");
include("vistas/includes/menuSupDataTable.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">                        
				<h2 class="hstyle">Proveedores</h2>
				<a href="<?php url("proveedores/crear") ?>" class="btn btn-redTienda"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</a>
			</div>
		</div>	
		<hr>
		<div class="row">
			<div class="col-lg-12">  
			<div class="table-responsive">  
				<table class="tabla table table-striped table-hover table-condensed" cellspacing="0" width="100%">	
					<thead>
						<tr>
							<th style="display:none;">Id</th>
							<th>Razón Social</th>
							<th>Dirección</th>
							<th>Teléfono</th>
							<th>E-mail</th>
							<th><?php echo $parametro->idenTributaria?></th>
							<th>Cond. Tributaria</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($proveedores as $proveedor) {
					?>
						<tr>
							<td style="display:none;"><?php echo $proveedor->id; ?></td>
							<td><?php echo $proveedor->razon_social; ?></td>
							<td><?php echo $proveedor->direccion; ?></td>
							<td><?php echo $proveedor->telefono; ?></td>
							<td><?php echo $proveedor->email; ?></td>
							<td><?php echo $proveedor->cuit; ?></td>
							<td>
								<?php
								switch($proveedor->condTributaria)
								{   
									case "RI":
										echo "RESPONSABLE INSCRIPTO" ;
										break;
									case "CF":
										echo "CONSUMIDOR FINAL" ;
										break;
									case "MT":
										echo "MONOTRIBUTISTA" ;
										break;	
								}
								?>
							</td>
							<td>
								<div class='wrapper text-center'>
								<div class="btn-group" role="group">
									<a href="<?php url("proveedores/editar?id=".$proveedor->id) ?>" class="btn btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<button class="btn btn-danger" onclick="confirmar('<?php url("proveedores/eliminar?id=".$proveedor->id) ?>')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>      
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
?>
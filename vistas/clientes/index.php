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
				<h2 class="hstyle">Clientes</h2>
				<a href="<?php url("clientes/crear") ?>" class="btn btn-redTienda"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</a>
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
							<th>Nombre y Apellido</th>
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
						foreach ($clientes as $cliente) {
					?>
						<tr>
							<td style="display:none;"><?php echo $cliente->id; ?></td>
							<td><?php echo $cliente->nomyape; ?></td>
							<td><?php echo $cliente->direccion; ?></td>
							<td><?php echo $cliente->telefono; ?></td>
							<td><?php echo $cliente->email; ?></td>
							<td><?php echo $cliente->cuit; ?></td>
							<td>
								<?php
								switch($cliente->condTributaria)
								{   
									case "RI":
										echo "RESPONSABLE INSCRIPTO" ;
										break;
									case "CF":
										echo "CONSUMIDOR FINAL" ;
										break;
								}
								?>
							</td>
							<td>
								<div class='wrapper text-center'>
								<div class="btn-group" role="group">
									<a href="<?php url("clientes/editar?id=".$cliente->id) ?>" class="btn btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
									<button class="btn btn-danger" onclick="confirmar('<?php url("clientes/eliminar?id=".$cliente->id) ?>')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></button>      
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
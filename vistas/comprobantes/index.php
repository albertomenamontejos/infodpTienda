<?php
include("vistas/includes/menuSupDataTable.php");
?>
<!-- Contenido Principal -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">                        
                <h2 class="hstyle">Comprobantes</h2>
                <a href="<?php url("comprobantes/crear") ?>" class="btn btn-redTienda"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</a>
                <hr>
                <div style="width: 100%; padding-left: -10px;">    
		        <div class="table-responsive">        
                <table class="tabla table table-striped table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th style="display:none;">Id</th>
                            <th>Descripción</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($comprobantes as $comprobante) {
                    ?>
                        <tr>
                            <td style="display:none;"><?php echo $comprobante->id; ?></td>
                            <td><?php echo $comprobante->descripcion; ?></td>
                            <td>
							<div class='wrapper text-center'>	
                                <div class="btn-group" role="group">
                                <a href="<?php url("comprobantes/editar?id=".$comprobante->id) ?>" class="btn btn-primary" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    
                                <a class="btn btn-danger" onclick="confirmar('<?php url("comprobantes/eliminar?id=".$comprobante->id) ?>')" data-toggle="tooltip" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></a>     
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
    </div>
<!-- Contenido Principal -->                    
<?php
include("vistas/includes/menuInferior.php");
//revisa que la categoria sea eliminada, es para el caso...
//en que algún prod sigue asociado
if ($_SESSION["temp_elimina"] == "false") {
	echo "<script>     
				alertify.error('No se pudo eliminar!').delay(2);
		  </script>";
	$_SESSION["temp_elimina"] = "true";
}
?>
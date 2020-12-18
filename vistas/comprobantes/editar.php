<?php
include("vistas/includes/menuSupLimpio.php");
?> 
<!-- Contenido Principal -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">                
                <hr>
                <div class="panel panel-azulTienda">
				  <div class="panel-heading">
					<h3 class="panel-title">Editar Comprobante</h3>
				  </div>
				  <form action="<?php url("comprobantes/editarcomprobante") ?>" method="POST" role="form">
					  <div class="panel-body">
								<input type="hidden" value="<?php echo $comprobante->id ?>" name="id">

								<div class="form-group">
									<label for="">Descripción</label>
									<input value="<?php echo $comprobante->descripcion ?>" name="txtDescripcion" type="text" class="form-control" id="" placeholder="" tabindex="1" required autofocus>    
								</div>
					  </div>
					  <div class="panel-footer clearfix">
						<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
						<button type="submit" class="btn btn-danger pull-right" tabindex="2"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
					  </div>
				  </form>
                </div>  
            </div>
            </div>
        </div>
    </div>
<!-- Contenido Principal -->
<?php
    include("vistas/includes/menuInferior.php");
?>
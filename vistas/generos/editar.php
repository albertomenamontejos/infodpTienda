<?php
	include("vistas/includes/menuSupLimpio.php");
?> 
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">		
		<hr>
		<div class="row">
			<div class="col-lg-12">
			<div class="panel panel-azulTienda">
			  <div class="panel-heading">
				<h3 class="panel-title">Editar Género</h3>
			  </div>
				<form action="<?php url("generos/editargenero") ?>" method="POST" role="form">
				  <div class="panel-body">          
					<input type="hidden" value="<?php echo $genero->id ?>" name="id">
					<div class="form-group">
						<label for="">Descripción</label>
						<input value="<?php echo $genero->descripcion ?>" name="txtDescripcion" type="text" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9_.,-]{1,30}" class="form-control" id="" placeholder="" tabindex="1" required autofocus>
						
					</div>
				  </div>
				 <div class="panel-footer clearfix">
					 <a class="btn btn-default pull-left" href="<?php $phpSelf = filter_input(INPUT_SERVER, 'HTTP_REFERER', FILTER_SANITIZE_URL); echo $phpSelf; ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a> 
					 <button name="botonSubmit" class="btn btn-danger pull-right" type="submit" tabindex="8"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>					 
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
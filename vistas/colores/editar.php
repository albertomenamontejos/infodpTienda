<?php
use App\modelo\Color;
use \App\modelo\Rubro;
use \App\modelo\Genero;
use \App\modelo\Categoria;
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
							<h3 class="panel-title">Editar Color</h3>
					  </div>
						 <form action="<?php url("colores/editarcolor") ?>" method="POST" role="form">
					  <div class="panel-body">            
						<input type="hidden" value="<?php echo $color->id ?>" name="id">
						<div class="row">
						<div class="col-lg-6 form-group">
							<label for="">Rubro</label>						
							<div class="input-group">	
							<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>	
							<select name="txtRubro" id="txtRubro" class="form-control" tabindex="1" autofocus>
							<?php
							$rubros = Rubro::all();
							foreach($rubros as $rubro) {
							?>
							<option value="<?php echo $rubro->id; ?>">
								<?php
									echo $rubro->descripcion;
								?>  
							</option>
							<?php    
							}
							?>								
							</select>
							<input name="txtIdRubro" id="txtIdRubro" value="<?php echo $color->idRubro;?>" type="hidden">
							</div>	
                    	</div>						
						<div class="col-lg-6 form-group">
							<label for="">Género</label>						
							<div class="input-group">					
							<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>		
							<select name="txtGenero" id="txtGenero" class="form-control" tabindex="2">
							<?php
							$generos = Genero::all();
							foreach($generos as $genero) {
							?>
							<option value="<?php echo $genero->id; ?>">
								<?php
									echo $genero->descripcion;
								?>  
							</option>
							<?php    
							}
							?>
							</select>
							<input name="txtIdGenero" id="txtIdGenero" value="<?php echo $color->idGenero;?>" type="hidden">
							</div>	
                    	</div>  
					  </div>
					  
					  <div class="row">
						<div class="col-lg-6 form-group">
							<label for="">Categoría</label>						
							<div class="input-group">	
							<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>	
							<select name="txtCategoria" id="txtCategoria" class="form-control" tabindex="3">
							<?php
							$categorias = Categoria::all();
							foreach($categorias as $categoria) {
							?>
							<option value="<?php echo $categoria->id; ?>">
								<?php
									echo $categoria->descripcion;
								?>  
							</option>
							<?php    
							}
							?>	
							</select>
							<input name="txtIdCategoria" id="txtIdCategoria" value="<?php echo $color->idCategoria;?>" type="hidden">
							</div>	
                    	</div>    						  
						<div class="col-lg-6 form-group">
							<label for="">Descripción</label>
							<input name="txtDescripcion" type="text" class="form-control" id="txtDescripcion" value="<?php echo $color->descripcion?>" tabindex="4" required>    
						</div> 
					  </div> 
						
					  </div>
					  <div class="panel-footer clearfix">
							<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
							<button type="submit" class="btn btn-danger pull-right" tabindex="5"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
					  </div>
				   </form>			 
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<script type="text/javascript">
$(document).ready(function() {
	$('#txtRubro > option[value="<?php echo $color->idRubro; ?>"]').attr('selected', 'selected');
	$('#txtGenero > option[value="<?php echo $color->idGenero; ?>"]').attr('selected', 'selected');	
	$('#txtCategoria > option[value="<?php echo $color->idCategoria; ?>"]').attr('selected', 'selected');  	
	
	$('#txtIdRubro').val(<?php echo $color->idRubro; ?>);		
	$('#txtIdGenero').val(<?php echo $color->idGenero; ?>);	
	$('#txtIdCategoria').val(<?php echo $color->idCategoria; ?>);		
	
	$('select#txtRubro').on('change',function(){			
		idRubro = $(this).val();						 
		$('#txtIdRubro').val(idRubro);			
	});    	
	$('select#txtGenero').on('change',function(){			
		idGenero = $(this).val();					
		$('#txtIdGenero').val(idGenero);
	});		
	$('select#txtCategoria').on('change',function(){			
		 idCategoria = $(this).val();			
	   $('#txtIdCategoria').val(idCategoria);
	});
	
});	
</script>	
<?php
    include("vistas/includes/menuInferior.php");
?>
<?php
use App\modelo\Talle;
use \App\modelo\Rubro;
use \App\modelo\Genero;
use \App\modelo\Categoria;
include("vistas/includes/menuSupABM.php");
?> 
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">		
		<hr>
		<div class="row">
			<div class="col-lg-12">
			<div class="panel panel-azulTienda">
				  <div class="panel-heading">
						<h3 class="panel-title">Nuevo Talle</h3>
				  </div>
				  <form class="formTalles" action="<?php url("talles/creartalle") ?>" method="POST" role="form">
				  <div class="panel-body">
					  <div class="row">
						<div class="col-lg-6 form-group">
							<label for="">Rubro</label>						
							<div class="input-group">	
							<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>	
							<select name="txtIdRubro" id="txtIdRubro" class="form-control" tabindex="1" autofocus>
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
							</div>	
                    	</div>						
						<div class="col-lg-6 form-group">
							<label for="">Género</label>						
							<div class="input-group">					
							<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>		
							<select name="txtIdGenero" id="txtIdGenero" class="form-control" tabindex="2">
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
							</div>	
                    	</div>  
					  </div>					  
					  <div class="row">
						<div class="col-lg-6 form-group">
							<label for="">Categoría</label>						
							<div class="input-group">	
							<span class="input-group-addon"><i class="fa fa-check-circle fa-fw"></i></span>	
							<select name="txtIdCategoria" id="txtIdCategoria" class="form-control" tabindex="3">
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
							</div>	
                    	</div>    						  
						<div class="col-lg-6 form-group">
							<label for="">Descripción</label>
							<input name="txtDescripcion" type="text" class="form-control" id="txtDescripcion" placeholder="Nombre" tabindex="4" style="text-transform:uppercase" required>    
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
<script>		
$('button[type="submit"]').on('click', function(e){
	e.preventDefault(); //bloqueamos evento submit	
	//nuevo control duplicados TALLES
	var idRubroT;
	var idGeneroT;	
	var idCategoriaT;		
	var descT;	
	
	idRubroT = $("#txtIdRubro").val();
	$('select#txtIdRubro').on('change',function(){			
	idRubroT = $(this).val();						 	
	});  		
	idGeneroT = $("#txtIdGenero").val();
	$('select#txtIdGenero').on('change',function(){			
	idGeneroT = $(this).val();						 	
	});  	
	idCategoriaT = $("#txtIdCategoria").val();
	$('select#txtIdCategoria').on('change',function(){				
	idCategoriaT = $(this).val();						 		
	});  		
	checkTalle = "buscadupli";		

	descT = $.trim($("#txtDescripcion").val().toUpperCase());	
	if($.isNumeric(descT)){					
		descri=parseFloat(descT);
	}else{
		descri=descT.toString();
	}	
	$.ajax({
		url: "../libreria/ORM/consulta_talles.php",
		type: "POST",
		datatype:"json",    
		data: {idRubro:idRubroT, idGenero:idGeneroT, idCategoria:idCategoriaT, checkTalle:checkTalle},    
		success: function(data) {									
			var datos = JSON.parse(data); 				 		
			var talles=[];			
			for (var i = 0; i < datos.length; i++) {											
				talles.push(datos[i].descripcion);					
			}		
			if ($.inArray(descri,talles) != -1) {
				alertify.error("¡El Talle ya existe!");						
				e.preventDefault();
			}else{
				$('form').trigger("submit"); //lanzamos evento submit
			}
		}		
	});		
});	
</script>
<?php
    include("vistas/includes/menuInferior.php");
?>
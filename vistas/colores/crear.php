<?php
use App\modelo\Color;
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
						<h3 class="panel-title">Nuevo Color</h3>
				  </div>
				  <form class="formColores" action="<?php url("colores/crearcolor") ?>" method="POST" role="form">
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
	e.preventDefault(); //bloqueamos evento click
	//nuevo control duplicados COLORES
	var idRubroC;
	var idGeneroC;	
	var idCategoriaC;		
	var descC;	

	idRubroC = $("#txtIdRubro").val();
	$('select#txtIdRubro').on('change',function(){			
	idRubroC = $(this).val();						 	
	});  		
	idGeneroC = $("#txtIdGenero").val();
	$('select#txtIdGenero').on('change',function(){			
	idGeneroC = $(this).val();						 	
	});  	
	idCategoriaC = $("#txtIdCategoria").val();
	$('select#txtIdCategoria').on('change',function(){				
	idCategoriaC = $(this).val();						 		
	});  		
	checkColor = "buscadupli";		

	descC = $.trim($("#txtDescripcion").val().toUpperCase());	
	if($.isNumeric(descC)){					
		descri=parseFloat(descC);
	}else{
		descri=descC.toString();
	}	
	$.ajax({
	url: "../libreria/ORM/consulta_colores.php",
	type: "POST",
	datatype:"json",    
	data: {idRubro:idRubroC, idGenero:idGeneroC, idCategoria:idCategoriaC, checkColor:checkColor},    
	success: function(data) {									
		var datos = JSON.parse(data); 				 		
		var colores=[];
		for (var i = 0; i < datos.length; i++) {											
			colores.push(datos[i].descripcion);					
		}		
		if ($.inArray(descri,colores) != -1) {
			alertify.error("¡El Color ya existe!");								
			e.preventDefault();//bloqueamos evento submit
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
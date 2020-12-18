<?php
    use App\modelo\Categoria;
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
						<h3 class="panel-title">Nuevo Estilo</h3>
				  </div>
				 <form action="<?php url("estilos/crearestilo") ?>" method="POST" role="form">
					 
				<?php if (isset($estilo)) {?>
					<input type="hidden" value="<?php echo $estilo->id ?>" name="id">
				<?php }?>	 
					 
				  <div class="panel-body">
					<div class="form-group">
						<label for="">Descripción</label>
						<input name="txtDescripcion" id="txtDescripcion" type="text" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9_-]{1,30}" class="form-control" placeholder="Nombre del estilo" value="<?php echo isset($estilo) ? $estilo->descripcion : '' ?>" tabindex="1" required autofocus>			
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
<script>	
	$('button[type="submit"]').on('click', function(e){
		e.preventDefault(); //bloqueamos evento submit				
		var descT;		
		var option = "5";
		descT = $.trim($("#txtDescripcion").val().toUpperCase());	
		if($.isNumeric(descT)){					
			descri=parseFloat(descT);
		}else{
			descri=descT.toString();
		}	
		$.ajax({		
			url: "../libreria/ORM/consulta_duplicados.php",
			type: "POST",
			datatype:"json",    
			data: {option:option},    
			success: function(data) {				
				var datos = JSON.parse(data); 				 		
				var valores=[];				
				for (var i = 0; i < datos.length; i++) {											
					valores.push(datos[i].descripcion);					
				}					
				if ($.inArray(descri,valores) != -1) {
					alertify.error("¡La descripción ya existe!");						
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
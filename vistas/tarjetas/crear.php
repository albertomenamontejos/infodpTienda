<?php
use App\modelo\Tarjeta;
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
						<h3 class="panel-title">Nueva Tarjeta</h3>
				  </div>
						<form action="<?php url("tarjetas/creartarjeta") ?>" method="POST" role="form">
				  <div class="panel-body">
					<div class="form-group">
						<label for="">Descripción</label>
						<input name="txtDescripcion" type="text" class="form-control" id="txtDescripcion" placeholder="Nombre" tabindex="1" required autofocus>    
					</div>   
				  </div>
				  <div class="panel-footer clearfix">
						<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
						<button type="submit" class="btn btn-danger pull-right" tabindex="8"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
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
		var option = "8";
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
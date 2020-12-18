<?php
	use \App\modelo\Parametro;
 	$parametro = Parametro::find("1");
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
					<h3 class="panel-title">Nuevo Cliente</h3>
			  </div>
			  <form action="<?php url("clientes/crearcliente") ?>" method="POST" role="form">				  
			  <div class="panel-body">  
					<div class="form-group">
						<label for="">Nombre y Apellido</label>
						<input name="txtNomyape" type="text"  pattern="[A-Z a-z0-9_-]{1,30}" class="form-control" id="txtNomyape" placeholder="Nombre del cliente" tabindex="1" autofocus required>

						<label for="">Dirección</label>
						<input name="txtDireccion" id="txtDireccion" type="text" class="form-control" placeholder="Dirección" tabindex="2" required>

						<label for="">Teléfono</label>
						<input name="txtTelefono" id="txtTelefono" type="text" class="form-control" placeholder="Teléfono" tabindex="3" required>

						<label for="">E-mail</label>
						<input name="txtEmail" id="txtEmail" type="email" class="form-control" placeholder="E-Mail" tabindex="4" required>

						<label for=""><?php echo $parametro->idenTributaria?></label>
						<input name="txtCuit" id="txtCuit" type="text" class="form-control" placeholder="Número" tabindex="5" required>

						<label for="txtCondTributaria">Condición frente al IVA</label>
						<select name="txtCondTributaria" id="txtCondTributaria" class="form-control" tabindex="6" required>
<!--							<option value="" selected disabled></option>-->
							<option value="CF">CONSUMIDOR FINAL</option>	
							<option value="RI">RESPONSABLE INSCRIPTO</option>
						</select>	
						
					</div>
			   </div>
			   <div class="panel-footer clearfix">
					<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
					<button type="submit" class="btn btn-danger pull-right" tabindex="7"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
			   </div>
			  </form>
			</div>  
		</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<script>
	$('form').submit(function(){    
	var var_nomyape = $.trim($('#txtNomyape').val());
	var var_direccion = $.trim($('#txtDireccion').val());
	var var_telefono = $.trim($('#txtTelefono').val());
	var var_email = $.trim($('#txtEmail').val());	
	var var_cuit = parseFloat($.trim($('#txtCuit').val()));		
	var var_condTributaria = $.trim($('#txtCondTributaria').val());		
	
	if(var_cuit == 0 || var_cuit == ""){
		alertify.warning("El CUIT no puede ser 0.");			
		return false;
	}
	if(var_telefono == 0 || var_telefono == ""){
		alertify.warning("El teléfono no puede ser 0.");			
		return false;
	}	
	if(var_nomyape == "" || var_direccion == "" || var_telefono == "" || var_email == "" || var_condTributaria == ""){
		alertify.warning("Debe completar los campos.");			
		return false;
	}	
	});
</script>
<?php
    include("vistas/includes/menuInferior.php");
?>
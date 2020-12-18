<?php    
if ($_SESSION["privilegio"] != "admin"){
	redireccionar("/admin/error");
}
use \App\modelo\Parametro;
$parametro = Parametro::find("1");
include("vistas/includes/menuSupLimpio.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
    <div class="container-fluid">
		<hr>
		<form role="form" action="<?php url("parametros/actualizarparametros") ?>" method="post" role="form" enctype="multipart/form-data">
        <div class="row">               
        	<div class="col-lg-12">     
                    <div class="panel panel-azulTienda">
                        <div class="panel-heading">Datos de la Empresa</div>
                        <div class="panel-body">
                            <input id="id" name="id" value="<?php echo $parametro->id; ?>" style="display:none;">
                            <div class="col-lg-6 form-group">
								<label for="">Nombre</label>
								<div class="input-group">
                                <span class="input-group-addon cajaParametro"><i class="fa fa-building fa-fw"></i> </span><strong><input class="form-control" placeholder="" name="txtNombreEmpresa" id="txtNombreEmpresa" type="text" autocomplete="on" autofocus tabindex="1" value="<?php echo $parametro->nombre_empresa; ?>" required></strong>
								</div>
                            </div>                                 
                            <div class="col-lg-6 form-group">
								<label for="">Rubro</label>
								<div class="input-group">
                                <span class="input-group-addon cajaParametro"><i class="fa fa-university fa-fw"></i> </span><input class="form-control" placeholder="" name="txtRubro" id="txtRubro" type="text" autocomplete="on" autofocus tabindex="2" value="<?php echo $parametro->rubro; ?>" required>
								</div>	
                            </div>                                 
                            <div class="col-lg-6 form-group">
								<label for=""><?php echo $parametro->idenTributaria;?></label>
								<div class="input-group">
									<span class="input-group-addon cajaParametro"><i class="fa fa-building fa-fw"></i></span><input class="form-control" placeholder="" name="txtCuit" id="txtCuit" type="text" autocomplete="on" autofocus tabindex="3" value="<?php echo $parametro->cuit; ?>" required>
								</div>	
                            </div>                                 
                            <div class="col-lg-6 form-group">
								<label for="">Domicilio</label>
								<div class="input-group">
                                <span class="input-group-addon cajaParametro"><i class="fa fa-map-marker fa-fw"></i> </span><input class="form-control" placeholder="" name="txtDomicilio" id="txtDomicilio" type="text" autocomplete="on" autofocus tabindex="4" value="<?php echo $parametro->domicilio_comercial; ?>" required>
								</div>	
                            </div>                                 
                            <div class="col-lg-6 form-group">
								<label for="">Teléfono</label>
								<div class="input-group">
                                <span class="input-group-addon cajaParametro"><i class="fa fa-phone-square fa-fw"></i> </span><input class="form-control" placeholder="" name="txtTelefono" id="txtTelefono" type="text" autocomplete="on" autofocus tabindex="5" value="<?php echo $parametro->telefono; ?>" required>
								</div>	
                            </div>                                 
                            <div class="col-lg-6 form-group">
								<label for="">E-mail</label>
								<div class="input-group">
                                <span class="input-group-addon cajaParametro"><i class="fa fa-envelope-o fa-fw"></i></span><input class="form-control" placeholder="" name="txtEmail" id="txtEmail" type="text" autocomplete="on" autofocus tabindex="6" value="<?php echo $parametro->email; ?>" required>
								</div>	
                            </div>    							
							<div class="col-lg-6 form-group">
								<label for="">País/Ubicación</label>
								<div class="input-group">
                                <span class="input-group-addon cajaParametro"><i class="fa fa-globe fa-fw"></i></span>
								<select name="txtPais" id="txtPais" class="form-control" tabindex="7">
									<option <?php if ($parametro->pais == "AR" ) echo 'selected' ; ?> value="AR">Argentina</option>
									<option <?php if ($parametro->pais == "BL" ) echo 'selected' ; ?> value="BL">Bolivia</option>
									<option <?php if ($parametro->pais == "BR" ) echo 'selected' ; ?> value="BR">Brasil</option>
									<option <?php if ($parametro->pais == "CL" ) echo 'selected' ; ?> value="CL">Chile</option>
									<option <?php if ($parametro->pais == "CO" ) echo 'selected' ; ?> value="CO">Colombia</option>
									<option <?php if ($parametro->pais == "CR" ) echo 'selected' ; ?> value="CR">Costa Rica</option>
									<option <?php if ($parametro->pais == "CU" ) echo 'selected' ; ?> value="CU">Cuba</option>
									<option <?php if ($parametro->pais == "EC" ) echo 'selected' ; ?> value="EC">Ecuador</option>
									<option <?php if ($parametro->pais == "ES" ) echo 'selected' ; ?> value="ES">España</option>
									<option <?php if ($parametro->pais == "HO" ) echo 'selected' ; ?> value="HO">Honduras</option>
									<option <?php if ($parametro->pais == "MX" ) echo 'selected' ; ?> value="MX">México</option>
									<option <?php if ($parametro->pais == "NI" ) echo 'selected' ; ?> value="NI">Nicaragua</option>
									<option <?php if ($parametro->pais == "PY" ) echo 'selected' ; ?> value="PY">Paraguay</option>					
									<option <?php if ($parametro->pais == "PA" ) echo 'selected' ; ?> value="PA">Panamá</option>					
									<option <?php if ($parametro->pais == "PE" ) echo 'selected' ; ?> value="PE">Perú</option>							
									<option <?php if ($parametro->pais == "PR" ) echo 'selected' ; ?> value="PR">Puerto Rico</option>					
									<option <?php if ($parametro->pais == "RD" ) echo 'selected' ; ?> value="RD">República Dominicana</option>			
									<option <?php if ($parametro->pais == "UY" ) echo 'selected' ; ?> value="UY">Uruguay</option>						
									<option <?php if ($parametro->pais == "VE" ) echo 'selected' ; ?> value="VE">Venezuela</option>					
								</select>
								</div>	
                        	</div>
							<div class="col-lg-6 form-group">
								<label for="">Imprimir</label>
								<div class="input-group">
								<span class="input-group-addon cajaParametro"><i class="fa fa-print fa-fw"></i></span>
								<select name="txtModoPrint" id="txtModoPrint" class="form-control" tabindex="8">
								<option <?php if ($parametro->modo_impresion == "F" ) echo 'selected' ; ?>  value="F">Modo Factura</option>
								<option <?php if ($parametro->modo_impresion == "T" ) echo 'selected' ; ?>  value="T">Modo Ticket</option>													
								</select>
								</div>	
                            </div> 
                        </div>                            
                   </div>  
                 </div>   
		</div>		
		<div class="row">	
			<div class="col-lg-6">
				 <div class="panel panel-azulTienda">
					<div class="panel-heading">Datos Impositivos</div>
					<div class="panel-body">
					   <div class="col-lg-6 form-group">
							<label for="">Nombre del Impuesto</label>
							<div class="input-group">
							<span class="input-group-addon cajaParametro"><i class="fa fa-calculator fa-fw"></i></span><strong><input class="form-control" placeholder="" name="txtNombreImpuesto" id="txtNombreImpuesto" type="text" autocomplete="on" tabindex="9" value="<?php echo $parametro->nombre_impuesto; ?>" style="text-transform:uppercase" required></strong>
						   </div>	
						</div>     
						<div class="col-lg-6 form-group" id="cajaIVA">
							<label for="txtCondicionIVA">Condición frente al IVA</label>
							<select name="txtCondicionIVA" id="txtCondicionIVA" class="form-control" tabindex="9">
								<option <?php if ($parametro->condicionIVA == "RI" ) echo 'selected' ; ?> value="RI">Resp. Inscripto</option>
								<option <?php if ($parametro->condicionIVA == "MT" ) echo 'selected' ; ?> value="MT">Monotributista</option>
							</select>
						</div>	
						<div class="col-lg-6 form-group" id="cajaAlicuota">
							<label for="">Alícuota</label>
							<div class="input-group">
							<span class="input-group-addon cajaParametro"><i class="fa fa-percent fa-fw"></i> </span><strong><input class="form-control" placeholder="" name="txtPorcentajeImpuesto" id="txtPorcentajeImpuesto" type="number" min="0" step="any" autocomplete="on" tabindex="10" value="<?php echo $parametro->porcentaje_impuesto; ?>" required></strong>
							</div>	
						</div>     
						<div class="col-lg-6 form-group">
						  <label for="">Identificación Tributaria</label>
						  <div class="input-group">	
						  <span class="input-group-addon cajaParametro"><i class="fa fa-wpforms fa-fw"></i></span>
						  <strong><input id="txtIdenTributaria" name="txtIdenTributaria" class="form-control" tabindex="11" value="<?php echo $parametro->idenTributaria; ?>" style="text-transform:uppercase" required></strong>
						  </div>	  
						</div>   
						<div class="col-lg-6 form-group">
						  <label for="">Símbolo de Moneda</label>
						  <div class="input-group">	
						  <span class="input-group-addon cajaParametro"><i class="fa fa-usd fa-fw"></i></span>
						  <strong><input id="txtMoneda" name="txtMoneda" class="form-control" tabindex="12" value="<?php echo $parametro->moneda; ?>" required></strong>
						  </div>	  
						</div> 
						<div class="col-lg-6 form-group">
						  <label for="">Punto de Venta</label>
						  <div class="input-group">	
						  <span class="input-group-addon cajaParametro"><i class="fa fa-calendar-o fa-fw"></i></span>
						  <strong><input id="txtPuntoVenta" name="txtPuntoVenta" class="form-control" tabindex="13" value="<?php printf("%04d",$parametro->puntoVenta);?>" required></strong>
						  </div>	  
						</div> 
						<div class="col-lg-6 form-group">
						  <label for="">Ingresos Brutos</label>
						  <div class="input-group">	
						  <span class="input-group-addon cajaParametro"><i class="fa fa-list fa-fw"></i></span>
						  <strong><input id="txtIngBrutos" name="txtIngBrutos" class="form-control" tabindex="14" value="<?php echo $parametro->ingresos_brutos;?>" required></strong>
						  </div>	  
						</div>  
						<div class="col-lg-6 form-group">
						  <label for="">Fec. de Inicio de Act.</label>
						  <div class="input-group">	
						  <strong><input id="txtfecIniAct" name="txtfecIniAct" type="date" class="form-control" tabindex="15" value="<?php echo $parametro->fecIniAct; ?>" required></strong>
						  </div>	  
						</div>
					</div>	
				</div>    
			</div>
			<div class="col-lg-6">
				 <div class="panel panel-azulTienda">
					<div class="panel-heading">Imagen Logo</div>
					<div class="panel-body">
					<div class="col-lg-12 form-group">
							<label for="">Logo</label>
							<span class="label label-primary">La imagen debe ser de 76 x 76</span>     
							<div class="input-group">
							 <span class="input-group-addon cajaParametro"><i class="fa fa-picture-o fa-fw"></i> </span>
							<input class="form-control" type="file" name="txtLogo" id="txtLogo" tabindex="16"/>  
							</div>  
							<div class="form-group">    
								<br>	
								<div class="thumbnail">
									<!--Foto de 76 x 76 -->
									<!--<img src="assets/img/Logo-impresion.png" alt="logo">-->
								<img src="<?php echo $parametro->logo_ruta; ?>" alt="logo">	
								</div>
							</div> 
						</div>
					</div>  
					 <div style="height:35px;">
					 </div>
					<div class="panel-footer clearfix">
						<a class="btn btn-default pull-left" href="<?php url("admin")?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  	
						<button type="submit" class="btn btn-danger pull-right" id="btnRegistrarParametros" tabindex="17"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>    
					</div> 
				</div>    
			</div>
        </div>
		</form> 
    </div>
</div>
<!-- Contenido Principal -->
<script>
	//Para cambio de pais	
	$('select[name="txtPais"]').on("change", function() {
		if($('select[name="txtPais"]').val() !== "AR"){
			//$('#txtCondicionIVA').prop('disabled', true);			
			$('#cajaIVA').hide(); //ocultamos para que no haya posibilidad de ingreso
			$('select[name="txtCondicionIVA"]').val('NI'); //valor NI ninguna
			$('#txtPorcentajeImpuesto').val("18.00");
			$('#txtIngBrutos').val("NO");
			$('#cajaAlicuota').show();						
		}else{			
			$('#cajaIVA').show();
			$('#txtNombreImpuesto').val("IVA");
			$('select[name="txtCondicionIVA"]').val('RI');
			$('#txtPorcentajeImpuesto').val("21.00");			
			$('#txtMoneda').val("$");
			$('#txtIdenTributaria').val("CUIT");
			$('#txtIngBrutos').val("NO");
			$('#txtCondicionIVA').prop('disabled', false);			
		}
	});		
	//Para cuando cambia el combo select a Monotributista
	$('select[name="txtCondicionIVA"]').on("change", function() {
		if($('select[name="txtCondicionIVA"]').val() == "MT"){
			$('#txtPorcentajeImpuesto').val("0.00");
			$('#cajaAlicuota').hide();
			//$('#txtPorcentajeImpuesto').prop('disabled', true);				
		}else{
			$('#txtPorcentajeImpuesto').val("21.00");
			$('#cajaAlicuota').show();
		}	
	});		
	//Para cuando carga la pagina cambia a Monotributista
	if($('select[name="txtCondicionIVA"]').val() == "MT"){	
			$('#cajaAlicuota').hide();
	}
	if($('select[name="txtPais"]').val() != "AR"){	
			$('#txtCondicionIVA').prop('disabled', true);			
			$('select[name="txtCondicionIVA"]').val('NI');
			$('#cajaAlicuota').show();
			$('#cajaIVA').hide();			
	}	 
	if (parseFloat($("#txtPorcentajeImpuesto").val()).toFixed(2) < 0){	
		alertify.warning("Debe ingresar valores positivos");
		$("#txtPorcentajeImpuesto").focus();
	}              

	var size_Logo = 0;
	var tamanio_Max = 1048576; // 1 MB
	$('#txtLogo').bind('change', function() {		  
		size_Logo = this.files[0].size;		  
	});
	$('form').submit(function(){		
		if(size_Logo > tamanio_Max){
			alertify.error('El logo debe ser menor a 1 MB');
			return false;
		}				
	}); 		
</script>
<?php
    include("vistas/includes/menuInferior.php");
?>
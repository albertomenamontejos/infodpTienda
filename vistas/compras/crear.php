<?php
use \App\modelo\Producto;
use \App\modelo\Proveedor;
use \App\modelo\Comprobante;
use \App\modelo\Tarjeta;
use \App\modelo\Existencia;

use \App\modelo\Parametro;
$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupCompras.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
			<hr>
            <div class="col-lg-7"> 
				<div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-barcode"></i>  COMPRAS </h3> 
                    </div>
                    <div class="panel-body" style="height:390px;overflow-y:auto"> 
						<div class="row">
						<div class="col-lg-12">                        
							<div style="width: 100%; padding-left: -10px;">    
							<div class="table-responsive">  
							<table id="tabla_productos" class="table-hover table-bordered table-condensed" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Id</th>
									<th>Cod.</th>
									<th>Nombre</th>
									<th>Precio C.</th>						
									<th>Acción</th>
								</tr>
							</thead>
						    </table>               
							</div>
							</div>
						</div>
					</div>
					</div>
					<div class="panel-footer clearfix">    
					</div>	
				</div>				
            </div>
			
            <div class="col-lg-5">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money"></i>  Importes </h3>
                    </div>
                    <div class="panel-body" style="height:357px;">
						 <div class="row">
                          <div class="form-group col-lg-12">
							  <div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
							  <strong><input type="text" class="form-control" value="0.00" id="txtTotalCompra" placeholder="Total" disabled></strong>
                          </div>
						</div>
						</div> 				     
						<div class="row">
						 <div class="form-group col-lg-6">
							<input id="porcentaje_imp" value="<?php echo $parametro->porcentaje_impuesto; ?>" style="display:none"> 
                            <label for=""><strong><?php echo $parametro->nombre_impuesto; ?></strong> del <strong><?php echo $parametro->porcentaje_impuesto; ?></strong>  %</label>
							<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
								<input type="text" class="form-control text-center" id="txtImpuestoCompra" name="txtImpuestoCompra" value="0.00" disabled>
							</div>	
                        </div> 						
						<div class="form-group col-lg-6">
                            <label for="">Sub-Total Neto</label>
                            <div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
                            	<input type="text" class="form-control text-center" id="txtSubTotalCompra" name="txtSubTotalCompra" value="0.00" disabled>
								</div>   
                        </div>
						</div>						
						<div class="row">
						<?php
							//para mostrar fecha actual
						  $timezone = "America/Argentina";
						  date_default_timezone_set($timezone);
						  $hoy = date("Y-m-d");
						?>
                        <div class="col-lg-6 form-group">
                            <div class="input-group">
							<label for="">Fecha</label>
                            <input class="form-control" name="txtFechaActual" type="date" id="txtFechaActual" value="<?php echo $hoy; ?>" >
                            </div>    
                        </div>							
						 <?php
                        //if (empty(end($compras))){
						  if (end($compras) == false){
                            $txtNroCompra = 1;
                        }else{
                            $last = end($compras);
                            $last->nroCompra = $last->nroCompra + 1;    
                            $txtNroCompra = $last->nroCompra;
                        }
                        ?>
						<div class="form-group col-lg-6">
							<label for="">Nro. de Compra</label>
							<div class="input-group">								
							<input type="text" class="form-control text-center" id="txtNroCompra" placeholder="Compra" value="<?php echo sprintf('%06d', $txtNroCompra); ?>"  disabled>
							</div>	
						</div>
						</div>						
						<div class="row">
                         <?php
                            $busqueda = Proveedor::where("cuit", "1");    
                            foreach ($busqueda as $proveedor){}
                        ?>
                        <input id="idProveedor" value="<?php echo $proveedor->id; ?>" type="hidden">   
                        <div class="col-lg-7 form-group">
							<label for="razonSocial">Razón Social</label> 
							<div class="input-group">
                              <input type="text" class="form-control" id="razonSocial" name="razonSocial" placeholder="Razón Social" tabindex="" value="<?php echo $proveedor->razon_social; ?>" disabled style="padding:5px;">
							 <span class="input-group-btn">
							<button class="btn btn-naranja" id="btnBuscarProveedor"><span class="fa fa-search-plus" aria-hidden="true"></span></button>
						  	</span>
							</div>		
                        </div>
                        <div class="col-lg-5 form-group">
                            <label for="cuit"><?php echo $parametro->idenTributaria?></label>
							<div class="input-group">
                            <input type="text" class="form-control" id="cuitProveedor" name="cuitProveedor" placeholder="Ident. Tributaria" value="<?php echo $proveedor->cuit; ?>" tabindex="" disabled>
							</div>	
                        </div>
						<div class="col-lg-12 pull-right form-group">
                           <label for="">Condic. Tributaria</label>
                           <input type="text" class="form-control" id="txtCondTribuP" name="txtCondTribuP" tabindex="3" value="<?php switch($proveedor->condTributaria)
								{   
									case "RI":
										echo "RESPONSABLE INSCRIPTO" ;
										break;
									case "CF":
										echo "CONSUMIDOR FINAL" ;
										break;
									case "MT":
										echo "MONOTRIBUTISTA" ;
										break;	
								} ?>" placeholder="Condic. Tributaria" disabled>
                        </div>  	
                        </div>						
                    </div>
					<div class="panel-footer padding0 clearfix">
						<button class="btn btn-default" id="btnFormaDePagoCompras" name="btnFormaDePagoCompras"><span class="fa fa-credit-card" aria-hidden="true"></span> Formas de Pago</button> 	
						<button class="btn btn-naranja pull-right" id="btnRegistrarCompra" disabled><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirmar</button>	
					</div>	
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table id="tablaCompras" class="table table-hover table-responsive">
                    <thead>
						<th style="display:none;">IdExis</th>
                        <th style="display:none;">IdProd</th>
                        <th class="text-center">Cod.</th>
                        <th class="text-center">Nombre</th>
						<th class="text-center">Talle</th>
						<th class="text-center">Color</th>
                        <th class="text-center">Cant.</th>
                        <th class="text-center">Precio U.</th>
                        <th class="text-center">Desc. (%)</th>
						<!-- muestro el impuesto que se define en el modulo "Parámetros"-->
						<th class="text-center"><?php echo $parametro->nombre_impuesto; ?> del <?php echo $parametro->porcentaje_impuesto; ?>  %</th>
						<th class="text-center">Sub-Tot Neto</th>						
                        <th class="text-center">Sub-Tot</th>
                        <th class="text-center"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></th>
                    </thead>
                    <tbody class="text-center"> 
                    </tbody>
                </table>              
            </div>
        </div>
        <hr>
        <form class="form" role="form" id="frmPagosCompras" style="display:none;">  
            <div class="col-lg-12">
                  <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                    </div>
                    <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">                
                                <div class="form-group col-lg-4">
                                <!-- prev porque es previo a confirmar la forma de pago   -->
                                <input name="prevIdFpC" id="prevIdFpC" style="display:none;">
                                <label class="control-label" for="prevFormaPagoC">Formas de Pago</label>
                                <input name="prevFormaPagoC" id="prevFormaPagoC" class="form-control" disabled>
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevComprobanteC">Tipo de Comp.</label>
                                <input name="prevComprobanteC" id="prevComprobanteC" class="form-control" disabled>
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevNroCompProvC">Nro de Comp.</label>
                                <input name="prevNroCompProvC" id="prevNroCompProvC" class="form-control" disabled>
                                </div>
								<div class="form-group col-lg-4">
                                <label class="control-label" for="prevEfectivoC">Pago Efectivo</label>
								<div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
									<input name="prevEfectivoC" id="prevEfectivoC" class="form-control" disabled>
								</div>	
                                </div>
								<div class="form-group col-lg-4">
                                <label class="control-label" for="prevTDC">Pago con Débito</label>
                                <div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
									<input name="prevTDC" id="prevTDC" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevTCC">Pago con Crédito</label>
                                <div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
									<input name="prevTCC" id="prevTCC" class="form-control" disabled>
								</div>	
                                </div>   
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevTDnombreC">Tarj. de Débito</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>	
                                	<input name="prevTDnombreC" id="prevTDnombreC" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevTCnombreC">Tarj. de Crédito</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>	
                                	<input name="prevTCnombreC" id="prevTCnombreC" class="form-control" disabled>
									</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevCantCuotasC">Cant. de Cuotas</label>
                                <input name="prevCantCuotasC" id="prevCantCuotasC" class="form-control" disabled>
                                </div> 
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevDescC">Desc. Global</label>
                                <div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
									<input name="prevDescC" id="prevDescC" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevDescGlobalC">Total c/ Desc.</label>
                                <div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
									<input name="prevDescGlobalC" id="prevDescGlobalC" class="form-control" disabled>
								</div>	
                                </div>
                        </div>        
                    </div> 
                    </div>
					  <div class="panel-footer clearfix">
						  <div class="btn-group pull-right">
							  <a class="btn btn-default" id="btnCancelarFormaPagoCompras">Cancelar</a>
						  </div>
					  </div>	   	
            </div>
            </div>
        </form> 
	</div>
</div>	
<!--Contenido Principal -->
<!--Ventana Modal PROVEEDORES   -->
<div class="modal fade" id="modal_proveedores" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
	<div class="modal-header modal-header-primary">
	  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	  <h4 class="modal-title">Buscar Proveedores</h4>
	</div>      
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">  
			<div style="width: 100%; padding-left: -10px;">    
			<div class="table-responsive">        
			<table id="tabla_proveedores" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="display:none;">Id</th>
						<th>Razón Social</th>
						<th><?php echo $parametro->idenTributaria?></th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>Cond. Tributaria</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$proveedores = Proveedor::All();
					foreach ($proveedores as $proveedor) {
				?>
					<tr>
						<td style="display:none;"><?php echo $proveedor->id; ?></td>
						<td><?php echo $proveedor->razon_social; ?></td>
						<td><?php echo $proveedor->cuit; ?></td>
						<td><?php echo $proveedor->direccion; ?></td>
						<td><?php echo $proveedor->telefono; ?></td>
						<td>
						<?php
						switch($proveedor->condTributaria)
						{   
							case "RI":
								echo "RESPONSABLE INSCRIPTO" ;
								break;
							case "CF":
								echo "CONSUMIDOR FINAL" ;
								break;
							case "MT":
								echo "MONOTRIBUTISTA" ;
								break;	
						}
						?>
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
		<button class="btn btn-naranja pull-right" id="btnSeleccionarProveedor">Seleccionar</button>
	</div>
	<div class="modal-footer">
	</div>
  </div>
</div>
</div>      
<!--Ventana Modal de FORMAS DE PAGO    -->
<div class="modal fade" id="modal_pagos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header modal-header-primary">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Formas de Pago</h4>
            </div>      
            <div class="modal-body">
                <div class="pantalla1">
                    <h5><strong>Seleccione las opciones de Pago:</strong></h5>
                   <div class="container">
					<div>
					  <input class="checkbox-custom" type="checkbox" name="optionEfectivo" id="optionEfectivo" value="" checked>
						<label for="optionEfectivo" class="checkbox-custom-label">Contado Efectivo</label>
					</div>	
					<div>
					  <input class="checkbox-custom" type="checkbox" name="optionDebito" id="optionDebito" value="">
					  <label for="optionDebito" class="checkbox-custom-label">Débito</label>
					</div>
					<div>
					  <input class="checkbox-custom" type="checkbox" name="optionCredito" id="optionCredito" value="">
					   <label for="optionCredito" class="checkbox-custom-label">Crédito</label>
					</div>
				</div>	
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <h5><strong>Descuento sobre el Total</strong></h5>
                            <div class="row">
                                <div class="col-lg-5 form-group">
                                   <label for="">Descuento</label>
                                    <div class="input-group">
                                    <input type="number" class="form-control text-right" name="descGralCompra" id="descGralCompra" min="0" value=""><div class="input-group-addon">%</div>
                                    </div>
                                </div>
                                <div class="col-lg-2 form-group">
                                    <label for="">Calcular</label>
                                    <button class="btn btn-default" id="btnCalculaDescGralCompra"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></button>
                                </div>
                                <div class="col-lg-5 form-group">
                                    <label for="">Total Compra c/Desc </label>
                                    <div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
										<strong><input type="number" class="form-control" name="totCompraConDesc" id="totCompraConDesc" min="0" value="" disabled/></strong>
                                    </div>
                                </div>    
                             </div>
                        </div>
                    </div>                    
                </div>
                <div class="pantalla2" style="display:none;">
                    <strong id="textoPantalla2"><h5></h5></strong>
                    <div class="row" id="efectivoOpcion">
                        <div class="col-lg-4">
                            <label for="">Efectivo</label>
                            <div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input type="number" class="form-control soloNumeros" name="efectivoCantCompra" id="efectivoCantCompra" tabindex="1" min="0">
                            </div>
                        </div>                    
                    <div id="div_calculo" style="display:none;">
						<div class="col-lg-4 form-group">
						   <label for="importeRecibidoC">Importe Recibido</label>
							<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input type="number" class="form-control" name="importeRecibidoC" id="importeRecibidoC" min="0.00" value="">
							</div>
						</div>
						<div class="col-lg-4 form-group">
							<label for="">Vuelto </label>
							<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input type="number" class="form-control" name="vueltoC" id="vueltoC" min="0" value="0.00" disabled/>
							</div>
						</div>    
                        </div>
                    </div>
                    <div class="row" id="debitoOpcion">
                        <div class="col-lg-6">
                            <label for="">Débito</label>
                            <div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input type="number" class="form-control soloNumeros" name="debitoCantCompra" id="debitoCantCompra" min="" value="0.00" tabindex="2" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                           <label for="tarjetaDebitoC">Tarjeta de débito</label>                            
							<select name="tarjetaDebitoC" id="tarjetaDebitoC" class="form-control" >
							<option value="Ninguna" selected disabled>Ninguna</option>
                            <?php
                            $tarjetas = Tarjeta::all();
                            foreach($tarjetas as $tarjeta) {
                            ?>  
                            <option value="<?php echo $tarjeta->id; ?>">
                                <?php
                                    echo $tarjeta->descripcion;
                                ?>
                            </option>
                            <?php
                            } ?> 
                            </select>
                        </div>
                    </div>                    
                    <div class="row" id="creditoOpcion">
						<div class="container-fluid">
							<div class="row">
							<div class="col-lg-6">
								<label for="">Crédito</label>
								<div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
									<input type="number" class="form-control soloNumeros" name="creditoCantCompra" id="creditoCantCompra" min="0" value="0.00" tabindex="3" disabled>
								</div>
							</div>
							<div class="col-lg-6 form-group">
							   <label for="tarjetaCreditoC">Tarjeta de Crédito</label>
								<select name="tarjetaCreditoC" id="tarjetaCreditoC" class="form-control">
								<option value="Ninguna" selected disabled>Ninguna</option>	
								<?php
								$tarjetas = Tarjeta::all();
								foreach($tarjetas as $tarjeta) {
								?>
								<option value="<?php echo $tarjeta->id; ?>">
									<?php
										echo $tarjeta->descripcion;
									?>
								</option>
								<?php
								} ?> 
								</select>
							</div>
							</div>
							<div class="row">
							<div class="col-lg-6 form-group">
									<label for="cuotasC">Cuotas</label>
									<input type="number" class="form-control" name="cuotasC" id="cuotasC" min="1" value="1" />
							</div>  
							</div>
						</div>
                    </div>
                    <hr>
                    <div class="row">
                         <div class="col-lg-6 form-group">
                            <!-- Se utiliza el método "all" para mostrar todos las comprobantes -->
                            <label for="txtComprobanteC">Comprobantes</label>
                            <select class="form-control" id="txtComprobanteC" name="txtComprobanteC">
                            <?php
                            $comprobantes = Comprobante::all();
                            foreach($comprobantes as $comprobante) {
                            ?>
                            <option value="<?php echo $comprobante->id; ?>">
                                <?php
                                    echo $comprobante->descripcion;
                                ?>
                            </option>
                            <?php
                            } ?> 
                            </select>
                        </div>      
                        <!--Este nro es solo para las COMPRAS -->
                        <div class="col-lg-6 form-group">
                            <label for="comprobanteCompra">Nro. del Comprobante</label>
                             <div class="input-group">
                            <input type="text" class="form-control" name="txtNroCompProv" id="txtNroCompProv" value="" tabindex="">
                            <span class="label label-primary">Datos provistos por el proveedor</span>     
                            </div>
                        </div>     
                    </div>
                    <hr>    
                </div>
             </div>
             <div class="modal-footer">
                 <div class="pantalla1">
                    <button class="btn btn-info pull-right" id="btnContinuarPantalla2C"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                 </div>
                 <div class="pantalla2" style="display:none;">
                    <button class="btn btn-info pull-right" id="btnAplicarFormaPagoC">Aplicar</button>
                    <button class="btn btn-info pull-left" id="btnVolverPantalla1C"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>   
                 </div>
             </div>
          </div>
        </div>
      </div>       

<!--Ventana Modal TALLES/COLORES-->
<div class="modal fade" id="modal_tallesColores" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header modal-header-primary">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="">Stock actual</h4>	 	 
  </div>		
	<div class="panel-body"> 			
		<div class="form-group">			
			<div class="row">				
			<div class="col-lg-12">                        				
				<div class="table-responsive">        				
				<table id="tablaTalleColor" class="table table-bordered table-condensed" cellspacing="0" width="100%">
					<thead>
						<th class="text-center">Talle / Color</th>
					</thead>					
					<tbody>
					</tbody>
				</table>
				</div>
			</div>
			</div>
		</div>
		<div class="row"> 
			<div class="col-lg-3 pull-right">        				
				<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Desc. %</span>	
				<input type="number" id="txtDescuentoCompra" name="txtDescuentoCompra" class="form-control" min="0" value="0"> 
				</div>
			</div>      			
		</div>
	</div>        
	  <div class="modal-footer clearfix">		
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex=""><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
		<button type="button" id="btnAgregarCarritoCompras" class="btn btn-naranja pull-right" data-dismiss="modal" tabindex=""><i class="fa fa-cart-plus" aria-hidden="true"></i> Agregar</button>
	  </div>	
</div>
</div>
</div>	 


<!--Form para crear la tabla Compras    -->
<form action="<?php url("compras/crearcompra") ?>" method="POST" role="form" style="display:none;">			
	<!-- datos para la tabla Compras    -->
	<input id="txtIdUsuario" name="txtIdUsuario">  
	<input id="txtIdProveedor" name="txtIdProveedor">
	<input id="txtNroCompraOk" name="txtNroCompraOk">
	<input id="txtIdComprobanteCompra" name="txtIdComprobanteCompra">
	<input id="txtNroComprobanteCompra" name="txtNroComprobanteCompra">                        
	<input id="txtDescC" name="txtDescC">
	<input id="txtNomImpCompra" name="txtNomImpCompra" value="<?php echo $parametro->nombre_impuesto; ?>">
	<input id="txtPorcImpCompra" name="txtPorcImpCompra" value="<?php echo $parametro->porcentaje_impuesto; ?>">
	<input id="txtImpuestoCompraOk" name="txtImpuestoCompraOk">
	<input id="txtSubTotalCompraOk" name="txtSubTotalCompraOk">			
	<input id="txtTotalCompraOk" name="txtTotalCompraOk">
	<input id="txtFechaActualOk" name="txtFechaActualOk">            
	<!-- datos para la tabla DetalleCompras-->
	<input id="txtArrayIdProd" name="txtArrayIdProd"/>
	<input id="txtArrayCodxProd" name="txtArrayCodxProd"/>
	<input id="txtArrayNomxProd" name="txtArrayNomxProd"/>
	
	<!-- nuevo Talles / Colores -->	
	<input id="txtArrayIdExistenciaProd" name="txtArrayIdExistenciaProd"/>
	<input id="txtArrayTallexProd" name="txtArrayTallexProd"/>
	<input id="txtArrayColorxProd" name="txtArrayColorxProd"/>
	
	<input id="txtArrayCantxProd" name="txtArrayCantxProd"/>
	<input id="txtArrayDescxProd" name="txtArrayDescxProd"/>
	<input id="txtArrayPrecioCompraxProd" name="txtArrayPrecioCompraxProd"/>
	<input id="txtArraysubTotalxProd" name="txtArraysubTotalxProd"/>
	<input id="txtRowCount" name="txtRowCount"/>            
	<!-- datos para la tabla Pagos    -->
	<input id="txtIdFormaPagoC" name="txtIdFormaPagoC">  
	<input id="txtCuotasC" name="txtCuotasC">
	<input id="txtPagoEfectivoC" name="txtPagoEfectivoC">
	<input id="txtPagoDebitoC" name="txtPagoDebitoC">
	<input id="txtPagoCreditoC" name="txtPagoCreditoC">
	<input id="txtTarjetaDebitoC" name="txtTarjetaDebitoC">
	<input id="txtTarjetaCreditoC" name="txtTarjetaCreditoC">            
	<button id="btnCompra" type="submit" style="display:none;">COMPRA</button>
</form>

<script>
//tabla PRODUCTOS
	//Control de stock con JQuery
   	$('#tabla_productos').DataTable({	
		"lengthChange": true,
		"deferRender": true,		
		"bProcessing": true,		
        "bServerSide": true,
        "sAjaxSource": "../libreria/ServerSide/serversideComprasProductos.php",		
		"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group' role='group'><a class='btnMostrarTallesColores btn btn-naranja' data-toggle='tooltip' title='Talle/Color'><i class='fa fa-expand' aria-hidden='true'></i></a></div></div>"
        } ],		
		"bDestroy": true,				
		//configuro lenguaje en español
		"language": {
			"sProcessing":    "Procesando...",
			"sLengthMenu":    "Mostrar _MENU_ registros",
			"sZeroRecords":   "No se encontraron resultados",
			"sEmptyTable":    "Ningún dato disponible en esta tabla",
			"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":   "",
			"sSearch":        "Buscar:",
			"sUrl":           "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":    "Último",
				"sNext":    "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},				
		"dom": '<"pull-left"f>rtip',
		"iDisplayLength": 5,
    });		
	$('div.dataTables_filter input').focus();
</script>

<?php
    include("vistas/includes/menuInferior.php");
?> 
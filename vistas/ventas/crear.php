<?php	
use \App\modelo\Cliente;
use \App\modelo\Venta;
use \App\modelo\Formapago;
use \App\modelo\Comprobante;
use \App\modelo\Tarjeta;
use \App\modelo\Producto;
use \App\modelo\Talle;
use \App\modelo\Tallecalzado;						
use \App\modelo\Talleaccesorio;
use \App\modelo\Color;
use \App\modelo\Existencia;
use \App\modelo\Parametro;
$parametro = Parametro::find(1);
include("vistas/includes/menuSupVentas.php");
?>
<!-- Contenido Principal -->  
<div id="page-wrapper"> 
	<div class="container-fluid">
		<div class="row">
        <hr>
			<div class="col-lg-7"> 
				<div class="panel panel-green">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-barcode"></i>  VENTAS </h3> 
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
									<th>Precio V.</th>						
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
            <div class="panel panel-green">
                <div class="panel-heading">
                    <h3 class="panel-title" id=""><i class="fa fa-money"></i> Importes</h3>
                </div>
            <div class="panel-body"  style="height:357px;">
				<div class="row">
				<div class="col-lg-12 form-group">
					<div class="input-group">
						<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
						<strong><input type="number" class="form-control" id="txtTotalVenta" value="0.00" disabled></strong>
					</div>
				</div>
				</div>
				<div class="row">					
					<div <?php if($parametro->condicionIVA == "MT"){ echo 'style="display:none;"';} ?> >
                        <div class="col-lg-6 form-group">
							<input id="porcentaje_imp" value="<?php echo $parametro->porcentaje_impuesto; ?>" style="display:none"> 
                            <label for=""><strong><?php echo $parametro->nombre_impuesto; ?></strong> del <strong><?php echo $parametro->porcentaje_impuesto; ?></strong>  %</label>
							<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input type="text" class="form-control text-center" id="txtImpuestoVenta" name="txtImpuestoVenta" value="0.00" disabled>
							</div>	      
                        </div> 
						<div class="col-lg-6 form-group">
                            <label for="">Sub-Total Neto</label>
                            <div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input type="text" class="form-control text-center" id="txtSubTotalVenta" name="txtSubTotalVenta" value="0.00" disabled>
							</div>   
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
							//if (empty(end($ventas))){
							if (end($ventas) == false){
								$txtNroVenta = 1;
							}else{
								$last = end($ventas);
								$last->nroVenta = $last->nroVenta + 1;    
								$txtNroVenta = $last->nroVenta;
							}
						?>		
                        <div class="col-lg-6 form-group">
							<label for="">Nro. de Venta</label>
                            <div class="input-group">	
                            <input type="text" class="form-control text-center" id="txtNroVenta" value="<?php echo sprintf('%06d', $txtNroVenta); ?>" disabled>
                            </div>	
                        </div>   
				</div>
				   <div class="row"> 
                            <!--Selecciono el Cliente genérico con cuit igual a 1 -->
                        <?php
                            $busqueda = Cliente::where("cuit", 1);    
                            foreach ($busqueda as $cliente){}
                        ?>
                        <input id="idCliente" value="<?php echo $cliente->id; ?>" type="hidden">
                        <div class="col-lg-7 form-group">
                           <label for="nomyape">Nombre</label>    
							<div class="input-group">	
                           <input type="text" class="form-control" id="nomyape" name="nomyape" value="<?php echo $cliente->nomyape; ?>" placeholder="Nombre y Apellido" tabindex="3" autocomplete="name" disabled>
							<span class="input-group-btn">
							<button class="btn btn-green pull-right" id="btnBuscarCliente"><span class="fa fa-search-plus" aria-hidden="true"></span></button>
						  </span>	
							</div>	
                        </div>
                        <div class="col-lg-5 form-group">
                           <label for="cuit"><?php echo $parametro->idenTributaria?></label>
                           <input type="text" class="form-control" id="cuit" name="cuit" tabindex="2" value="<?php echo $cliente->cuit; ?>" placeholder="Ident. Tributaria" disabled>
                        </div>  
					</div>
					<div class="row">
						<div class="col-lg-12 form-group">
                           <label for="cuit">Condic. Tributaria</label>
                           <input type="text" class="form-control" id="txtCondTribu" name="txtCondTribu" tabindex="3" value="<?php switch($cliente->condTributaria)
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
					<button class="btn btn-default" id="btnFormaDePago" name="btnFormaDePago"><span class="fa fa-credit-card" aria-hidden="true"></span> Formas de Pago</button>	
					<button class="btn btn-green pull-right" id="btnRegistrarVenta" disabled><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirmar</button>
                </div>       
            </div>
        </div>		
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table id="tablaVentas" class="table table-hover table-responsive">
                    <thead>
                        <tr class="active"> 
							<th style="display:none">IdExis</th>
							<th style="display:none">Id</th>
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
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>              
            </div>
        </div>
        <hr>        
        <form class="form" role="form" id="frmPagos" style="display:none;">            
            <div class="col-lg-12">
                <div class="panel panel-green">
                    <div class="panel-heading clearfix">
					</div>
<!--					<form class="form" role="form">-->
                    <div class="panel-body">					
                    <div class="row">
                        <div class="col-lg-12">                    			
                                <div class="form-group col-lg-4">
                                <!-- prev porque es previo a confirmar la forma de pago   -->
                                <input name="prevIdFp" id="prevIdFp" style="display:none;">
                                <label class="control-label" for="prevFormaPago">Formas de Pago</label>
                                <input name="prevFormaPago" id="prevFormaPago" class="form-control" disabled>
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevComprobante">Tipo de Comp.</label>
                                <input name="prevComprobante" id="prevComprobante" class="form-control" disabled>
                                </div>
								<div class="form-group col-lg-4">
                                <label class="control-label" for="prevCantCuotas">Cant. de Cuotas</label>
                                <input name="prevCantCuotas" id="prevCantCuotas" class="form-control" disabled>
                                </div> 
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevEfectivo">Pago Efectivo</label>
								<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
								<input name="prevEfectivo" id="prevEfectivo" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevTD">Pago con Débito</label>
								<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
								<input name="prevTD" id="prevTD" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevTC">Pago con Crédito</label>
								<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
								<input name="prevTC" id="prevTC" class="form-control" disabled>
								</div>	
                                </div>    
								<div class="form-group col-lg-4">
                                <label class="control-label" for="prevOFP">Pago con Nota de Crédito</label>
								<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input name="prevOFP" id="prevOFP" class="form-control" disabled>
								</div>	
                                </div> 							
								<div class="form-group col-lg-4">
                                <label class="control-label" for="prevTDnombre">Tarj. de Débito</label>
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                <input name="prevTDnombre" id="prevTDnombre" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevTCnombre">Tarj. de Crédito</label>
								<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                                <input name="prevTCnombre" id="prevTCnombre" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevDesc">Desc. Global</label>
								<div class="input-group">	
                                <div class="input-group-addon">%</div><input name="prevDesc" id="prevDesc" class="form-control" disabled>
								</div>	
                                </div>
                                <div class="form-group col-lg-4">
                                <label class="control-label" for="prevDescGlobal">Total c/ Desc.</label>
								<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>
								<input name="prevDescGlobal" id="prevDescGlobal" class="form-control" disabled>
								</div>	
                                </div>
								<input name="prevImpuesto" id="prevImpuesto" class="form-control" disabled style="display:none;">
								<input name="prevSubNeto" id="prevSubNeto" class="form-control" disabled style="display:none;">                           
                        </div>        
                    </div> 
                    </div>
					<div class="panel-footer clearfix">
						<div class="btn-group pull-right">
						<a class="btn btn-default" id="btnCancelarFormaPago">Cancelar</a>
                        </div>      
					</div>
<!--					</form> -->					
            </div>
          </div>
        </form>
	</div>   	
</div>	
 <!-- Contenido Principal -->

<!-- Ventana Modal CLIENTES   -->
<div class="modal fade" id="modal_clientes" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-greensteel">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="tituloModal"></h4>
            </div>      
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">  
                    <div style="width: 100%; padding-left: -10px;">    
		            <div class="table-responsive">        
                    <table id="tabla_clientes" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre y Apellido</th>
                                <th>Dirección</th>
								<th>Teléfono</th>
                                <th>E-Mail</th>
                                <th><?php echo $parametro->idenTributaria ?></th>
								<th>Cond. Tribut.</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $clientes = Cliente::All();
                            foreach ($clientes as $cliente) {
                        ?>
                            <tr>
                                <td><?php echo $cliente->id; ?></td>
                                <td><?php echo $cliente->nomyape; ?></td>
                                <td><?php echo $cliente->direccion; ?></td>
								<td><?php echo $cliente->telefono; ?></td>
                                <td><?php echo $cliente->email; ?></td>
                                <td><?php echo $cliente->cuit; ?></td>
								<td>
								<?php
								switch($cliente->condTributaria)
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
				<a id="btnClienteNuevo" class="btn btn-celeste" data-toggle="tooltip" title="Agregar Cliente"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Cliente</a>
                <button class="btn btn-green pull-right" id="btnSeleccionarCliente" data-toggle="tooltip" title="Seleccionar Cliente"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Confirmar</button>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    
<!-- Ventana Modal Alta de Clientes -->
<div class="modal fade" id="modal_cliente_nuevo" tabindex="-1" role="dialog" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-greensteel">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="">Alta de Clientes</h4>
      </div>
	<form id="formAltaClientes">
		<div class="panel-body"> 			
			<div class="form-group">
				<label for="">Nombre y Apellido</label>
				<input id="txtNomyape" type="text" autocomplete="name"  pattern="[A-Z a-z0-9_-]{1,30}" class="form-control" tabindex="1" autofocus required>
				<label for="">Dirección</label>
				<input id="txtDireccion" name="txtDireccion" autocomplete="address-level1" type="text" class="form-control" tabindex="2" required>
				<label for="">Teléfono</label>
				<input id="txtTelefono" name="txtTelefono" autocomplete="tel-national" type="text" class="form-control" tabindex="3" required>
				<label for="">E-mail</label>
				<input id="txtEmail" name="txtEmail" autocomplete="email" type="email" class="form-control" tabindex="4" required>
				<label for=""><?php echo $parametro->idenTributaria?></label>
				<input id="txtCuit" name="txtCuit" type="text" class="form-control" tabindex="5" required>
				<label for="txtCondTributaria">Condición frente al IVA</label>
				<select id="txtCondTributaria" name="txtCondTributaria" class="form-control" tabindex="6" required>
					<option value="CF">CONSUMIDOR FINAL</option>	
					<option value="RI">RESPONSABLE INSCRIPTO</option>
				</select>							
			</div>			
		</div>        
		  <div class="modal-footer clearfix">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex="8"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
			<button id="btnGuardarCliente" type="submit" class="btn btn-danger pull-right" tabindex="7"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
		  </div>	
	</form>	
    </div>
  </div>
</div>	 

<!-- Ventana Modal de FORMAS DE PAGO -->
<div class="modal fade" id="modal_pagos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header modal-header-greensteel">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Formas de Pago</h4>
            </div>      
             <div class="modal-body">            
                <div class="pantalla1">
					<h5><strong>Seleccione las opciones:</strong></h5>
					<div class="container">
						<div>
						  <input class="checkbox-custom" type="checkbox" name="optionEfectivo" id="optionEfectivo" value="" checked>
						  <label id="labelEfectivo" for="optionEfectivo" class="checkbox-custom-label">Contado Efectivo</label>
						</div>	
						<div>
						  <input class="checkbox-custom" type="checkbox" name="optionDebito" id="optionDebito" value="">
						  <label id="labelDebito" for="optionDebito" class="checkbox-custom-label">Débito</label>
						</div>
						<div>
						  <input class="checkbox-custom" type="checkbox" name="optionCredito" id="optionCredito" value="">
						   <label id="labelCredito" for="optionCredito" class="checkbox-custom-label">Crédito</label>
						</div>
					</div>	
					<hr>
					<h5><strong>Otras formas de pago:</strong></h5>
					<div class="container">
						<button class="btn btn-link" id="btnOFP" name="btnOFP"><span class="fa fa-file" aria-hidden="true"></span> - Devoluciones</button>
					</div>						
					<hr>
					<div class="row">
							<div class="col-lg-12 form-group">
								<h5><strong>Descuento sobre el Total</strong></h5>
								<div class="row">
									<div class="col-lg-5 form-group">
									   <label for="">Descuento</label>
										<div class="input-group">
										<input type="number" class="form-control text-right" name="descGral" id="descGral" min="0" value=""><div class="input-group-addon">%</div>
										</div>
									</div>
									<div class="col-lg-2 form-group">
										<label for="">Calcular</label>
										<button class="btn btn-default" id="btnCalculaDescGral"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span></button>
									</div>

									<div class="col-lg-5 form-group">
										<label for="">Total Venta c/Desc </label>
										<div class="input-group">
											<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
											<strong><input type="number" class="form-control" name="totVtaConDesc" id="totVtaConDesc" min="0" value="" disabled/></strong>
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
								<input type="number" class="form-control soloNumeros" name="efectivoCant" id="efectivoCant" min="0.00" tabindex="1">
                            </div>
                        </div>           
                        <div id="div_calculo" style="display:none;">
                            <div class="col-lg-4 form-group">
                               <label for="importeRecibido">Importe Recibido</label>
                                <div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
                                    <input type="number" class="form-control" name="importeRecibido" id="importeRecibido" min="0.00" value="">
                                </div>
                            </div>
                            <div class="col-lg-4 form-group">
                                <label for="">Vuelto </label>
                                <div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
									<input type="number" class="form-control" name="vuelto" id="vuelto" min="0.00" value="0.00" disabled/>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="row" id="debitoOpcion">
                        <div class="col-lg-6">
                            <label for="">Débito</label>
                            <div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
								<input type="number" class="form-control soloNumeros" name="debitoCant" id="debitoCant" min="0.00" value="0.00" tabindex="2" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                           <label for="tarjetaDebito">Tarjeta de débito</label>
							<select name="tarjetaDebito" id="tarjetaDebito" class="form-control" >
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
									<input type="number" class="form-control soloNumeros" name="creditoCant" id="creditoCant" min="0.00" value="0.00" tabindex="3" disabled>
								</div>
							</div>
							<div class="col-lg-6 form-group">
							   <label for="tarjetaCredito">Tarjeta de Crédito</label>
								<select name="tarjetaCredito" id="tarjetaCredito" class="form-control" >
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
								<label for="cuotas">Cuotas</label>
								<input type="number" class="form-control" name="cuotas" id="cuotas" min="1" value="1" />
							</div>  
						</div>	
						</div>		
					</div>
                    <div class="row">
                        <hr>
                        <div class="col-lg-6 form-group">  
                            <label for="txtComprobante">Comprobantes</label>
                            <select class="form-control" id="txtComprobante" name="txtComprobante">
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
                    </div>
                </div>
             </div>
             <div class="modal-footer">
                 <div class="pantalla1">
                    <button class="btn btn-green pull-right" id="btnContinuarPantalla2"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                 </div>
                 <div class="pantalla2" style="display:none;">
                    <button class="btn btn-green pull-right" id="btnAplicarFormaPago">Aplicar</button>
                    <button class="btn btn-green pull-left" id="btnVolverPantalla1"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>   
                 </div>    
             </div>
			</div>
		</div>
    </div>

<!-- Modal de Otras FORMAS DE PAGO -->
<div class="modal fade" id="modal_ofp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header modal-header-greensteel">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="">Otras Formas de Pago</h4>
            </div>      
             <div class="modal-body">
                <div class="row" id="notaCreditoOpcion">
						<div class="container-fluid">
						<div class="row">	
							<div class="col-lg-6 form-group">	
								<label for="nroNC">Nro. de Devolución</label>						
								<div class="input-group">	
								<input id="nroNC" name="nroNC" class="form-control" placeholder="" tabindex="1" autofocus>
								<span class="input-group-btn">
								<button class="btn btn-info pull-right" id="btnBuscarNC" onclick=""><span class="fa fa-search-plus" aria-hidden="true" tabindex="2"></span></button>
						  		</span>		
								</div>
							</div>	
							<div class="col-lg-6 form-group">
								<label for="importeNC">Importe</label>						
								<div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
									<strong><input id="importeNC" name="importeNC" class="form-control nc" type="number" value="0.00" disabled></strong>
								</div>	
							</div>	
						</div>	
						<div class="row">
							<div class="col-lg-6 form-group">
								<label for="estadoNC">Estado</label>						
								<div class="input-group">
									</div><input id="estadoNC" name="estadoNC" class="form-control nc" disabled>
							</div>	
							<div class="col-lg-6 form-group">
								<label for="nroVentaAsoc">Venta Asociada</label>						
								<div class="input-group">
									</div><input id="nroVentaAsoc" name="nroVentaAsoc" class="form-control nc" disabled>
							</div>	
						</div>		
						<div class="row">
							<div class="col-lg-6 form-group">
								<label for="clienteNC">Cliente</label>						
								<div class="input-group">
									</div><input id="clienteNC" name="clienteNC" class="form-control nc" disabled>
							</div>	
							<div class="col-lg-6 form-group">
								<label for="cuitNC"><?php echo $parametro->idenTributaria ?></label>					
								<div class="input-group">
									</div><input id="cuitNC" name="cuitNC" class="form-control nc" disabled>
							</div>	
						</div>	
						<div class="row">
							<div class="col-lg-12 form-group">
							<label id="labelOFP"></label>
							<div class="input-group">
								<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
								<input name="totalOFP" id="totalOFP" class="form-control text-center" disabled>
							</div>	
							</div>	
						</div>
						<hr>
						<div class="row">
							<div class="col-lg-12 form-group">
							   <label for="formasDePagoEDC">Completar pago con...</label>
								<select name="formasDePagoEDC" id="formasDePagoEDC" class="form-control" disabled>
									<option value="" selected disabled>-- Seleccione otro Pago --</option>
									<option value="Efectivo">Efectivo</option>
									<option value="Debito">Débito</option>
									<option value="Credito">Crédito</option>
								</select>
							</div>
						</div>
						<div class="row" id="opcionEfectivo" style="display:none;">
							<div class="col-lg-6">
								<label for="">Efectivo</label>
								<div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
									<input type="number" class="form-control" name="importeE" id="importeE">
								</div>
							</div>
						</div>
						<div class="row" id="opcionDebito" style="display:none;">
							<div class="col-lg-6">
								<label for="">Débito</label>
								<div class="input-group">
									<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
									<input type="number" class="form-control" name="importeD" id="importeD">
								</div>
							</div>
							<div class="col-lg-6 form-group">
							   <label for="tarjDebito">Tarjeta de débito</label>								
								<select name="tarjDebito" id="tarjDebito" class="form-control" >
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
						<div class="row" id="opcionCredito" style="display:none;">
							<div class="container-fluid">
							<div class="row">
								<div class="col-lg-6">
									<label for="">Crédito</label>
									<div class="input-group">
										<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
										<input type="number" class="form-control" name="importeC" id="importeC">
									</div>
								</div>
								<div class="col-lg-6 form-group">
								   <label for="tarjCredito">Tarjeta de Crédito</label>									
									<select name="tarjCredito" id="tarjCredito" class="form-control" >
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
										<label for="cuotas">Cuotas</label>
										<input type="number" class="form-control" name="cantCuotas" id="cantCuotas" min="1" value="1" />
								</div>  
							</div>	
							</div>		
					    </div>									
						<hr>	
						<div class="row">
							<div class="col-lg-6 form-group">
								<!-- Se utiliza el método "all" para mostrar todos las comprobantes -->
								<label for="txtComprobante">Comprobantes</label>
								<select class="form-control" id="txtComprobante" name="txtComprobante">
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
						</div>
							
						</div>	
					</div>
             </div>              
             <div class="modal-footer clearfix">
				 <button class="btn btn-default pull-left" id="btnCerrarModal">Cancelar</button>
                 <button class="btn btn-info pull-right" id="btnAplicarOFP">Aplicar</button>
             </div>			  
			</div>
		</div>
    </div>

<!--Ventana Modal TALLES/COLORES-->
<div class="modal fade" id="modal_tallesColores" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header modal-header-greensteel">
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
				<input type="number" id="txtDescuentoVenta" name="txtDescuentoVenta" class="form-control" min="0" value="0"> 
				</div>
			</div>      			
		</div>
	</div>        
	   <div class="modal-footer clearfix">		
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex=""><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
		<button type="button" id="btnAgregarCarritoVentas" class="btn btn-green pull-right" data-dismiss="modal" tabindex=""><i class="fa fa-cart-plus" aria-hidden="true"></i> Agregar</button>
	  </div>
</div>
</div>
</div>	 



<!-- INICIO formulario para enviar datos al VentaController    -->
<form action="<?php url("ventas/crearventa") ?>" method="POST" role="form" style="display:none">			
	<!-- datos para la tabla Ventas    -->
	<input id="txtIdUsuario" name="txtIdUsuario">  
	<input id="txtIdCliente" name="txtIdCliente">
	<input id="txtNroVentaOk" name="txtNroVentaOk">
	<input id="txtIdComprobante" name="txtIdComprobante">
	<input id="txtDesc" name="txtDesc">
	<input id="txtImpuestoOk" name="txtImpuestoOk">
	<input id="txtSubTotalOk" name="txtSubTotalOk">
	<input id="txtTotalVentaOk" name="txtTotalVentaOk">
	<input id="txtFechaActualOk" name="txtFechaActualOk">
	<!-- datos para la tabla DetalleVentas    -->
	<input id="txtArrayIdProd" name="txtArrayIdProd"/>
	<input id="txtArrayCodxProd" name="txtArrayCodxProd"/>
	<input id="txtArrayNomxProd" name="txtArrayNomxProd"/>
	
	<!-- nuevo Talles / Colores -->	
	<input id="txtArrayIdExistenciaProd" name="txtArrayIdExistenciaProd"/>
	<input id="txtArrayTallexProd" name="txtArrayTallexProd"/>
	<input id="txtArrayColorxProd" name="txtArrayColorxProd"/>
	
	<input id="txtArrayCantxProd" name="txtArrayCantxProd"/>
	<input id="txtArrayDescxProd" name="txtArrayDescxProd"/>			
	<input id="txtArrayPrecioVentaNetoxProd" name="txtArrayPrecioVentaNetoxProd"/>			
	<input id="txtArrayPrecioVentaxProd" name="txtArrayPrecioVentaxProd"/>
	<input id="txtArraysubTotalxProd" name="txtArraysubTotalxProd"/>
	<input id="txtRowCount" name="txtRowCount"/>            
	<!-- datos para la tabla Detalle Pagos Ventas   -->
	<input id="txtIdFormaPago" name="txtIdFormaPago">  
	<input id="txtCuotas" name="txtCuotas">
	<input id="txtPagoEfectivo" name="txtPagoEfectivo">
	<input id="txtPagoDebito" name="txtPagoDebito">
	<input id="txtPagoCredito" name="txtPagoCredito">
	<input id="txtTarjetaDebito" name="txtTarjetaDebito">
	<input id="txtTarjetaCredito" name="txtTarjetaCredito">
	<!-- nuevo para OFP -->
	<input id="txtNombreOFP" name="txtNombreOFP">
	<input id="txtPagoOFP" name="txtPagoOFP">
	<!-- datos para la tabla Devoluciones - para actualizar el estado en caso que pague con NC   -->
	<input id="txtNroNC" name="txtNroNC">
	<button id="btnVenta" type="submit" style="display:none;">VENTA</button>
</form>
<!-- FIN formulario para enviar datos al VentaController    -->	
<script>
	//tabla PRODUCTOS
	//Control de stock con JQuery
   	$('#tabla_productos').DataTable({	
		"lengthChange": true,
		"deferRender": true,		
		"bProcessing": true,		
        "bServerSide": true,
        "sAjaxSource": "../libreria/ServerSide/serversideVentasProductos.php",		
		"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group' role='group'><a class='btnMostrarTallesColores btn btn-green' data-toggle='tooltip' title='Talle/Color'><i class='fa fa-expand' aria-hidden='true'></i></a></div></div>"
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
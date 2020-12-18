<?php
use \App\modelo\Cliente;
use \App\modelo\Usuario;
use \App\modelo\Venta;
use \App\modelo\Detalleventa;
use \App\modelo\Producto;
use \App\modelo\Existencia;
use \App\modelo\Detallepagoventa;
use \App\modelo\Formapago;
use \App\modelo\Comprobante;
use \App\modelo\Devolucion;
use \App\modelo\Detalleimpositivoventa;
$detalleimpositivoventas = Detalleimpositivoventa::where("idVenta",$venta->id);
foreach($detalleimpositivoventas as $detalleimpositivoventa) {}
include("vistas/includes/menuSupDevolucion.php");
?>
<!-- Contenido Principal -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <h3 class="hstyle">Devoluciones de Ventas</h3>
            <div class="row">
                <div class="col-lg-8">                        
                    <!-- Vuelve a la pag anterior sea cual sea -->    
                    <a class="btn btn-default" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
                </div>                
                <div class="col-lg-4 ">
                    <div class="input-group">
                    <span class="input-group-addon" id="">Fecha</span>    
                    <input class="form-control text-center" name="txtFechaActual" type="text" id="txtFechaActual" value="<?php echo date("d/m/Y"); ?>"  disabled>
                    </div>    
                </div>        
            </div>
            <hr>                
            <div class="row">
                <div class="col-lg-12">                    
                    <div class="panel panel-azulTienda">
                        <div class="panel-heading">Detalle de la Venta</div>
                            <div class="panel-body">
                                <form class="form" role="form">                                                             
                                    <input id="idVenta" name="idVenta" value="<?php echo $venta->id; ?>" style="display:none;">
                                    <input id="estadoVenta" name="estadoVenta" value="<?php echo $venta->estado; ?>" style="display:none;">
                                    <div class="form-group col-lg-4"> 
                                    <label class="control-label" for="">Venta Nro.</label>
                                    <strong><input id="txtDnroVenta" name="txtDnroVenta" value="<?php printf("%06d",$venta->nroVenta); ?>" class="form-control" disabled></strong>
                                    </div>
                                    <?php
                                      $cliente = Cliente::find($venta->idCliente);
                                    ?>
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Cliente</label>            
                                    <input id="txtDcliente" name="txtDcliente" value="<?php echo $cliente->nomyape; ?>" class="form-control" disabled>    
                                    </div>                                          
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Fecha de la Venta</label>    
                                    <input id="txtDfechaVenta" name="txtDfechaVenta" value="<?php echo date("d-m-Y",strtotime($venta->fecha));?>" class="form-control" disabled>    
                                    </div>                                       
                                    <div class="form-group col-lg-4">
                                    <label class="control-label" for="">Desc. Global</label> 
                                    <input id="txtDcomprobante" name="txtDcomprobante" value="<?php echo $venta->descGlobal ; ?>" class="form-control" disabled>      
                                    </div>                                                                      
                                    <?php
                                     $usuario = Usuario::find($venta->idUsuario);
                                    ?>
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Usuario</label>        
                                    <input id="txtDidUsuario" name="txtDidUsuario" value="<?php echo $usuario->user; ?>" class="form-control" disabled>        
                                    </div>                                    
									<?php
									if($detalleimpositivoventa->porc_imp == 00){
										$impuesto = "no se discrimina";
									}else{
										$valor = $detalleimpositivoventa->porc_imp;
										$impuesto = $valor."%";
									}
									?>									
									<div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Impuesto</label>        
                                    <input id="" name="" value="<?php echo $detalleimpositivoventa->nom_imp." - ". $impuesto;?>" class="form-control" disabled>        
                                    </div>
									<input id="porc_imp" value="<?php echo $detalleimpositivoventa->porc_imp; ?>" style="display:none">									
									<div class="form-group col-lg-4">    
                                    <label class="control-label" for="">SubTotal Neto</label>        
                                    <input id="" name="" value="<?php echo $venta->subTotalNeto; ?>" class="form-control" disabled>        
                                    </div>									
									<div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Total Impuesto</label>        
                                    <input id="" name="" value="<?php echo $venta->totalImpuesto; ?>" class="form-control" disabled>        
                                    </div>									
									<div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Total Venta</label>
                                    <input id="txtDtotalVenta" name="txtDtotalVenta" value="<?php echo sprintf('$ %0.2f',$venta->totalVenta);?>" class="form-control" disabled>    
                                    </div>
                                </form>                                      
                            </div>
                    </div>                    
                </div>                
                <div class="col-lg-12">
                <div style="width: 100%; padding-left: -10px;">    
		        <div class="table-responsive">       
                <table id="tablaDetalleVentas" class="table table-hover table-condensed table-bordered table-responsive">
                    <thead>
                        <tr class="cabeceraDev"> 
                            <th style="display:none">IdExistencia</th>
                            <th class="text-center">Codigo</th>
                            <th class="text-center">Nombre</th>
							<th class="text-center">Talle</th>
							<th class="text-center">Color</th>
                            <th class="text-center">Cant.</th>
                            <th class="text-center">Precio Unit. ($)</th>
                            <th class="text-center">Desc. (%)</th>
                            <th class="text-center">Sub-Total ($)</th>
                            <th class="text-center">Cant. a devolver</th>
                            <th class="text-center">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">                     
                    <?php                       
                        $detalleventas = Detalleventa::where("idVenta",$venta->id);
                        //$detalleventas = Detalleventa::all();
                        foreach ($detalleventas as $detalleventa)
                        {
                    ?>
                        <tr data-toggle="tooltip" title="Click para Editar">
                          <td style="display:none"><?php echo $detalleventa->idExistencia ?></td>        
                          <td><?php echo $detalleventa->codProd; ?></td>    
                          <td><?php echo $detalleventa->nomProd; ?></td>
						  <td><?php echo $detalleventa->talle; ?></td>
						  <td><?php echo $detalleventa->color; ?></td>
                          <td><?php echo $detalleventa->cantidad; ?></td>    
                          <td><?php echo $detalleventa->precioVenta; ?></td>    
                          <td><?php echo $detalleventa->descuento; ?></td>    
                          <td><?php echo $detalleventa->total; ?></td> 
                          <td><input class="tdCantDevuelta form-control text-center" type="number" min="0" value="0"  disabled tabindex="1"></td>    
                          <td>
                             <textarea class="tdObservacion form-control" rows="1" placeholder="Ingrese el detalle" disabled tabindex="2"></textarea>
                          </td>    
                        </tr>
                    <?php
                        } 
                    ?>
                    </tbody>
                </table> 
                </div>					
                     <div class="pull-left">
						 <input class="checkbox-custom" type="checkbox" name="devolucionEfectivo" id="devolucionEfectivo" value="">
						 <label id="labelEfectivo" for="devolucionEfectivo" class="checkbox-custom-label">Devolución de dinero </label>
					 </div>	
                     <button id="btnConfirmarDev" class="btn btn-danger pull-right" tabindex="3"><span class="fa fa-exchange" aria-hidden="true"></span> Confirmar</button>					
					<br>
                </div>
                </div>                
                <div class="col-lg-12">  
                     <hr>
                     <div class="panel panel-azulTienda">
                         <!--Tiene un collapse para mostrar más info-->
                            <a data-toggle="collapse" href="#collapse1" style="text-decoration:none">
                                <div class="panel-heading">Formas de Pago<i class="fa fa-chevron-circle-down fa-pull-right" aria-hidden="true"></i></div> 
                            </a>
                         <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form class="form" role="form">
                                    <?php
                                    $comprobante = Comprobante::find($venta->idComprobante);
                                    ?>
                                    <div class="form-group col-lg-4">    
									<label class="control-label" for="">Tipo de Comp.</label>
									<input value="<?php echo $comprobante->descripcion ?>" class="form-control" disabled>   
                                    </div>                                    
                                     <?php  
                                    //busco la venta en tabla detallePagos
                                    //usando el metodo where()
                                    $detallepagosventas = Detallepagoventa::where("idVenta",$venta->id);
                                    foreach($detallepagosventas as $detallepagoventa) {
                                    ?>
                                    <!--Saco solo este dato de la tabla formaspagos-->
                                    <?php
                                        $formapago = Formapago::find($detallepagoventa->idFormaPago);
                                    ?>
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Formas de Pago</label>
                                    <input value="<?php echo $formapago->formaPago ?>" class="form-control" disabled>    
                                    </div>                                     
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Cant. de Cuotas</label>
                                    <input value="<?php echo $detallepagoventa->cuotas ?>" class="form-control" disabled>   
                                    </div>                                    
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Pago con $</label>
                                    <input value="<?php echo $detallepagoventa->pagoEfectivo ?>" class="form-control" disabled>    
                                    </div>
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Pago con Déb</label>    
                                    <input value="<?php echo $detallepagoventa->pagoDebito ?>" class="form-control" disabled>    
                                    </div>                                     
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Pago con Créd</label>            
                                    <input value="<?php echo $detallepagoventa->pagoCredito ?>" class="form-control" disabled>    
                                    </div>                                    
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Tarj. Déb</label>    
                                    <input value="<?php echo $detallepagoventa->tarjDebito ?>" class="form-control" disabled>        
                                    </div>                                    
                                    <div class="form-group col-lg-4">    
                                    <label class="control-label" for="">Tarj. Créd</label>        
                                    <input value="<?php echo $detallepagoventa->tarjCredito ?>" class="form-control" disabled>        
                                    </div>
                                </form>      
                                <?php
                                    }
                                ?>
                            </div>
                         </div> 
                         </div>
                     </div>
            </div>
        </div>
    </div>
<!-- Contenido Principal -->

     <!-- INICIO formulario para enviar datos al DevolucionController    -->
        <form action="<?php url("devoluciones/creardevolucion") ?>" method="POST" role="form" style="display:none">
            <!--Datos para actualizar el stock post devolucion-->
            <input id="txtDidVenta" name="txtDidVenta" value="<?php echo $venta->id; ?>">
            <input id="txtArrayDIdProd" name="txtArrayDIdProd">  
            <input id="txtArrayDCantidadProdVen" name="txtArrayDCantidadProdVen">
            <input id="txtArrayDCantidadProdDev" name="txtArrayDCantidadProdDev">
            <input id="txtArrayDobservacion" name="txtArrayDobservacion">            
            <!--Datos para crear la devolucion-->
            <input id="txtIdUsuario" name="txtIdUsuario" value="<?php echo $venta->idUsuario ?>">
            <input id="txtIdCliente" name="txtIdCliente" value="<?php echo $venta->idCliente ?>">
            <input id="txtDnroVenta" name="txtDnroVenta" value="<?php echo $venta->nroVenta; ?>">			
			<!--nuevo impuesto para devolucion-->
			<input id="txtDImpuesto" name="txtDImpuesto">
			<input id="txtDSubTotal" name="txtDSubTotal">			
            <input id="txtDtotal" name="txtDtotal">
            <input id="txtFechaVtaok" name="txtFechaVtaok">			
			<input id="txtDevolucionEfectivo" name="txtDevolucionEfectivo">            
             <!-- datos para la tabla DetalleDevoluciones    -->
            <input id="txtArrayDPrecioUnit" name="txtArrayDPrecioUnit" value="" />
            <input id="txtArrayDcodProd" name="txtArrayDcodProd"/>
            <input id="txtArrayDnomProd" name="txtArrayDnomProd"/>    
			<!-- nuevo talles/colores-->
			<input id="txtArrayIdExistenciaProd" name="txtArrayIdExistenciaProd"/>
			<input id="txtArrayDtalleProd" name="txtArrayDtalleProd"/>
			<input id="txtArrayDcolorProd" name="txtArrayDcolorProd"/>
						
			<!-- solo para comparar si es dev parcial o total    -->
			<input id="cantVenArray" name="cantVenArray"/>
			<input id="cantDevArray" name="cantDevArray"/>				 
            <button id="btnDevolucionVenta" type="submit" style="display:none;"></button>
        </form>
    <!-- FIN formulario para enviar datos al DevolucionController    -->	    
<?php
    include("vistas/includes/menuInferior.php");
?>   
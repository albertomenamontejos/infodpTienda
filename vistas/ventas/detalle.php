<?php
use \App\modelo\Cliente;
use \App\modelo\Venta;
use \App\modelo\Detalleventa;
use \App\modelo\Producto;
use \App\modelo\Detallepagoventa;
use \App\modelo\Formapago;
use \App\modelo\Comprobante;
use \App\modelo\Parametro;
$parametro = Parametro::find(1); 
use \App\modelo\Detalleimpositivoventa;
$detalleimpositivoventas = Detalleimpositivoventa::where("idVenta",$venta->id);
foreach($detalleimpositivoventas as $detalleimpositivoventa) {}
include("vistas/includes/menuSupLimpio.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="hstyle">Detalle Venta realizada</h3>
             <div class="row">			 
                <div class="col-lg-12">
                	<div class="btn-group">		
					<a class="btn btn-default" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>	
					<button href="javascript:void(0)" class="btnImprime btn btn-lila" data-toggle="tooltip" title="Imprimir detalle actual" tabindex="4"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Detalle</button>  					
					<?php								
					if($detalleimpositivoventa->condicionIVA != "NI"){
						switch($detalleimpositivoventa->emisor_receptor){
							//para ver que comprobante corresponde emitir	
							case "RI-RI":
								$comp = "ventas/imprimirA?id=";
								break;
							case "RI-CF":
								$comp = "ventas/imprimirB?id=";
								break;
							case "RI-MT":
								$comp = "ventas/imprimirB?id=";
								break;

							case "MT-RI":
								$comp = "ventas/imprimirC?id=";
								break;
							case "MT-CF":
								$comp = "ventas/imprimirC?id=";
								break;
							case "MT-MT":
								$comp = "ventas/imprimirC?id=";
								break;	
						}
					}else{
								$comp = "ventas/imprimir?id=";
					}
					?>
					<a href="<?php url($comp.$venta->id); ?>" class="btn btn-info" data-toggle="tooltip" title="Imprimir Factura" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Factura</a>					
					<!--Nuevo para tickets-->
					<?php								
					if($detalleimpositivoventa->condicionIVA != "NI"){
						switch($detalleimpositivoventa->emisor_receptor){
							//para ver que comprobante corresponde emitir	
							case "RI-RI":
								$comp = "ventas/ticketA?id=";
								break;
							case "RI-CF":
								$comp = "ventas/ticketB?id=";
								break;
							case "RI-MT":
								$comp = "ventas/ticketB?id=";
								break;

							case "MT-RI":
								$comp = "ventas/ticketC?id=";
								break;
							case "MT-CF":
								$comp = "ventas/ticketC?id=";
								break;
							case "MT-MT":
								$comp = "ventas/ticketC?id=";
								break;	
						}
					}else{
								$comp = "ventas/ticket?id=";
					}
					?>
					<a href="<?php url($comp.$venta->id); ?>" class="btn btn-primary" data-toggle="tooltip" title="Imprimir Ticket" target="_blank"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Ticket</a>
					
                </div>                  			 
				</div>				
			 </div>	
                <hr>				
            <!--  INICIO AREA DE IMPRESION    -->
           <div id="myPrintArea"> <!-- Aqui defino el area que imprimiremos  -->
                  <div class="row">
                    <div class="col-xs-6">
                      <h2>
                       <label id="txtEmpresa">
<!--                           <img src="../assets/img/Logo-impresion.png">-->
                           <img src="../<?php echo $parametro->logo_ruta; ?>" alt="logo">	
                           <?php echo $parametro->nombre_empresa;?>
                        </label>   
                      </h2>
                    </div>
                    <div class="col-xs-6 text-right"> 
						<div class="input-group pull-right" style="width: 170px;">
							<div class="input-group-addon" disabled>Fecha</div>
                            <input class="form-control text-right" name="txtFechaActual" type="text" id="txtFechaActual" value="<?php echo date("d-m-Y",strtotime($venta->fecha));?>" disabled/>
                        </div> 
                        <br>
                        <h1><small>Nro. <strong><?php printf("%06d",$venta->nroVenta); ?></strong></small></h1>             
                    </div>
                    </div>                    
                    <div class="row">
                        <div class="col-xs-5">
                          <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4><?php echo $parametro->nombre_empresa;?></h4>
                                  </div>
                                  <div class="panel-body">
                                    <p>
                                      Rubro:<strong> <?php echo $parametro->rubro; ?>  </strong><br>
                                      <?php echo $detalleimpositivoventa->idenTributaria?>:<strong> <?php echo $parametro->cuit; ?>  </strong><br>
                                      Domicilio:<strong> <?php echo $parametro->domicilio_comercial; ?> </strong><br>
                                      Teléfono:<strong> <?php echo $parametro->telefono; ?> </strong><br>
									  Condición Tributaria: <strong><?php echo $detalleimpositivoventa->condicionIVA; ?></strong>
                                    </p>
                                  </div>
                                </div>
                        </div>
                        <div class="col-xs-5 col-xs-offset-2 text-right">
                          <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <?php
                                      $cliente = Cliente::find($venta->idCliente);
                                      ?>
                                    <h4>Cliente :<strong> <?php echo $cliente->nomyape; ?></strong></h4>
                                  </div>
                                  <div class="panel-body">
                                    <p>
                                        Dirección: <strong><?php echo $cliente->direccion; ?></strong><br>
                                        <?php echo $detalleimpositivoventa->idenTributaria?>: <strong><?php echo $cliente->cuit; ?></strong><br>
										Condición Tributaria: <strong><?php echo $cliente->condTributaria; ?></strong>
                                    </p>
                                  </div>
                                </div>
                        </div>
                   </div> <!-- / end client details section -->
                
                  <div style="width: 100%; padding-left: -10px;">    
		          <div class="table-responsive">    
                  <table class="table table-bordered table-condensed text-right">
                        <thead>
                            <tr>
                                <th><h5><strong>Cantidad</strong></h5></th>
								<th><h5><strong>Código</strong></h5></th>
                                <th><h5><strong>Descripción</strong></h5></th>
								<th><h5><strong>Talle</strong></h5></th>
								<th><h5><strong>Color</strong></h5></th>
                                <th><h5><strong>Desc. Unit.(<?php echo $detalleimpositivoventa->moneda;?>)</strong></h5></th>
								<th><h5><strong>Precio Unit.(<?php echo $detalleimpositivoventa->moneda;?>)</strong></h5></th>
                                <th><h5><strong>Precio Tot.(<?php echo $detalleimpositivoventa->moneda;?>)</strong></h5></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php   
                            //busco la venta en tabla detalleVentas
                            //usando el metodo where()
                            $detalleventas = Detalleventa::where("idVenta",$venta->id);
                            foreach($detalleventas as $detalleventa) {
                        ?>
                            <tr>
                                <td><?php echo $detalleventa->cantidad; ?></td>
								<td><?php echo $detalleventa->codProd; ?></td>
								<td><?php echo $detalleventa->nomProd; ?></td>
								<td><?php echo $detalleventa->talle; ?></td>
								<td><?php echo $detalleventa->color; ?></td>
								<td><?php echo sprintf('%0.2f',$detalleventa->descuento); ?></td>
                                <td><?php echo sprintf('%0.2f',$detalleventa->precioVenta); ?></td>
                                <td><?php echo sprintf('%0.2f',$detalleventa->total); ?></td>
                            </tr>
                        <?php
                            } 
                        ?>
                        </tbody>
                    </table>     
                    </div>
                    </div>			   
			   <!-- / Inicio - Totales, iva, etc -->
                  <div class="row text-right">
                      <div class="col-xs-2 col-xs-offset-8">
                        <p>
                          <strong>
                            Sub-Total:<br>
                            <!--aca viene el nombre del impuesto  -->
							<?php
							  if($detalleimpositivoventa->condicionIVA == "MT"){
								echo ""; //si es MT (monotributo) no muestro nada
							  }else{
								echo $detalleimpositivoventa->nom_imp." ";	  
								echo $detalleimpositivoventa->porc_imp."%:";  
							  }
							 ?>
							 <br>  
                            Desc. Tot.:<br>  
                            Total:<br>
                          </strong>
                        </p>
                      </div>
                       
                      <div class="col-xs-2">
                        <strong>
                          <?php echo $detalleimpositivoventa->moneda; echo sprintf('%0.2f',$venta->subTotalNeto);?><br>
							<!--aca viene el porcentaje del impuesto  -->   
							<?php
							  if($detalleimpositivoventa->condicionIVA == "MT"){
								echo "";
							  }else{
								echo $detalleimpositivoventa->moneda;	  
								echo sprintf('%0.2f',$venta->totalImpuesto);  
							  }
							 ?>
							<br>	
                          <?php echo sprintf('%% %0.2f',$venta->descGlobal);?><br>
                          <?php
                            $totalConImpuesto = $venta->totalVenta;
                            echo $detalleimpositivoventa->moneda; echo sprintf("%0.2f",$totalConImpuesto);
                           ?><br>
                        </strong>
                      </div>
                    </div>
               <!-- / fin - Totales, iva, etc -->
                   <div class="row">
                   </div>
                    <hr>
                </div> <!--FIN AREA DE IMPRESION -->
                
                 <div id="formas_pagos" style="font-size: 90%;">  
                      <div class="col-xs-12">
                        <div class="span7">
                          <div class="panel panel-info">
                            <div class="panel-heading">
                              <h4>Formas de Pago (No se imprime)</h4>
                            </div>
                            <div class="panel-body">
                                <?php  
                                    //busco la venta en tabla detallePagos
                                    //usando el metodo where()
                                    $detallepagosventas = Detallepagoventa::where("idVenta",$venta->id);
                                    foreach($detallepagosventas as $detallepagoventa) {
                                ?>
                                <form class="form" role="form">
                                    <!--Saco solo este dato de la tabla formaspagos-->
                                    <?php
                                        $formapago = Formapago::find($detallepagoventa->idFormaPago);
                                    ?>
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Formas de Pago</label>
                                    <input value="<?php echo $formapago->formaPago ?>" class="form-control" disabled>    
                                    </div>                                     
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Pago con Efectivo</label>
                                    <input value="<?php echo $detallepagoventa->pagoEfectivo ?>" class="form-control" disabled>    
                                    </div>
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Pago con Débito</label>    
                                    <input value="<?php echo $detallepagoventa->pagoDebito ?>" class="form-control" disabled>    
                                    </div>                                     
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Pago con Crédito</label>            
                                    <input value="<?php echo $detallepagoventa->pagoCredito ?>" class="form-control" disabled>    
                                    </div>                                    
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Tarj. Débito</label>    
                                    <input value="<?php echo $detallepagoventa->tarjDebito ?>" class="form-control" disabled>        
                                    </div>                                    
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Tarj. Crédito</label>        
                                    <input value="<?php echo $detallepagoventa->tarjCredito ?>" class="form-control" disabled>        
                                    </div>                                    
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Cant. de Cuotas</label>
                                    <input value="<?php echo $detallepagoventa->cuotas ?>" class="form-control" disabled>   
                                    </div>									
									<div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Estado</label>
                                    <input value="<?php echo $venta->estado ?>" class="form-control" disabled>    
                                    </div>
                                </form>      
                                <?php
                                    }
                                ?>
                            </div>
                              <div class="panel-footer">
                                  <?php
                                  $comprobante = Comprobante::find($venta->idComprobante);
                                  ?>
                                  <div class="form-group">    
                                    <label class="control-label" for="">Tipo de Comp.</label>
                                    <input value="<?php echo $comprobante->descripcion ?>" class="form-control" disabled>   
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>                   
            </div>        
        </div>
    </div>
</div>
<!-- Contenido Principal -->
<!--Plugin para Imprimir -->
<script src="<?php asset("bower_components/jquery-PrintArea/jquery.PrintArea.js")?>"></script>	
<script>
	// Código para imprimir
   $(".btnImprime").click(function (){
        $("div#myPrintArea").printArea();
    })
</script>
<?php
    include("vistas/includes/menuInferior.php");
?>
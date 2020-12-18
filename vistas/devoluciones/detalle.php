<?php
use \App\modelo\Cliente;
use \App\modelo\Venta;
use \App\modelo\Detalleventa;
use \App\modelo\Detalledevolucion;
use \App\modelo\Producto;
use \App\modelo\Existencia;
use \App\modelo\Detallepagoventa;
use \App\modelo\Formapago;
use \App\modelo\Comprobante;
use \App\modelo\Detalleimpositivoventa;
use \App\modelo\Parametro;
$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupLimpio.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper" style="font-size: 90%;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3>Detalle Devolución</h3>
                <!-- Vuelve a la pag anterior sea cual sea -->    
                <a class="btn btn-default" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a> 
                <div class="btn-group pull-right">
                        <button href="javascript:void(0)" class="btnImprime btn btn-primary" tabindex="4"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>  
                </div>                  
                <hr>                
		<!--  INICIO AREA DE IMPRESION    -->
          <div id="myPrintArea"> <!-- Aqui defino el area que imprimiremos  -->			  
			  <!-- / Inicio - Datos Empresa y Nros de comprobantes -->
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
                         <div class="input-group col-xs-6 pull-right">
                            <div class="input-group-addon" disabled>Fecha</div>
                            <input class="form-control text-right" name="txtFechaActual" type="text" id="txtFechaActual" value="<?php echo date("d-m-Y",strtotime($devolucion->fechaDevolucion));?>"  disabled/>
                        </div> 
                        <br>
                        <h2><small>Nota de Crédito Nro. <strong><?php printf("%06d",$devolucion->nroNotaCredito); ?></strong></small></h2>
						<h2><small>Venta Asociada Nro. <strong><?php printf("%06d",$devolucion->nroVenta); ?></strong></small></h2>
                    </div>
              </div>
			  <!-- / Fin - Datos Empresa y Nros de comprobantes -->			  			  
			  <!-- / Inicio seccion Empresa y cliente -->
			  <div class="row">
                        <div class="col-xs-5">
                          <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4><?php echo $parametro->nombre_empresa;?></h4>
                                  </div>
                                  <div class="panel-body">
                                    <p>
                                      Rubro:<strong> <?php echo $parametro->rubro; ?>  </strong><br>
                                      <?php echo $parametro->idenTributaria?>:<strong> <?php echo $parametro->cuit; ?>  </strong><br>
                                      Localidad:<strong> <?php echo $parametro->pais; ?> </strong><br>
                                      Domicilio:<strong> <?php echo $parametro->domicilio_comercial; ?> </strong><br>
                                      Teléfono:<strong> <?php echo $parametro->telefono; ?> </strong><br>
                                    </p>
                                  </div>
                                </div>
                        </div>                        
                        <div class="col-xs-5 col-xs-offset-2 text-right">
                          <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <?php
                                      $cliente = Cliente::find($devolucion->idCliente);
                                      ?>
                                    <h4>Cliente :<strong> <?php echo $cliente->nomyape; ?></strong></h4>
                                  </div>
                                  <div class="panel-body">
                                    <p>
										<?php echo $parametro->idenTributaria?>: <strong><?php echo $cliente->cuit; ?></strong><br>
                                        Dirección: <strong><?php echo $cliente->direccion; ?></strong><br>
                                        E-mail: <strong><?php echo $cliente->email; ?></strong><br>
                                    </p>
                                  </div>
                                </div>
                        </div>
                 </div> 
			     <!-- / Fin seccion Empresa y cliente -->			  
			  	 <!-- / Inicio seccion tablas Detalle -->
			  	 <div style="width: 100%; padding-left: -10px;">    
		          <div class="table-responsive">    
                  <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th><h5><strong>Cant. Vendida</strong></h5></th>
								<th><h5><strong>Cant. Devuelta</strong></h5></th>
								<th><h5><strong>Código</strong></h5></th>
                                <th><h5><strong>Descripción</strong></h5></th>
                                <th><h5><strong>Observaciones</strong></h5></th>
								<th><h5><strong>Precio Unit. (<?php echo $parametro->moneda ?>) </strong></h5></th>
                                <th><h5><strong>Total Dev. (<?php echo $parametro->moneda ?>)</strong></h5></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                            //busco la venta en tabla detalleDevoluciones
                            //usando el metodo where()
                            $detalledevoluciones = Detalledevolucion::where("idDevolucion",$devolucion->id);
                            foreach($detalledevoluciones as $detalledevolucion) {
                        ?>
                            <tr>
                                <td><?php echo $detalledevolucion->cantVendida; ?></td>
								<td><?php echo $detalledevolucion->cantDevuelta; ?></td>
								<td><?php echo $detalledevolucion->codProd; ?></td>
                                <td><?php echo $detalledevolucion->nomProd; ?></td>
								<td><?php echo $detalledevolucion->observacion; ?></td>
                                <td><?php echo sprintf('$ %0.2f',$detalledevolucion->precioUnitVenta); ?></td>
                                <td><?php echo sprintf('$ %0.2f',abs($devolucion->totalDevolucion)); ?></td>
                            </tr>
                        <?php
                            } 
                        ?>
                        </tbody>
                    </table>     
                    </div>
                 </div>	
			  	<!-- / Fin seccion tablas Detalle -->
			  	<!-- / Inicio - Totales, iva, etc -->
				<?php
					$detalleimpositivoventas = Detalleimpositivoventa::where("idVenta",$devolucion->nroVenta);
					foreach($detalleimpositivoventas as $detalleimpositivoventa){
				?>
			  	<div class="row text-right">
                      <div class="col-xs-2 col-xs-offset-8">
                        <p>
                          <strong>
                            Sub-Total:<br>
                            <!--aca viene el nombre del impuesto  -->
							 <?php echo $detalleimpositivoventa->nom_imp; ?> <?php echo $detalleimpositivoventa->porc_imp; ?> %:<br>   
                            Total:<br>
                          </strong>
                        </p>
                      </div>
                    	<?php
							}
					    ?>  					
                      <div class="col-xs-2">
                       <strong>
                          <?php echo $parametro->moneda; echo sprintf('%0.2f',$devolucion->subTotalNeto);?><br>
                           <!--aca viene el porcentaje del impuesto  -->    
                          <?php echo $parametro->moneda; echo $devolucion->totalImpuesto;?><br>
                          <?php
                            $totalConImpuesto = abs($devolucion->totalDevolucion);
                            echo $parametro->moneda; echo sprintf("%.2f",$totalConImpuesto);
                           ?><br>
                        </strong>
                      </div>
                 </div>			  				
			  	 <!-- / fin - Totales, iva, etc -->			  
          </div>
            <!--FIN AREA DE IMPRESION -->                              	
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
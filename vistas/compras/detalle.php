<?php
use \App\modelo\Proveedor;
use \App\modelo\Compra;
use \App\modelo\Detallecompra;
use \App\modelo\Producto;
use \App\modelo\Detallepagocompra;
use \App\modelo\Formapago;
use \App\modelo\Comprobante;
use \App\modelo\Parametro;
$parametro = Parametro::find(1); 
include("vistas/includes/menuSupLimpio.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3>Compra Realizada</h3>                
                <a class="btn btn-default" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>              
                <div class="btn-group pull-right">
                        <button href="javascript:void(0)" class="btnImprime btn btn-primary" tabindex="4"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>  
                </div>                  
                <hr>
              <!--  INICIO AREA DE IMPRESION    --> 
              <div id="myPrintArea">    
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
                            <input class="form-control text-right" name="txtFechaActual" type="text" id="txtFechaActual" value="<?php echo date("d-m-Y",strtotime($compra->fecha));?>"  disabled/>
                        </div>
						<br>
						<h3>Nro. <strong><?php printf("%06d",$compra->nroCompra); ?></strong></h3> 
                    </div>
                  </div>                    
                    <div class="row"> <!-- / INICIO seccion PROVEEDOR -->
                        <div class="col-xs-5">
                          <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <?php
                                      $proveedor = Proveedor::find($compra->idProveedor);
                                      ?>
                                    <h4>Proveedor :<strong> <?php echo $proveedor->razon_social; ?></strong></h4>
                                  </div>
                                  <div class="panel-body">
                                    <p>
                                        Dirección: <strong><?php echo $proveedor->direccion; ?></strong><br>
                                        <?php echo $parametro->idenTributaria?>: <strong><?php echo $proveedor->cuit; ?></strong><br>
                                    </p>
                                  </div>
                              <div class="panel-footer">
                                  <?php
                                  $comprobante = Comprobante::find($compra->idComprobante);
                                  ?>                                  
                                 Tipo de Comprobante: <strong><?php echo $comprobante->descripcion; ?></strong><br>
                                 Nro. de Comprobante: <strong><?php echo $compra->nroComprobante; ?></strong>
                              </div>
                                </div>
                        </div>                        
                        <div class="col-xs-5 col-xs-offset-2 text-right">
                          <div class="panel panel-default">
                                  <div class="panel-heading">
                                      <?php
                                       $parametro = Parametro::find(1);
                                       ?>
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
                   </div> <!-- / FIN seccion PROVEEDOR -->
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
                                <th><h5><strong>Precio Unit. (<?php echo $parametro->moneda;?>)</strong></h5></th>
                                <th><h5><strong>Desc. Unit. (<?php echo $parametro->moneda;?>)</strong></h5></th>
                                <th><h5><strong>Precio Tot. (<?php echo $parametro->moneda;?>)</strong></h5></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  
                            //busco la compra en tabla detalleCompras
                            //usando el metodo where()
                            $detallecompras = Detallecompra::where("idCompra",$compra->id);
                            foreach($detallecompras as $detallecompra) {
                        ?>
                            <tr>
                                <td><?php echo $detallecompra->cantidad; ?></td>
								<td><?php echo $detallecompra->codProd; ?></td>
								<td><?php echo $detallecompra->nomProd; ?></td>
								<td><?php echo $detallecompra->talle; ?></td>
								<td><?php echo $detallecompra->color; ?></td>
                                <td><?php echo sprintf('%0.2f',$detallecompra->precioCompra); ?></td>
                                <td><?php echo sprintf('%0.2f',$detallecompra->descuento); ?></td>
                                <td><?php echo sprintf('%0.2f',$detallecompra->total); ?></td>
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
                           <?php echo $compra->nom_imp; ?> <?php echo $compra->porc_imp; ?> %:<br>  
                            Desc. Tot.:<br>  
                            Total:<br>
                          </strong>
                        </p>
                      </div>                      
                      <div class="col-xs-2">
                        <strong>
                          <?php echo $parametro->moneda; echo sprintf('%0.2f',$compra->subTotalNeto);?><br>
                          <!--aca viene el porcentaje del impuesto  -->    
                          <?php echo $parametro->moneda; echo sprintf('%0.2f',$compra->totalImpuesto);?><br>
                          <?php echo sprintf('%% %0.2f',$compra->descGlobal);?><br>                          
						  <?php
                            $totalConImpuesto = $compra->totalCompra;
                            echo $parametro->moneda; echo sprintf("%.2f",$totalConImpuesto);
                           ?><br> 	
                        </strong>
                      </div>
                    </div>
				   <!-- / fin - Totales, iva, etc -->
                   <div class="row">
                   </div>
                    <hr>
                   </div><!--  FIN AREA DE IMPRESION    -->                 
                   <div class="row">
                     <div id="formas_pagos_compras" style="font-size: 90%;">  
                      <div class="col-xs-12">
                        <div class="span7">
                          <div class="panel panel-info">
                            <div class="panel-heading">
                              <h4>Formas de Pago (No se imprime)</h4>
                            </div>
                            <div class="panel-body">
                                 <?php  
                                    //busco la compra en tabla detallePagoscompras
                                    //usando el metodo where()
                                    $detallepagoscompras = Detallepagocompra::where("idCompra",$compra->id);
                                    foreach($detallepagoscompras as $detallepagocompra) {
                                ?>                                
                                <form class="form" role="form">
                                    <!--Saco solo este dato de la tabla formaspagoscompras-->
                                    <?php
                                        $formapago = Formapago::find($detallepagocompra->idFormaPago);
                                    ?>
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Formas de Pago</label>
                                    <input value="<?php echo $formapago->formaPago ?>" class="form-control" disabled>    
                                    </div>                                     
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Pago con Efectivo</label>
                                    <input value="<?php echo $detallepagocompra->pagoEfectivo ?>" class="form-control" disabled>    
                                    </div>                                    
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Pago con Débito</label>    
                                    <input value="<?php echo $detallepagocompra->pagoDebito ?>" class="form-control" disabled>    
                                    </div>                                     
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Pago con Crédito</label>            
                                    <input value="<?php echo $detallepagocompra->pagoCredito ?>" class="form-control" disabled>    
                                    </div>                                    
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Tarj. Débito</label>    
                                    <input value="<?php echo $detallepagocompra->tarjDebito ?>" class="form-control" disabled>        
                                    </div>                                    
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Tarj. Crédito</label>        
                                    <input value="<?php echo $detallepagocompra->tarjCredito ?>" class="form-control" disabled>        
                                    </div>                                    
                                    <div class="form-group col-lg-6">    
                                    <label class="control-label" for="">Cant. de Cuotas</label>
                                    <input value="<?php echo $detallepagocompra->cuotas ?>" class="form-control" disabled> 
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
                    <hr>              
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
<?php
use \App\modelo\Cliente;
use \App\modelo\Venta;
use \App\modelo\Parametro;
$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupDataTable.php");
?>
<!-- Contenido Principal -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">                        
                 <h3 class="hstyle">Devoluciones de VENTAS</h3>
                <hr>
                <div style="width: 100%; padding-left: -10px;">    
                <div class="table-responsive">        
                <table class="tabla table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <!-- Datos de la tabla DETALLE DEVOLUCIONES VENTAS -->
                            <th>Nro. Devolución</th>
                            <th>Fecha Dev.</th>
							<th>Venta Asoc.</th>
                            <th>Cliente</th>
                            <th>Total Dev. (<?php echo $parametro->moneda;?>)</th>
							<th>Tipo de Dev.</th>
							<th>Estado</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                		<?php foreach ($devoluciones as $devolucion) {
                    	?>
                        <tr>
                            <td><?php echo sprintf('%06d', $devolucion->nroNotaCredito); ?></td>
                            <!--Mostramos la fecha en formato dd-mm-aaaa -->
                            <td><?php echo date("d-m-Y",strtotime($devolucion->fechaDevolucion));?></td>
                            <td><?php echo sprintf('%06d', $devolucion->nroVenta); ?></td>
                            <td>
								 <?php
									$cliente = Cliente::find($devolucion->idCliente); 
								 ?>
                                <?php echo $cliente->nomyape; ?>
							</td>
                            <td><?php echo sprintf('%0.2f', $devolucion->totalDevolucion); ?></td>
							<td>
                            <?php
							 $ventas = Venta::where("nroVenta",$devolucion->nroVenta);	
								foreach ($ventas as $venta) {}
                                switch($venta->estado){
                                    case "Dev_Parcial":        
                            ?>        
                                    <?php echo "Devolución Parcial"; break;?>
                                <?php 
									case "Anulada":        
                            ?>        
                                    <?php echo "Devolución Total"; break;?>
                            <?php    
                                }
                            ?>
                            </td>
							<td>
								<?php
									switch($devolucion->estado){
										case "Pendiente":        
								?>        
										<span class="label label-warning"><?php echo $devolucion->estado; break;?></span>
									<?php 
										case "Cancelada":        
								?>        
										<span class="label label-success"><?php echo $devolucion->estado; break;?></span>
									<?php 
										case "Dinero Devuelto":        
								?>        
										<span class="label label-default"><?php echo $devolucion->estado; break;?></span>
								<?php    
									}
								?>								
							</td>
                            <td>
								<div class='wrapper text-center'>
                              	<div class="btn-group" role="group">
									<a href="<?php url("devoluciones/detalle?id=".$devolucion->id) ?>" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Ver Detalle"><i class="fa fa-file-text" aria-hidden="true"></i></a>  								  
									<a href="<?php url("devoluciones/imprimirNC?id=".$devolucion->id) ?>" class="btn btn-default" data-toggle="tooltip" title="Imprimir Comprobante" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>   								  
                                </div>   
								</div>	
                            </td>
                        </tr>
                		<?php
						}
						?>
                    </tbody>
                </table>  
                </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<!-- Contenido Principal -->                  
<?php
    include("vistas/includes/menuInferior.php");
?>   
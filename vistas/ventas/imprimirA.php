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
?>
<html>
<head>
	<title>Comprobante</title>
	<meta charset="utf-8">
	
	 <!-- Para ICONOS -->
   <link rel="apple-touch-icon" sizes="57x57" href="<?php asset("img/icoDP/apple-icon-57x57.png") ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php asset("img/icoDP/apple-icon-60x60.png") ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php asset("img/icoDP/apple-icon-72x72.png") ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php asset("img/icoDP/apple-icon-76x76.png") ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php asset("img/icoDP/apple-icon-114x114.png") ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php asset("img/icoDP/apple-icon-120x120.png") ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php asset("img/icoDP/apple-icon-144x144.png") ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php asset("img/icoDP/apple-icon-152x152.png") ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php asset("img/icoDP/apple-icon-180x180.png") ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php asset("img/icoDP/android-icon-192x192.png") ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php asset("img/icoDP/favicon-32x32.png") ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php asset("img/icoDP/favicon-96x96.png") ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php asset("img/icoDP/favicon-16x16.png") ?>">
    <link rel="manifest" href="<?php asset("img/icoDP/manifest.json") ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php asset("img/icoDP/ms-icon-144x144.png") ?>">
    <meta name="theme-color" content="#ffffff">
    	
	<link rel="shortcut icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
	<link rel="icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
	
	<link href="../assets/bower_components/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		
	<!--hoja de estilos para vista en pantalla-->
	<style type="text/css">
		body{
			margin-left: 0;
		}
		
		#titulo1{
			position:absolute;
			top:33;
			left:366;
			font-style:normal;font-weight:bold;font-size:19px;font-family:Arial;color:#000000;
		}
		
		#nombreEmpresa{
			position:absolute;
			top:76;
			left:125;
			font-size: 26;
			font-weight: bold;
		}
		
		#tipoComprobante{
		 position: absolute;
			top: 56;
			left: 390;
			font-size: 28px;
			font-weight: bold; 
		}
		
		#factSupIzq{
			position: absolute;
			top: 155;
			left: 30;
			font-size: 12px;
		}
		
		#factSupDer{
			position: absolute;
			top: 110;
			left: 470;
			font-size: 12px;
		}
		
		#factPeriodo{
			position: absolute;
			top: 235;
			left: 30;
			font-size: 12px;
		}
		
		#factDatosCliente{
			position: absolute;
			top: 265;
			left: 30;
			font-size: 12px;
		}
		
		
		#nombreComprobante{
			position:absolute;
			top:76;
			left:560;
			font-size: 26;
			font-weight: bold;
		}
		
		
		#imagen{
			position:absolute;
			top:0;
			left:0;
			z-index:-1;
		}
		
		#tablaDetalle{
			position: absolute;
			font-size: 11;
			width: 790;
			top: 360;
			left: 20;
			font-family:Arial;
			color:#000000;
			border:solid #000 !important;
			border-width:0px 0 0 0px !important;
		}
		
		#tablaDetalle thead th { 
		  background-color: #cccccc !important;  
		}
		
		#tablaOtrosImp{
			font-size: 10;
			width: 470;
			height: 150px !important;
			overflow:auto;
			position: absolute;
			top: 730;
			left: 30;
			font-family:Arial;
			color:#000000;	
			border:solid #000 !important;
			border-width:0px 0 0 0px !important;
		}
		
		#tablaOtrosImp thead th { 
		  background-color: #cccccc !important;  
		}
		
		#tablaOtrosImp>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, #tablaOtrosImp>thead>tr>th{
			padding: 0 !important;	
		}
		
		#importeOT{
			position:absolute;
			top:900;
			left:300;
			font-size: 11px; 
		}
		
		
		#tituloOtrosImp{
			position: absolute;
			top: 710 !important;
			left: 30 !important;
		}
		
		#botones{
			position: absolute;
			left: 850;
    		top: 25;	
		}
		
		
		th, td {
			border:solid #000 !important;
			border-width:0 0px 0px 0 !important;
		}
		
		#tablaTotales{
			font-size: 11;
			font-weight: 600;
			width: 270;
			height: 150px !important;
			overflow:auto;
			position: absolute;
			top: 730;
			left: 520;
			font-family:Arial;
			color:#000000;	
			border:solid #000 !important;
			border-width:0px 0 0 0px !important;
		}
		
		#tablaTotales thead th { 
		  background-color: #cccccc !important;  
		}
		
		#tablaTotales>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, #tablaTotales>thead>tr>th{
			padding: 0 !important;	
		}		
		/*Simulan espacios de tabulacion*/
		tab1 { padding-left: 12em; }				
	</style>
	
	
	<!--hoja de estilos para imprimir-->
	<style type="text/css" media="print">
		@page{
		   margin: 0;
		}
		@media print {
			#botones {display:none;} /*definimos lo que no vamos a imprimir*/
			 html, body {	 
				 top: 0;
				 left: 0;
				 float: none !important;
				 width: auto !important;
				 margin:  0 !important;
				 padding: 0 !important;
				 
				  @page {
					size:A4;
				  }
			}

		}
		
		#titulo1{
			position:absolute;
			left:350;
		}
		
		#tipoComprobante{
			 position: absolute;
			top: 54;
			left: 370;
			font-size: 26px;
			font-weight: bold; 
		}
		
		#factPeriodo{
			position: absolute;
			top: 225;
			left: 30;
		}
		
		#factDatosCliente{
			position: absolute;
			top: 250;
			left: 30;
		}
		
		#tablaDetalle{
			font-size: 10;
			width: 743;
			top: 340;
			left: 20;
		}		
		#tituloOtrosImp{
			position: absolute;
			top: 680 !important;
			left: 30 !important;
		}		
		#tablaOtrosImp{
			top: 700;
		}		
		#importeOT{
			position:absolute;
			top:850;
		}		
		#tablaTotales{
			width: 260;
			left: 500;
			top: 700;
		}		
		#imagen{
			position:absolute;
			top:0;
			left:0;
			z-index:-1;
		}		
		#imagenfondo{
			height: 100%;	
			width: auto;
			position: absolute;
		}		
	</style>		
</head>	
<body>

	<div class="btn-group-vertical" id="botones">
		<button id="btnImprimir" class="btn btn-primary"  aria-label="Left Align"><span class="glyphicon glyphicon-print" aria-hidden="true" type="button"></span> Imprimir</button>
		<a id="btnHome"  href="<?php url("ventas/") ?>" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true" type="button"></span> Ir a Ventas</a>
	</div>
	
	<!-- imagen .jpg de la factura-->
<!--	<div id="imagen">-->
		<img id="imagenfondo" width="826" height="1169" src="../assets/img/comprobantes/comprobante.jpg" ALT="">	
<!--	</div>-->

	<div id="titulo1">ORIGINAL</div>

	<!-- tipo de comprobante A, B etc-->
	<div id="tipoComprobante" class="text-center">
		<p>A</p>
		<h6>COD. 01</h6>
	</div>
	
	<!--DATOS DE LA EMPRESA-->
	
	<!--logo de la empresa-->
	<div style="position:absolute;top:69;left:26"><img width="76" height="76" src="../<?php echo $parametro->logo_ruta; ?>" ALT=""></div>
	
	<!--nombre de la empresa-->
	<div id="nombreEmpresa"><?php echo $parametro->nombre_empresa;?></div>
	<div id="factSupIzq">
		<label>Razón Social:</label><label>&nbsp;<?php echo $parametro->nombre_empresa;?></label><br>
		<label>Domicilio Comercial:</label><label>&nbsp;<?php echo $parametro->domicilio_comercial; ?></label><br>
		<label>Condición frente al IVA:</label><label>&nbsp;<?php
		if($detalleimpositivoventa->condicionIVA == "RI"){
			echo "RESPONSABLE INSCRIPTO";
		} 
		if($detalleimpositivoventa->condicionIVA == "MT"){
			echo "MONOTRIBUTISTA";
		} 
		?></label>
		
	</div>
	
	<?php
		$comprobante = Comprobante::find($venta->idComprobante);
	?>
	<!-- nombre del comprobante, factura, nota de credito etc-->
	<div id="nombreComprobante"><?php echo $comprobante->descripcion ?></div>
	<div id="factSupDer">
		<label>Punto de Venta:</label><label>&nbsp;<?php printf("%06d",$detalleimpositivoventa->puntoVenta);?></label>&emsp;&emsp;
		<label>Comp. Nro.</label><label><?php printf("%06d",$venta->nroVenta); ?></label><br>
		<label>Fecha de Emisión:</label><label><?php echo date("d-m-Y",strtotime($venta->fecha));?></label><br>
		<label><?php echo $detalleimpositivoventa->idenTributaria?>: </label><label><?php echo $parametro->cuit; ?></label><br>
		<label>Ingresos Brutos:</label><label><?php echo $parametro->ingresos_brutos; ?></label><br>
		<label>Fecha de Inicio de Actividades:</label><label><?php echo date("d-m-Y",strtotime($parametro->fecIniAct));?></label>
	</div>	
	
	<!--<div id="factPeriodo">
		<label>Período Facturado Desde:</label><label></label>&emsp;&emsp;&emsp;
		<label>Hasta:</label><label></label>&emsp;&emsp;&emsp;
		<label>Fecha de Vto. para el pago:</label><label></label>
	</div>-->
	
	<!--DATOS DEL CLIENTE-->
	<?php
		  $cliente = Cliente::find($venta->idCliente);
	?>	
	<div id="factDatosCliente">
		<label><?php echo $detalleimpositivoventa->idenTributaria?>:</label><label>&nbsp;<?php echo $cliente->cuit; ?></label><tab1></tab1>
		<label>Apellido y Nombre / Razón Social:</label><label>&nbsp;<?php echo $cliente->nomyape; ?></label><br>
		<label>Condición frente al IVA:</label>
		<label>
			<?php
			if($cliente->condTributaria == "RI"){
				echo "RESPONSABLE INSCRIPTO";
			} 
			if($cliente->condTributaria == "MT"){
				echo "MONOTRIBUTISTA";
			} 
			?>
		</label><br>
		<label>Domicilio Comercial:</label><label>&nbsp;<?php echo $cliente->direccion; ?></label><br>
		
		<?php  
		//busco la venta en tabla detallePagos
		//usando el metodo where()
		$detallepagosventas = Detallepagoventa::where("idVenta",$venta->id);
		foreach($detallepagosventas as $detallepagoventa) {
		?>
	
		<!--Datos de forma de pago-->
		<?php
			$formapago = Formapago::find($detallepagoventa->idFormaPago);
		?>
		<label>Condición de venta:</label><label>&nbsp;<?php echo $formapago->formaPago ?></label><br>
		
		<?php
			} //cierre del foreach de $detallepagosventas 
		?>
	</div>	
	<!--Tabla con los productos/servicio --> 
	<table id="tablaDetalle" class="table">
		<thead>	
			<tr>
			<th>Código</th>
			<th>Producto / Servicio</th>
			<th>Cantidad</th>
			<th>Talle</th>
			<th>Color</th>	
			<th>Precio Unit.</th>
			<th>% Bonif</th>
			<th>Subtotal</th>
			<th>Alic. IVA</th>
			<th>Subtotal c/IVA</th>
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
				<td><?php echo $detalleventa->codProd; ?></td>
				<td><?php echo $detalleventa->nomProd; ?></td>
				<td><?php echo $detalleventa->cantidad; ?></td>
				<td><?php echo $detalleventa->talle;?></td>		
				<td><?php echo $detalleventa->color;?></td>
				<td><?php echo sprintf('%0.2f',trim($detalleventa->precioVentaNeto)); ?></td>		
				<td><?php echo sprintf('%0.2f',trim($detalleventa->descuento)); ?></td>
				<td>
					<!--calculo en tiempo real el subtotal neto-->
					<?php echo sprintf('%0.2f',trim($detalleventa->cantidad * $detalleventa->precioVentaNeto)) ?>
				</td>
				<td><?php echo sprintf('%0.2f',$detalleimpositivoventa->porc_imp); ?></td>
				<td><?php echo sprintf('%0.2f',trim($detalleventa->total)); ?></td>
			</tr>		
			<?php
					//sumo los subtotales para tener el total de la venta SIN el desc aplicado	
					$totSinDesc = 	$totSinDesc + $detalleventa->total;
				} 
			?>			
		</tbody>
	</table>     
	
	<!--Calculo de otros impuestos-->
	<div id="tituloOtrosImp" style="position:absolute;top:713;left:24"><span class="ft6">Otros Tributos</span></div>	
	<table id="tablaOtrosImp" class="table">
		<thead>
			<tr>
				<th>Descripción</th>
				<th>Detalle</th>
				<th>Alíc. %</th>
				<th>Importe</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Per./Ret. de Impuesto a las Ganancias</td>
				<td></td>
				<td></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>Per./Ret. de IVA</td>
				<td></td>
				<td></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>Per./Ret. Ingresos Brutos</td>
				<td></td>
				<td></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>Impuestos Internos</td>
				<td></td>
				<td></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>Impuestos Municipales</td>
				<td></td>
				<td></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>Impuestos Municipales</td>
				<td></td>
				<td></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>Impuestos Municipales</td>
				<td></td>
				<td></td>
				<td>0,00</td>
			</tr>
			
		</tbody>
	</table>     
	
	<div id="importeOT">
		<label>Importe Otros Tributos: $</label>&nbsp;<label>0,00</label>
	</div>
	
	<!--Calculo de impuestos, iva, totales, etc-->
	<table id="tablaTotales" class="table">	
		<tbody>
			<tr>
				<td>Sub-Total: <?php echo $detalleimpositivoventa->moneda?></td>
				<td><?php echo sprintf('%0.2f',$totSinDesc); ?></td>
			</tr>
			<tr>
				<td>Descuento Global: %</td>
				<td><?php echo $venta->descGlobal; ?></td>
			</tr>
			<tr>
				<td>Importe Neto Gravado: <?php echo $detalleimpositivoventa->moneda?></td>
				<td><?php echo sprintf('%0.2f',$venta->subTotalNeto); ?></td>
			</tr>
			<tr>
				<td>IVA 27%: <?php echo $detalleimpositivoventa->moneda?></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>IVA 21%: <?php echo $detalleimpositivoventa->moneda?></td>
				<td><?php echo sprintf('%0.2f',$venta->totalImpuesto); ?></td>
			</tr>
			<tr>
				<td>IVA 10.5%: <?php echo $detalleimpositivoventa->moneda?></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>IVA 5%: <?php echo $detalleimpositivoventa->moneda?></td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>IVA 2.5%: <?php echo $detalleimpositivoventa->moneda?></td>
				<td>0,00</td>
			</tr>
			<!--<tr>
				<td>IVA 0%: $</td>
				<td>0,00</td>
			</tr>
			<tr>
				<td>Importe Otros Tributos: $</td>
				<td>0,00</td>
			</tr>-->
			<tr>
				<td>Importe Total: <?php echo $detalleimpositivoventa->moneda?></td>
				<td><?php echo sprintf('%0.2f',$venta->totalVenta); ?></td>
			</tr>
		</tbody>
	</table>     	
	
	<!--Datos de la fact electronica CAE, etc-->	
	<!--<div style="position:absolute;top:959;left:615"><span class="ft3"> CAE N°:</span></div>
	<div style="position:absolute;top:979;left:520"><span class="ft3">Fecha de Vto. de CAE:</span></div>
	<div style="position:absolute;top:957;left:168"><span class="ft0">Comprobante Autorizado</span></div>
	<div style="position:absolute;top:983;left:22"><span class="ft11">Esta Administración Federal no se responsabiliza por los datos ingresados en el detalle de la operación</span></div>-->
	
<script src="../assets/bower_components/js/jquery.min.js"></script>
<script src="../assets/bower_components/bootstrap/js/bootstrap.min.js"></script>	

<script type="text/javascript">
	$(document).ready(function() { 	
		$("#btnImprimir").click(function (){
				window.print();
		});	
	});	
</script>
</body>
</html>
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
//var_dump($detalleimpositivoventa);
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
		body {
			margin: 10px; padding: 0;	
			background-repeat: repeat;
			padding-bottom: 1px;				
		}
		body, td, th {
			font-family: sans-serif;
			font-size:11px;
		}	
		.table{
			margin-bottom: 5px;
		}
		.table>thead>tr>th {
    		padding: 0px;									
		}		
		.areaDeImpresion{
		width: 340px;
		padding:10px 5px 10px 5px;
		float:left;
		margin-left:00px;
		border-style: solid;
		border:1px solid  #999;
		box-shadow: 0 1px 4px rgba(0, 0, 0, 0.4); 
		}
		#botones{
			position: absolute;
			left: 400;
    		top: 25;	
		}
	</style>
	
	<!--hoja de estilos para imprimir-->
	<style type="text/css" media="print">
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
				  /*size: 800mm 297mm; tamaño del papel ancho x alto*/
			  }
		}
		}
	</style>	
	
</head>
<body id="cuerpoPagina">
<div class="areaDeImpresion">
        <!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td>
        <strong> <?php echo $parametro->nombre_empresa;?></strong><br>
        <?php echo $detalleimpositivoventa->idenTributaria;?>:&nbsp;<?php echo $parametro->cuit; ?><br>	
		Ingresos Brutos: <?php echo $parametro->ingresos_brutos;?>	
		</td>
    </tr>
	<tr>
      	<td><?php echo $parametro->domicilio_comercial;?></td>
    </tr>
	<tr>
		<td>Comp. Nro. :<?php printf("%06d",$venta->nroVenta); ?><br></td>
    </tr>
	<tr>
		<td>Punto de Venta:&nbsp;<?php printf("%06d",$detalleimpositivoventa->puntoVenta);?></td>
	</tr>
	<tr>
		<td>
			<?php
			if($detalleimpositivoventa->condicionIVA == "RI"){
				echo "RESPONSABLE INSCRIPTO";
			} 
			if($detalleimpositivoventa->condicionIVA == "MT"){
				echo "MONOTRIBUTISTA";
			} 
			?>
		</td>
	</tr>	
    <tr>
        <td align="left">Fecha/Hora: <?php echo date('d/m/Y H:i:s');?> </td>
    </tr> 
<!--	Datos del cliente - Opcional-->				
    <!--<tr>
		<?php $cliente = Cliente::find($venta->idCliente);?>
        <td>Cliente: &nbsp;<?php echo $cliente->nomyape; ?></td>
    </tr>
    <tr>
        <td>CUIT: <?php echo $cliente->cuit; ?></td>
    </tr>-->        
</table>
<br>	
<!--Tabla con los productos/servicio --> 
<table class="table">
		<thead>
			<tr>
				<th>Cant.</th>				
				<th>Producto</th>								
				<th>P.U.</th>
				<th>Desc.</th>				
				<th>Importe</th>
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
				<td><?php echo $detalleventa->nomProd." / ".$detalleventa->talle." / ".$detalleventa->color; ?></td>
				<td><?php echo sprintf('%0.2f',trim($detalleventa->precioVenta)); ?></td>		
				<td><?php echo sprintf('%0.2f',trim($detalleventa->descuento)); ?></td>				
				<td><?php echo sprintf('%0.2f',trim($detalleventa->total)); ?></td>
			</tr>			
			<?php
					//sumo los subtotales para tener el total de la venta SIN el desc aplicado	
					$totSinDesc = 	$totSinDesc + $detalleventa->total;
				} 
			?>			
		</tbody>
</table>     	
	
<table class="table">	
		<tbody>
			<tr class="text-right">
				<td class="text-left" style="font-size:16px;">Total: </td>
				<td class="text-right" style="font-size:16px;"><strong><?php echo $detalleimpositivoventa->moneda?>&nbsp;<?php echo sprintf('%0.2f',$venta->totalVenta); ?></strong></td>
			</tr>
		</tbody>
</table> 	
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
		Forma de Pago:<label>&nbsp;<?php echo $formapago->formaPago ?></label><br>
		
		<?php
			} //cierre del foreach de $detallepagosventas 
		?>
<br>
</div>
  
	
<div class="btn-group-vertical" id="botones">
<!--	<button id="botonPrint" class="btn btn-primary" onClick="printPantalla();" aria-label="Left Align"><span class="glyphicon glyphicon-print" aria-hidden="true" type="button"></span> Imprimir</button>-->	
	<button id="btnImprimir" class="btn btn-primary" aria-label="Left Align"><span class="glyphicon glyphicon-print" aria-hidden="true" type="button"></span> Imprimir</button>
	
	<a id="btnHome" href="<?php url("ventas/") ?>" class="btn btn-default"><span class="glyphicon glyphicon-home" aria-hidden="true" type="button"></span> Ir a Ventas</a>
</div>	
	
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
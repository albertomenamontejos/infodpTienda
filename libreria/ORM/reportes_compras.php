<?php
header('Content-type: application/json'); 
include_once 'Conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS
$fecInicio = (isset($_POST['fechaInicioCompras'])) ? $_POST['fechaInicioCompras'] : '';
$fecFin = (isset($_POST['fechaFinCompras'])) ? $_POST['fechaFinCompras'] : '';

$opcionCompras = (isset($_POST['opcionCompras'])) ? $_POST['opcionCompras'] : '';
$result = array(); //creo una matriz

switch($opcionCompras)
{   
	case 1:
		$consulta = "SELECT fecha, sum(totalCompra) FROM compras WHERE fecha BETWEEN '$fecInicio' AND '$fecFin' GROUP BY fecha";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){ 
		   array_push($result, array($fila["fecha"], $fila["sum(totalCompra)"])) ;         
		}
		break;
	case 2:   
		$consulta = "SELECT MONTHNAME(fecha), sum(totalCompra) FROM compras WHERE fecha BETWEEN '$fecInicio' AND '$fecFin' GROUP BY MONTH(fecha)";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){ 
		   array_push($result, array($fila["MONTHNAME(fecha)"], $fila["sum(totalCompra)"])) ;         
		}
		break;
}

print json_encode($result, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
$conexion=null;
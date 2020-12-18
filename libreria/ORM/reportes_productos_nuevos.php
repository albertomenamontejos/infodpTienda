<?php
header('Content-type: application/json');  
include_once 'Conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS
$codProd = (isset($_POST['codProd'])) ? $_POST['codProd'] : '';    	
$opcion = (isset($_POST['opcionTC'])) ? $_POST['opcionTC'] : '';
$result = array();

switch($opcion)
{   
	case 1:             
		$consulta = "SELECT talle, cantidad FROM detalleventas WHERE codProd='$codProd' ORDER BY cantidad DESC";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();            
		while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){                
		 array_push($result, array($fila["talle"], $fila["cantidad"])) ;         
		}
		break;
	case 2:
		$consulta = "SELECT color, sum(cantidad) FROM `detalleventas` WHERE codProd='$codProd' GROUP BY color ORDER BY cantidad DESC";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();                
		while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){                
			array_push($result, array($fila["color"], $fila["sum(cantidad)"]) ) ;         
		}    
		break;            
}

print json_encode($result, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX	
$conexion=null;


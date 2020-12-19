<?php
//header('Content-type: application/json');  
include_once 'Conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS
$tipoFlujo = (isset($_POST['tipoFlujo'])) ? $_POST['tipoFlujo'] : '';
$fecha = date('Y/m/d H:i:s'); //toma fecha y hora actual
$importeFlujo = (isset($_POST['importeFlujo'])) ? $_POST['importeFlujo'] : '';
$descripcionFlujo = (isset($_POST['descripcionFlujo'])) ? $_POST['descripcionFlujo'] : '';

//obtengo el ultimo saldo de flujodecajas y controlo que no este vacio, 
$consulta = "SELECT saldoActual FROM flujodecajas ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$result=$resultado->fetchAll(PDO::FETCH_ASSOC); //obtengo el ultimo saldo de la tabla
$ultimoSaldo = json_encode($result[0]['saldoActual'], JSON_NUMERIC_CHECK); //obtengo el saldoActual

switch($tipoFlujo)
{   
	case 0: //es un egreso de dinero			
		//luego resto el valor al ultimo de la fila
		$saldoActual = $ultimoSaldo - abs($importeFlujo);				
		$consulta = "INSERT INTO flujodecajas (fecha, descripcion, entrada, salida, saldoActual) VALUES('$fecha', '$descripcionFlujo', '0', '$importeFlujo', '$saldoActual') ";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();
		break;

	case 1: //es un ingreso de dinero			
		$saldoActual = $ultimoSaldo + abs($importeFlujo);			
		$consulta = "INSERT INTO flujodecajas (fecha, descripcion, entrada, salida, saldoActual) VALUES('$fecha', '$descripcionFlujo', '$importeFlujo', '0', '$saldoActual' ) ";
		$resultado = $conexion->prepare($consulta);
		$resultado->execute();                
		break;    
}

$consulta = "SELECT id, fecha, descripcion, entrada, salida, saldoActual FROM flujodecajas ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
$conexion=null;
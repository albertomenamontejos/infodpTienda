<?php
	//header('Content-Type: application/json');
    include_once 'Conexion.php';

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
 
    // Recepción de los datos enviados mediante POST desde el JS
    $mes = (isset($_POST['mes'])) ? $_POST['mes'] : '';
    $anio = (isset($_POST['anio'])) ? $_POST['anio'] : '';
	
	$result = array(); //creo una matriz

	$consulta = "SELECT sum(entrada), sum(salida) FROM flujodecajas WHERE MONTH(fecha) = '$mes' AND YEAR(fecha) = '$anio' ";		
	$resultado = $conexion->prepare($consulta);
	$resultado->execute();

	 while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){ 
               array_push($result, array($fila["sum(entrada)"], $fila["sum(salida)"]));         
    }     
	
    print json_encode($result, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
    $conexion=null;
<?php
    //header('Content-type: application/json');  
    include_once 'Conexion.php';

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();


    // Recepción de los datos enviados mediante POST desde el JS
    $nroNC = (isset($_POST['nroNC'])) ? $_POST['nroNC'] : '';
    
	//$consulta = "SELECT totalDevolucion, nroVenta, estado FROM devoluciones WHERE nroNotaCredito = '$nroNC'";
	$consulta = "SELECT totalDevolucion, nroVenta, estado, nomyape, cuit FROM devoluciones, clientes WHERE nroNotaCredito = '$nroNC' AND idCliente = clientes.id";

	$resultado = $conexion->prepare($consulta);
	$resultado->execute();
	
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	
	print json_encode($data, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
    $conexion=null;
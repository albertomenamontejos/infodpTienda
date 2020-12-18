<?php
include_once 'Conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   
$nomyape = (isset($_POST['clie_nomyape'])) ? $_POST['clie_nomyape'] : '';
$direccion = (isset($_POST['clie_direccion'])) ? $_POST['clie_direccion'] : '';
$telefono = (isset($_POST['clie_telefono'])) ? $_POST['clie_telefono'] : '';
$email = (isset($_POST['clie_email'])) ? $_POST['clie_email'] : '';
$cuit = (isset($_POST['clie_cuit'])) ? $_POST['clie_cuit'] : '';
$condTributaria = (isset($_POST['clie_condTributaria'])) ? $_POST['clie_condTributaria'] : '';
		
$consulta = "INSERT INTO clientes (nomyape, direccion, telefono, email, cuit, condTributaria) VALUES('$nomyape', '$direccion', '$telefono', '$email', '$cuit', '$condTributaria') ";			
$resultado = $conexion->prepare($consulta);
$resultado->execute();

$consulta = "SELECT id, nomyape, direccion, telefono, email, cuit, condTributaria FROM clientes ORDER BY id DESC LIMIT 1";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
$conexion=null;
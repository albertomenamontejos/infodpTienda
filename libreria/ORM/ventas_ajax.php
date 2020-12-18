<?php 
include 'Conexion.php';
$objeto = new Conexion();
$conexion=$objeto->Conectar();

$idCod = (isset($_POST['idCod'])) ? $_POST['idCod'] : '';


//$consulta = "SELECT id, talle, color, stock FROM `existencias` WHERE idProducto='$idCod' ORDER by (talle+0), talle, color ASC"; //ordenado alphanumericamente

$consulta = "SELECT id, talle, color, stock FROM `existencias` WHERE idProducto='$idCod' ORDER by talle, color ASC"; 

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
$conexion=null;
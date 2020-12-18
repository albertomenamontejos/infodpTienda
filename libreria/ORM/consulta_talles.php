<?php 
include 'Conexion.php';
$objeto = new Conexion();
$conexion=$objeto->Conectar();

$idRubro = (isset($_POST['idRubro'])) ? $_POST['idRubro'] : '';
$idGenero = (isset($_POST['idGenero'])) ? $_POST['idGenero'] : '';
$idCategoria = (isset($_POST['idCategoria'])) ? $_POST['idCategoria'] : '';
$checkTalle = (isset($_POST['checkTalle'])) ? $_POST['checkTalle'] : '';

switch($checkTalle){
		case "false":
			$consulta = "SELECT descripcion FROM talles WHERE idRubro='$idRubro' AND idGenero='$idGenero' AND idCategoria='$idCategoria' AND descripcion <> 'U' ORDER by descripcion ASC";		
			break;
		case "true":
			$consulta = "SELECT descripcion FROM talles WHERE idRubro='$idRubro' AND idGenero='$idGenero' AND idCategoria='$idCategoria' AND descripcion ='U'";
			break;
		case "buscadupli";
			$consulta = "SELECT descripcion FROM talles WHERE idRubro='$idRubro' AND idGenero='$idGenero' AND idCategoria='$idCategoria' ORDER by descripcion ASC";		
			break;
		
}
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
print json_encode($data, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
$conexion=null;
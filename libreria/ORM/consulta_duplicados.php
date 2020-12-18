<?php 
include 'Conexion.php';
$objeto = new Conexion();
$conexion=$objeto->Conectar();

$option = (isset($_POST['option'])) ? $_POST['option'] : '';
	
switch($option){
	case "2": //tabla rubros
			$consulta = "SELECT descripcion FROM rubros ORDER by descripcion ASC";		
			break;	
	case "3": //tabla generos
			$consulta = "SELECT descripcion FROM generos ORDER by descripcion ASC";		
			break;
	case "4": //tabla categorias
			$consulta = "SELECT descripcion FROM categorias ORDER by descripcion ASC";		
			break;
	case "5": //tabla estilos
			$consulta = "SELECT descripcion FROM estilos ORDER by descripcion ASC";		
			break;	
	case "6": //tabla marcas
			$consulta = "SELECT descripcion FROM marcas ORDER by descripcion ASC";		
			break;
	case "7": //tabla comprobantes
			$consulta = "SELECT descripcion FROM comprobantes ORDER by descripcion ASC";		
			break;	
	case "8": //tabla tarjetas
			$consulta = "SELECT descripcion FROM tarjetas ORDER by descripcion ASC";		
			break;		
	case "9": //tabla usuarios
			$consulta = "SELECT user FROM usuarios ORDER by user ASC";		
			break;			
}

$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
print json_encode($data, JSON_NUMERIC_CHECK);
$conexion=null;
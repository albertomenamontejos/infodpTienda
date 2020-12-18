<?php
include_once 'Conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS
$idProducto = (isset($_POST['idProducto'])) ? $_POST['idProducto'] : '';
$arrayCantidades = json_decode($_POST['datos']);			


$cant_array = count($arrayCantidades);				
$cant_subarray = count($arrayCantidades[0]);		


echo $cant_array;

for($i=0; $i<$cant_array; $i++){				
	//$codProducto = $producto->codigo;														
	for($j=0; $j<3; $j++){								
		switch($j)
		{   
			case 0:						
				$Talle = $arrayCantidades[$i][$j];		
				break;
			case 1:   							
				$Color = $arrayCantidades[$i][$j];						
				break;
			case 2:   									
				$stock = $arrayCantidades[$i][$j];								
				break;	
		}						
	}						
$consulta = "UPDATE existencias SET codProducto='$codProducto', talle='$Talle', color='$Color', stock='$stock' WHERE idProducto='$idProducto'";			
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
print json_encode($data, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
$conexion=null;
}	





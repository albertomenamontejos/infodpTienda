<?php
    header('Content-type: application/json');  
    include_once 'Conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    // Recepción de los datos enviados mediante POST desde el JS    
		$opcion = (isset($_POST['opcionP'])) ? $_POST['opcionP'] : '';
		$result = array();

		switch($opcion)
		{   
			case 3:             
				$consulta = "SELECT nombre, sum(stock) FROM existencias INNER JOIN productos ON productos.codigo = existencias.codProducto GROUP BY codProducto ORDER BY sum(stock) DESC LIMIT 10";			
				 $resultado = $conexion->prepare($consulta);
				 $resultado->execute();            
				 while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){                
					 array_push($result, array($fila["nombre"], $fila["sum(stock)"])) ;         
				}
				break;
			case 4:
				$consulta = "SELECT * FROM productos ORDER BY precioVenta DESC LIMIT 10";
				$resultado = $conexion->prepare($consulta);
				$resultado->execute();                
				while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){                
					array_push($result, array($fila["nombre"], $fila["precioVenta"]) ) ;         
				}    
				break;    
			case 5:   
				$consulta = "SELECT nomProd, sum(cantidad) FROM detalleventas GROUP BY nomProd ORDER BY sum(cantidad) DESC LIMIT 10";
				$resultado = $conexion->prepare($consulta);
				$resultado->execute();
				while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){ 
				   array_push($result, array($fila["nomProd"], $fila["sum(cantidad)"])) ;         
				}
				break;		
		}

    print json_encode($result, JSON_NUMERIC_CHECK);
    $conexion=null;
<?php
    header('Content-type: application/json');  
    include_once 'Conexion.php';

    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
 
    // Recepción de los datos enviados mediante POST desde el JS
    $fecInicio = (isset($_POST['fechaInicioVtas'])) ? $_POST['fechaInicioVtas'] : '';
    $fecFin = (isset($_POST['fechaFinVtas'])) ? $_POST['fechaFinVtas'] : '';

    $opcion = (isset($_POST['opcionV'])) ? $_POST['opcionV'] : '';
    $result = array(); //creo una matriz

    switch($opcion)
    {   
        case 1:
            $consulta = "SELECT fecha, sum(totalVenta) FROM ventas WHERE fecha BETWEEN '$fecInicio' AND '$fecFin' GROUP BY fecha";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){ 
               array_push($result, array($fila["fecha"], $fila["sum(totalVenta)"]));         
            }
            break;
        case 2:   
            $consulta = "SELECT MONTHNAME(fecha), sum(totalVenta) FROM ventas WHERE fecha BETWEEN '$fecInicio' AND '$fecFin' GROUP BY MONTH(fecha)";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){ 
               array_push($result, array($fila["MONTHNAME(fecha)"], $fila["sum(totalVenta)"]));         
            }
            break;
			
		 case 3:
			 $consulta = "SELECT formaPago, sum(totalVenta) FROM formaspagos INNER JOIN detallepagosventas ON detallepagosventas.idFormaPago = formaspagos.id WHERE fechaVenta BETWEEN '$fecInicio' AND '$fecFin' GROUP BY formaspagos.formaPago";
             $resultado = $conexion->prepare($consulta);
             $resultado->execute();			
			 while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)){ 
				 array_push($result, array($fila["formaPago"], $fila["sum(totalVenta)"]));       
			  }
            break;	
			
    }
	
    print json_encode($result, JSON_NUMERIC_CHECK); //envio el array final el formato json a AJAX
    $conexion=null;
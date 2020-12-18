<?php    
    include_once 'Conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Recepción de los datos enviados mediante POST desde el JS
	$id = (isset($_POST['id'])) ? $_POST['id'] : '';	
	//$password = "$1$bZ5.IA2.$qnjHBOci.tIE8MM8xjnXB0"; //pass = 12345

	//funcion que genera una password aleatoria
	function generateRandomString($length = 5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}	
	$passUsuario = generateRandomString(); //pass para darle al usuario
	$password=crypt($passUsuario); //pass encriptada para guardar en la tabla usuarios

	$consulta = "UPDATE usuarios SET pass='$password' WHERE id='$id'";			
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
   	
	$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
	
  	print json_encode($passUsuario);
	$conexion=null;
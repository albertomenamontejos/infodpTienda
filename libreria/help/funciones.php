<?php
ob_start();
	function includeModels(){
		$directorio = opendir(MODELS);
		while ($archivo = readdir($directorio)) {
			if (!is_dir($archivo)) {
				require_once MODELS . $archivo;
			}
		}
	}
	/* funcion no va a ayudar a retornar un asset,$asset : nombre del archivo que esta dentro de asset*/
	function asset($asset){
		$phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
		$urlprin = trim(str_replace("index.php","", $phpSelf),"/");
		echo "/".$urlprin."/assets/".$asset;
	}
	/* función que permite redireccionar hacia otra parte, $rute : ruta hacia donde queremos dirigirnos	*/ 
	function redireccionar($rute){
		$phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
		$urlprin = str_replace("index.php","",$phpSelf);
		//header("location:/".trim($urlprin,"/")."".$rute);	
		header("location:/".trim($urlprin,"/")."/".trim($rute,"/"));	
	}
	/* función que nos permite escribir una url por medio del que le pasamos, $rute : ruta hacia donde se va a ir */
	function url($route){
		$phpSelf = filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_URL);
		//nuevo
		if(trim($phpSelf, '/') == 'index.php'){
			echo "/".$route;
		//nuevo	
		}else{
			$urlprin = str_replace("index.php","",$phpSelf);
			echo "/".trim($urlprin,"/")."/".$route;	
		}
	}
	/* funcion que crea el csrf, para la validación - token */
	session_start();
	function csrf_token(){
		if(isset($_SESSION["token"])){
			unset($_SESSION["token"]);
		}
		$csrf_token = md5(uniqid(mt_rand(), true));
		$_SESSION["csrf_token"] = $csrf_token;
		echo $csrf_token;
	}
	/* funcion para validar csrf_token, por medio de sesiones */
	function val_csrf(){
		if($_REQUEST["_token"] == $_SESSION["csrf_token"]){
			return true;
		}else{
			return false;
		}
	}	
	//funcion MODIFICADA que nos permite recuperar un input * funcion NUEVA 
	function input($campo)
	{		
		$campo = $_REQUEST[$campo];
		$trimCampo = trim($campo);
		if(is_numeric($trimCampo)){
			return $campo;
		}elseif (!empty($trimCampo) && strpos($campo, "'") == false && strpos($campo, ";") == false && strpos($campo, "=") == false && strpos($campo, "SELECT ALL") == false && strpos($campo, "EXEC") == false) {
			$campo = trim($campo);		
			$campo = stripcslashes($campo);
			$campo = htmlspecialchars($campo, ENT_QUOTES);		
			return $campo;
		}
	}
	//funcion que nos permite recuperar un input * funcion NUEVA 
	/*function input($campo)
	{		
		$campo = $_REQUEST[$campo];
		$trimCampo = trim($campo);			
		if (!empty($trimCampo) && strpos($campo, "'") == false && strpos($campo, ";") == false && strpos($campo, "=") == false && strpos($campo, "SELECT ALL") == false && strpos($campo, "EXEC") == false) {
				$campo = trim($campo);		
				$campo = stripcslashes($campo);
				$campo = htmlspecialchars($campo, ENT_QUOTES);		
				return $campo;
		}else{			   
			exit;
		}			
	}*/
	//funcion encriptar
	function encriptar($string, $passEnBD) {
		return crypt($string,$passEnBD);
	}
	/* ojo no confundir con redireccionar, esta es para sessiones */
	function redirecciona(){
		return new Redirecciona();
	}
ob_end_flush();
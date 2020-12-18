<?php 
  class Conexion {	  
        public static function Conectar() {
			// Datos de conexión con la base de datos
			if (!defined('SERVER')) define('SERVER', 'localhost');
			if (!defined('DBNAME')) define('DBNAME', 'db_infodp_tienda');
			if (!defined('USER')) define('USER', 'infodp_tienda1');
			if (!defined('PASSWORD')) define('PASSWORD', 'TguA(lio7!ii');
			$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
							  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
							 );			
			try{
				$conexion = new PDO("mysql:host=".SERVER."; dbname=".DBNAME, USER, PASSWORD, $opciones);	
				$conexion->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );				
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);					
				return $conexion;
			}catch (Exception $e){
				die("El error de Conexión es: ". $e->getMessage());
			}
        }
  }

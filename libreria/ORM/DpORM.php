<?php 
namespace libreria\ORM;
require_once 'Conexion.php';
use PDO;

  class DpORM extends \Conexion
  {	
    protected static $cnx;  
    protected static $table;
    
    function __construct(){
        self::getConexion(); // ejecutar cada vez que se invoca a la clase por medio de un objeto
    }

    public static function getConexion(){
        self::$cnx = \Conexion::Conectar();
    }

    public static function getDesConectar(){
        self::$cnx = null;
    }

    public function Ejecutar($procedimiento,$params=null){
        $query = "call ".$procedimiento;
        self::getConexion();

        if(!is_null($params)){
            $paramsa = "";
            for($i=0;$i < count($params);$i++){
                $paramsa .= ":".$i.",";
            }
            $paramsa =  trim($paramsa,",");
            $paramsa .= ")";
            $query .= "(".$paramsa;
        }else{
            $query .= "()";
        }
        //echo $query;
        //agregando parametros al query
        $res = self::$cnx->prepare($query);
        for($i=0;$i < count($params);$i++){
            $res->bindParam(":".$i,$params[$i]);
        }
        $res->execute();
        $obj = [];
        foreach($res as $row){
            $obj[] = $row;
        }
        return $obj;
    }
    
    public function eliminar($valor=null,$columna=null){
        $query = "DELETE FROM ". static ::$table ." WHERE ".(is_null($columna)?"id":$columna)." = :p";
        //echo $query;
        self::getConexion();
        //preparar conexión
        $res = self::$cnx->prepare($query);
        // agregamos los parametros
        if(!is_null($valor)){
            $res->bindParam(":p",$valor);
        }else{
			$res->bindValue(":p",(is_null($this->id)?null:$this->id));
            //$res->bindParam(":p",(is_null($this->id)?null:$this->id));
        }
        //ejecutar
        if($res->execute())
		{
            self::getDesConectar();
            return true;
        }else{
            $_SESSION["temp_elimina"] = "false"; //var de session para avisar que NO elimino el registro
            return false;
        }
    }

	/*Nuevo guardar() anti-inyeccion SQL*/  
	public function guardar(){	 
	   //static::$table = "`".str_replace("`","``",static::$table)."`";
	   //echo "table = ".static::$table."<br>";	
		
       $values = $this->getColumnas();	// trae todos junto, campos y valores	
	   //echo "values = ";print_r($values);echo"<br>"; 
		   
       $filtrados = null; // variable que va almacenar los campos		
	   			
       foreach($values as $key => $value){	
        //agrega al array todas los campos, menos la de ID		
       	if ($value !== null && !is_integer($key) && $value !== '' && strpos($key, 'obj_') === false && $key !== 'id') {
                if ($value === false) { //funiona ok
                    $value = 0;
                }
                $filtrados[$key] = $value;
				//echo "key = ".$key."=> filtrados[key] = ".$filtrados[$key]."<br>";
            }
        }		
		//echo "filtrados = ";print_r($filtrados);echo"<br>"; 
		
        $campos = array_keys($filtrados); // solo guarda los nombres de los campos
		//$campos = array("descripcion"); //lista blanca permitida
        //echo "campos = "; print_r($campos);echo "<br>";
		
		$marcadores = "";
		foreach($campos as $campo){
			//$marcadores .= $campo." = :".$campo.",";				
			$marcadores.="`".str_replace("`","``",$campo)."`". "=:$campo, ";
		}
		$marcadores = substr($marcadores, 0, -2); 
		//echo "<br>marcadores = ".$marcadores;
		
        if ($this->id){ // si hacemos UPDATE traera un ID y entra por aqui
			$query = "UPDATE " . static ::$table . " SET $marcadores WHERE id = ".$this->id;			
        }else{						 			
			$query = "INSERT INTO " .static::$table. " SET " .$marcadores;			
    	}    
		//var_dump($query);
		try{
			self::getConexion();
        	$res = self::$cnx->prepare($query);
			//cargamos todos los valores de los parametros

			foreach ($filtrados as $key => &$val) {		
				$res->bindParam($key,$val);
				
				//enlaza los parametros del la consulta preparada guardada en $res
				//con el array $filtrados que contiene todos los datos, luego para cada elemento enlaza asi...
				//ejemplo (":".$key, $val) (:codigo, s003)
				
			}


			if($res->execute()){ //nos devuelve true o false
				$this->id = self::$cnx->lastInsertId();
				self::getDesConectar();
				return true;
			}else{
				//echo "No se guardo el registro";
				return false;
			}			
			}catch (Exception $e){

				echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			}		
    }		
	  
    public static function where($columna,$valor){		
        $query = "SELECT * FROM ". static ::$table ." WHERE ".$columna." = :".$columna;
        //echo $query;
        $class = get_called_class();
        self::getConexion();
        $res = self::$cnx->prepare($query);
        $res->bindParam(":".$columna,$valor);		
        //$res->setFetchMode( PDO::FETCH_CLASS, $class);
        $res->execute();
        //$filas = $res->fetch();
        //echo count($filas);
        $obj = []; // ----
        foreach($res as $row){
            $obj[] = new $class($row);
        }
        self::getDesConectar();
        return $obj;
    }

    public static function find($id){
        //echo get_called_class();
        $resultado = self::where("id",$id);
        if(count($resultado)){
            return $resultado[0];
        }else{
            return [];
        }
    }

    public static function all(){		
        $query = "SELECT * FROM ". static ::$table ;
        //echo $query;
        $class = get_called_class();
        self::getConexion();
        $res = self::$cnx->prepare($query);
        //$res->setFetchMode( PDO::FETCH_CLASS, $class);
        $res->execute();
        //$filas = $res->fetch();
        //echo count($filas);
        $obj = [];
        foreach($res as $row){
            $obj[] = new $class($row);
        }
        self::getDesConectar();
        return $obj;
    }        
  }       
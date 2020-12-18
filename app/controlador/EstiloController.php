<?php
use \vista\Vista;
use \App\modelo\Estilo;

class EstiloController {
	
    public function index(){
    	$data = Estilo::all();
        return Vista::crear("estilos.index",array(
        	"estilos" => $data
        ));
    }

    public function crear(){
        return Vista::crear("estilos.crear");
    }

    public function crearestilo(){
    	$estilo = new Estilo();
    	$estilo->descripcion = strtoupper(input("txtDescripcion"));
		
    	$estilo->guardar();

    	redireccionar("/estilos");
    }

    public function eliminar(){
    	$estilo = Estilo::find(input("id"));
    	$estilo->eliminar();
		
    	redireccionar("/estilos");
    }
        
    public function editar(){
    	$estilo = Estilo::find(input("id"));
    	return Vista::crear("estilos.editar",array(
    		"estilo" => $estilo
    	));
    }
 
    public function editarestilo(){
    	$estilo = Estilo::find(input("id"));
    	$estilo->descripcion = strtoupper(input("txtDescripcion"));
    	$estilo->guardar();

    	redireccionar("/estilos");
    }
            
     public function listado() {
        $estilos = Estilo::all();
            foreach($estilos as $estilo) {
                echo $estilo->descripcion."<br>";
            }
    }
        
     public function busqueda(){
       $idcat = $_REQUEST["id"];
       $estilo = Estilo::find($idcat);
       echo $estilo->descripcion;
   }
    
     public function cantidad(){
        $estilo = Estilo::all();
        $cantidad = count($estilo);        
        echo $cantidad;    
     }                           
}
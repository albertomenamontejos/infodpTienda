<?php
use \vista\Vista;
use \App\modelo\Rubro;

class RubroController {	
    public function index(){
    	$data = Rubro::all();
        return Vista::crear("rubros.index",array(
        	"rubros" => $data
        ));
    }

    public function crear(){
        return Vista::crear("rubros.crear");
    }

    public function crearrubro(){
    	$rubro = new Rubro();
    	$rubro->descripcion = strtoupper(input("txtDescripcion"));		
    	$rubro->guardar();

    	redireccionar("/rubros");
    }

    public function eliminar(){
    	$rubro = Rubro::find(input("id"));
    	$rubro->eliminar();		
    	redireccionar("/rubros");
    }
        
    public function editar(){
    	$rubro = Rubro::find(input("id"));
    	return Vista::crear("rubros.editar",array(
    		"rubro" => $rubro
    	));
    }
 
    public function editarrubro(){
    	$rubro = Rubro::find(input("id"));
    	$rubro->descripcion = strtoupper(input("txtDescripcion"));		
    	$rubro->guardar();
    	redireccionar("/rubros");
    }
            
     public function listado() {
        $rubros = Rubro::all();
            foreach($rubros as $rubro) {
                echo $rubro->descripcion."<br>";
            }
    }
        
     public function busqueda(){
       $idcat = $_REQUEST["id"];
       $rubro = Rubro::find($idcat);
       echo $rubro->descripcion;
   }
    
     public function cantidad(){
        $rubro = Rubro::all();
        $cantidad = count($rubro);        
        echo $cantidad;    
     }                           
}
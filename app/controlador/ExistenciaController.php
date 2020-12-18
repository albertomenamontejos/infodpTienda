<?php
use \vista\Vista;
use \App\modelo\Existencia;

class ExistenciaController {
	
    public function index(){
    	$data = Existencia::all();
        return Vista::crear("existencias.index",array(
        	"existencias" => $data
        ));
    }

    public function crear(){
        return Vista::crear("existencias.crear");
    }

    public function editar(){
    	$existencia = Existencia::find(input("id"));
    	return Vista::crear("existencias.editar",array(
    		"existencia" => $existencia
    	));
    }
 
    public function editarexistencia(){
    	$existencia = Existencia::find(input("id"));
		//controla que no se ingresen valores negativos
		if(input("txtStock") >= 0){
			$existencia->stock = input("txtStock");	
		}    	
    	$existencia->guardar();

    	redireccionar("/existencias");
    }
                 
}
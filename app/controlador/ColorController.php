<?php
use \vista\Vista;
use \App\modelo\Color;

class ColorController {	
    public function index(){
    	$data = Color::all();
        return Vista::crear("colores.index",array(
        	"colores" => $data
        ));
    }

    public function crear(){
        return Vista::crear("colores.crear");
    }

    public function crearcolor(){
    	$color = new Color();
		$color->idRubro = input("txtIdRubro");		
		$color->idGenero = input("txtIdGenero");
		$color->idCategoria = input("txtIdCategoria");		
    	$color->descripcion = strtoupper(input("txtDescripcion"));		
		if(!empty(input("txtDescripcion"))){
			$color->guardar();
		}	    	
    	redireccionar("/colores");
    }
	
	 public function editarcolor(){
    	$color = Color::find(input("id"));
		$color->idRubro = input("txtIdRubro");		
		$color->idGenero = input("txtIdGenero");
		$color->idCategoria = input("txtIdCategoria");
    	$color->descripcion = strtoupper(input("txtDescripcion"));		
    	if(!empty(input("txtDescripcion"))){
			$color->guardar();
		}
    	redireccionar("/colores");
    }
	public function editar(){
    	$color = Color::find(input("id"));
    	return Vista::crear("colores.editar",array(
    		"color" => $color
    	));
    }
	
    public function eliminar(){
    	$color = Color::find(input("id"));
    	$color->eliminar();		
    	redireccionar("/colores");
    }
}
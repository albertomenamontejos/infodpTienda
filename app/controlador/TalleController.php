<?php
use \vista\Vista;
use \App\modelo\Talle;

class TalleController {	
	
    public function index(){
    	$data = Talle::all();
        return Vista::crear("talles.index",array("talles" => $data));
    }
	public function crear(){
        return Vista::crear("talles.crear");
    }
    public function creartalle(){
    	$talle = new Talle();
		$talle->idRubro = input("txtIdRubro");		
		$talle->idGenero = input("txtIdGenero");
		$talle->idCategoria = input("txtIdCategoria");		
    	$talle->descripcion = strtoupper(input("txtDescripcion"));		
		if(!empty(input("txtDescripcion"))){
			$talle->guardar();	
		}		
    	redireccionar("/talles");
    }	
	public function editartalle(){
    	$talle = Talle::find(input("id"));
		$talle->idRubro = input("txtIdRubro");		
		$talle->idGenero = input("txtIdGenero");
		$talle->idCategoria = input("txtIdCategoria");
    	$talle->descripcion = strtoupper(input("txtDescripcion"));    	
		if(!empty(input("txtDescripcion"))){
			$talle->guardar();	
		}			
    	redireccionar("/talles");
    }		
	
	public function editar(){
    	$talle = Talle::find(input("id"));
    	return Vista::crear("talles.editar",array("talle" => $talle));
    }
	
    public function eliminar(){
    	$talle = Talle::find(input("id"));
    	$talle->eliminar();		
    	redireccionar("/talles");
    }                
}
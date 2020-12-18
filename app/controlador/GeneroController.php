<?php
use \vista\Vista;
use \App\modelo\Genero;

class GeneroController {

	//ruta principal retorna el listado de generos
    public function index(){
    	$data = Genero::all();
        return Vista::crear("generos.index",array(
        	"generos" => $data
        ));
    }

    public function crear(){
        return Vista::crear("generos.crear");
    }

    public function creargenero(){
		try{
			$genero = new Genero();
			$genero->descripcion = strtoupper(input("txtDescripcion"));			
			$genero->guardar();
			redireccionar("/generos");	
		} catch (Exception $e) {
            echo $e->getMessage();
        }
    }
	
    public function eliminar(){
    	$genero = Genero::find(input("id"));
    	$genero->eliminar();
    	redireccionar("/generos");
    }

    public function editar(){
    	$genero = Genero::find(input("id"));
    	return Vista::crear("generos.editar",array(
    		"genero" => $genero
    	));
    }

    public function editargenero(){		
		$genero = Genero::find(input("id"));
		$genero->descripcion = strtoupper(input("txtDescripcion"));			
		$genero->guardar();
		redireccionar("/generos");					
    }
        
    //genera un listado de la tabla generos y muestra la descripcion de c/u    
     public function listado() {
        $generos = Genero::all();
            foreach($generos as $genero) {
                echo $genero->descripcion."<br>";
            }
    }
    
    //metodo que busca la descripcion en la tabla generos
     public function busqueda(){
       $idMarca = $_REQUEST["id"];
       $genero = Marca::find($idMarca);
       echo $genero->descripcion;
   }
    
     public function cantidad(){
        $genero = Genero::all();
        $cantidad = count($genero);        
        echo $cantidad;    
     }
                                
}
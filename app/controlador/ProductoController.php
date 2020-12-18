<?php
use \vista\Vista;
use \App\modelo\Producto;
use \App\modelo\Existencia;

class ProductoController {	
    public function index(){
    	$data = Producto::all();
        return Vista::crear("productos.index",array("productos" => $data));
    }

    public function crear(){
        return Vista::crear("productos.crear");
    }
   	
	public function crearproducto() {	
		$producto = new Producto();			
    	$producto->codigo = strtoupper(input("txtCodigo"));   
        $producto->nombre = input("txtNombre");        
		$producto->idGenero = input("txtIdGenero");		
		$producto->idRubro = input("txtIdRubro");		
        $producto->idCategoria = input("txtIdCategoria");		
		$producto->idEstilo = input("txtIdEstilo");		
        $producto->idMarca = input("txtIdMarca"); 				
		$producto->controlTalles = strtoupper(input("txtControlTalles"));
		$producto->controlColores = strtoupper(input("txtControlColores"));		
		$producto->precioCompra = input("txtPrecioCompra");		
        $producto->precioVenta = input("txtPrecioVenta");		        
		$producto->formato_codigo = input("formatoCodeBar");		
		$producto->guardar();   								
		//obtengo el id del ultimo registro
		$productos = Producto::all();				
		if (end($productos) == false){ //si no hay productos
			$producto->id = 1;			
		}else{
			$ultimo = end($productos);								
		}					
		//para Tabla existencias
		$arrayCantidades = json_decode($_POST['txtArrayCantidades'], true);											
		$cant_array = count($arrayCantidades);				
		$cant_subarray = count($arrayCantidades[0]);				
		for($i=0; $i<$cant_array; $i++){			
			$existencia = new Existencia();
			$existencia->idProducto = $ultimo->id;												
			$existencia->codProducto = $producto->codigo;												
			for($j=0; $j<$cant_subarray; $j++){
				switch($j)
				{   
					case 0:						
						$existencia->talle = $arrayCantidades[$i][$j];									
						break;
					case 1:   							
						$existencia->color = $arrayCantidades[$i][$j];									
						break;
					case 2:   									
						$existencia->stock = $arrayCantidades[$i][$j];									
						break;	
				} 													
			}		
			$existencia->guardar();				
		}					
		redireccionar("/productos");		
    }
	    
    public function eliminar(){
    	$producto = Producto::find(input("id"));
    	$producto->eliminar();
        
        redireccionar("/productos");
    }

    public function editar(){
    	$producto = Producto::find(input("id"));        
    	return Vista::crear("productos.editar",array("producto" => $producto));
    }
 
    public function editarproducto(){							
		$producto = Producto::find(input("id"));		
		$producto->codigo = strtoupper(input("txtCodigo"));   
        $producto->nombre = input("txtNombre");        		
		//$producto->idRubro = input("txtIdRubro");en la edición no se puede modificar el rubro		
		//$producto->idGenero = input("txtIdGenero");en la edición no se puede modificar el genero			
        //$producto->idCategoria = input("txtIdCategoria");en la edición no se puede modificar el categoria			
		$producto->idEstilo = input("txtIdEstilo");		
        $producto->idMarca = input("txtIdMarca");        				
		$producto->precioCompra = input("txtPrecioCompra");		
        $producto->precioVenta = input("txtPrecioVenta");		        
		$producto->formato_codigo = input("formatoCodeBar"); //nuevo codigo de barras        				
		$producto->guardar();   						
		
		//para Tabla existencias
		$arrayCantidades = json_decode($_POST['txtArrayCantidades'], true);							
		$cant_array = count($arrayCantidades);				
		$cant_subarray = count($arrayCantidades[0]);				
		
		//obtenemos todos los ids del producto a editar
		$existencias = Existencia::all();										
		$arrayProductos = [];
		foreach($existencias as $dato){
			if($dato->idProducto == input("id")){																	
				$arrayProductos[] = $dato->id;								
			}
		}																			
		//editamos el grupo de IDs del producto	
		foreach($arrayProductos as $key=>$val){
			//echo "ID :".$arrayProductos[$key]."-";
			$existencia = Existencia::find($arrayProductos[$key]);		
			for($i=0; $i < $cant_array; $i++){			
				if($existencia->talle == $arrayCantidades[$i][0] && $existencia->color == $arrayCantidades[$i][1]){		
					$existencia->idProducto = input("id");														
					$existencia->talle = $arrayCantidades[$i][0];
					$existencia->color = $arrayCantidades[$i][1];
					$existencia->stock = $arrayCantidades[$i][2];//indice 2 es de stock								
					//echo $producto->codigo." - ".$arrayCantidades[$i][0]." - ".$arrayCantidades[$i][1]." - ".$arrayCantidades[$i][2]."<br>";
					$existencia->guardar();												
				}														
			}				
		}			
		
		//controla que el producto ya tiene multiples talles/colores, por lo tanto permite agregar
		//if($producto->versiones == "M"){
		if($producto->controlTalles == "M" or $producto->controlColores == "M"){			
			//nuevos colores
			$temp1 = [];
			$arrayNuevosColores = json_decode($_POST['txtArrayNuevosColores'], true);			
			if($arrayNuevosColores != null){
				for($i=0; $i < count($arrayNuevosColores) ;$i++){				
					$res = array_keys(array_column($arrayCantidades, 1),$arrayNuevosColores[$i]);							
					foreach($res as $key){																	
						$temp1[] = $arrayCantidades[$key];						
					} 				
				}			
			}						
			//nuevos talles
			$temp2 = [];
			$arrayNuevosTalles = json_decode($_POST['txtArrayNuevosTalles'], true);						
			if($arrayNuevosTalles != null){							
				for($i=0; $i < count($arrayNuevosTalles) ;$i++){			
					$res = array_keys(array_column($arrayCantidades, 0),$arrayNuevosTalles[$i]);							
					foreach($res as $key){											
						$temp2[] = $arrayCantidades[$key];						
					} 				
				}			
			}									

			$nuevos = array_map("unserialize", array_unique(array_map("serialize", array_merge($temp1, $temp2))));			
			foreach($nuevos as $nuevo){				
				$existencia = new Existencia();
				//guardo en tabla existencias
				$existencia->idProducto = input("id");								
				$existencia->codProducto = $producto->codigo;														
				$existencia->talle = $nuevo[0];
				$existencia->color = $nuevo[1];
				$existencia->stock = $nuevo[2];						
				//echo input("id")." - ".$producto->codigo." - ".$nuevo[0]." - ".$nuevo[1]." - ".$nuevo[2]."<br>";
				$existencia->guardar();
			}							
		}			
		redireccionar("/productos");		
    }
  
    public function cantidad(){
        $producto = Producto::all();
        $cantidad = count($producto);        
        echo $cantidad;    
    }
      
    public function listado() {
        $productos = Producto::all();
        print_r($productos);
        die();
            foreach($productos as $productos) {
                echo $productos->nombre;
                echo $productos->stock."<br>";
            }
    }
    
}
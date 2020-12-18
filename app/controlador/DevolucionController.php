<?php
use \vista\Vista;
use \App\modelo\Devolucion;
use \App\modelo\Detalledevolucion;
use \App\modelo\Venta;
use \App\modelo\Producto;
use \App\modelo\Flujodecaja;
use \App\modelo\Existencia;

class DevolucionController {
    public function index(){
    	$data = Devolucion::all();
        return Vista::crear("devoluciones.index",array(
        	"devoluciones" => $data
        ));
    }
  
    public function creardevolucion(){       
       //recibo TODOS los array en formato JSON y los decodifico a arrays comunes 
        $arrayDidProd = json_decode($_POST['txtArrayDIdProd'], true); 
		$arrayDcantProdVen = json_decode($_POST['txtArrayDCantidadProdVen'], true); 
        $arrayDcantProdDev = json_decode($_POST['txtArrayDCantidadProdDev'], true); 
        $arrayDobservacion = json_decode($_POST['txtArrayDobservacion'], true);         
        $arrayCodxProd = json_decode($_POST['txtArrayDcodProd'], true); 
        $arrayNomxProd = json_decode($_POST['txtArrayDnomProd'], true); 
		//nuevo talle/color		
		$arrayTallexProd = json_decode($_POST['txtArrayDtalleProd'], true); 
		$arrayColorxProd = json_decode($_POST['txtArrayDcolorProd'], true); 					
		$arrayPrecioUnit = json_decode($_POST['txtArrayDPrecioUnit'], true); 
		
		//actualizamos el stock de la tabla Existencias (ya que realizamos una compra)
        $existencia = new Existencia();            
        foreach($arrayDidProd as $indice=>$valor){
            //echo "<br>ID:  ".$arrayDidProd[$indice];
            $lista_productos = Existencia::where("id", $arrayDidProd[$indice]);
            //echo "- Cantidad que se compra: ".$arrayDcantProdDev[$indice]."<br>"; //esto está bien
            foreach($lista_productos as $lista_producto){
                //echo "Stock ACTUAL (sin aumento): ".$lista_producto->stock;
                $lista_producto->stock = $lista_producto->stock + $arrayDcantProdDev[$indice];
                //echo "<br>Stock ACTUAL (con el AUMENTO): ".$lista_producto->stock."<br>";
                $existencia->id = $lista_producto->id;
                $existencia->stock = $lista_producto->stock;                
                $existencia->guardar();                     
            }    
        }
				
       //2do. se establece el estado de la venta
       $venta = Venta::find(input("txtDidVenta"));		
		//si es devolucion parcial, va "Dev_Parcial"
		//si es devolucion total, va "Anulada"
		$cantVenArray = json_decode($_POST['cantVenArray'], true); 
		$cantDevArray = json_decode($_POST['cantDevArray'], true); 			
	    
		$arraysSonIguales = ($cantVenArray == $cantDevArray); //comparo los arrays
		if($arraysSonIguales){
			//si son iguales se devolvio la misma cant que se vendio, por lo tanto se anula
			$venta->estado = "Anulada";    	
		}else{
			//si son distintos se devolvio de forma parcial las cantidades, por lo tanto es devolucion
			$venta->estado = "Dev_Parcial";    	
		}   
	    	
       $venta->guardar();
       
       //3ero. Guardo en tabla DEVOLUCIONES 
       $devolucion = new Devolucion();
        
       $devolucion->idUsuario = input("txtIdUsuario");
       $devolucion->idCliente = input("txtIdCliente");
	    	
       //4to. generamos el nro de devolucion (generamos una NOTA DE CREDITO secuencial) a asignar
		$devoluciones = Devolucion::all();
			//if (empty(end($devoluciones))){
				if (end($devoluciones) == false){
					$txtNroNotaCredito = 1;
			}else{
					$last = end($devoluciones);
					$last->nroNotaCredito = $last->nroNotaCredito + 1;    
					$txtNroNotaCredito = $last->nroNotaCredito;
			}
		$devolucion->nroNotaCredito = $txtNroNotaCredito;
				
	   //si la devolucion es con NC
		if(input("txtDevolucionEfectivo") == "NO") { 	
			$devolucion->estado = "Pendiente"; //si no se usó, PENDIENTE, si ya se usó: PROCESADA
		}else
		//si se devuelve el dinero NO se genera NC y el estado es	
		if (input("txtDevolucionEfectivo") == "SI") {			
			$devolucion->estado = "Dinero Devuelto"; // Cancelada (Dinero Devuelto)
		}
        
        $devolucion->nroVenta = input("txtDnroVenta"); //hace referencia al nro de venta anulada
        $devolucion->idComprobante = 5; //va 5 por que es el id de la nota de credito
        $devolucion->totalDevolucion = input("txtDtotal"); //total de todos los prod				
		$devolucion->totalImpuesto = input("txtDImpuesto");
		$devolucion->subTotalNeto = input("txtDSubTotal");
        $devolucion->fechaDevolucion = input("txtFechaVtaok");
        
        $devolucion->guardar();
       
		//prueba para flujo de cajas, si es devolucion en EFECTIVO NO SE GENERA UNA NOTA DE CREDITO
		if(input("txtDevolucionEfectivo") == "SI") {
			$flujodecaja = new Flujodecaja();
			$flujodecajas = Flujodecaja::all();
			$flujodecaja->fecha = date('Y/m/d H:i:s'); //toma fecha y hora actual
			$flujodecaja->descripcion = "Devolución";
			$flujodecaja->entrada = "";
			$flujodecaja->salida = abs($devolucion->totalDevolucion);
			//debo sumar al ultimo valor del saldo
			$devoluciones = Devolucion::all();
			$last = [];
			if (empty($flujodecajas)){	
				$flujodecaja->saldoActual = abs($devolucion->totalDevolucion);
			 }else{
				$last = array_pop($flujodecajas);
				$last->saldoActual = $last->saldoActual - abs($devolucion->totalDevolucion);    
				$flujodecaja->saldoActual =  $last->saldoActual;
			}
			$flujodecaja->guardar()	;	
		}
		
        //5to. Guardo el detalle en tabla DETALLEDEVOLUCIONES
        $detalledevolucion = new Detalledevolucion();        
        //recorro todos los Arrays con el mismo indice (ya que todos son del mismo tamaño).         
        foreach($arrayDidProd as $indice=>$valor){			
            $detalledevolucion->idDevolucion = $devolucion->id;//El ID de la devolucion es el mismo siempre			
            $detalledevolucion->idProducto = $arrayDidProd[$indice];                      			
			$detalledevolucion->codProd = $arrayCodxProd[$indice];
			$detalledevolucion->nomProd = $arrayNomxProd[$indice];			
			$detalledevolucion->talle = $arrayTallexProd[$indice];
			$detalledevolucion->color = $arrayColorxProd[$indice];						
            $detalledevolucion->precioUnitVenta = $arrayPrecioUnit[$indice];
            $detalledevolucion->cantVendida = $arrayDcantProdVen[$indice];
            $detalledevolucion->cantDevuelta = $arrayDcantProdDev[$indice];
			$detalledevolucion->observacion = $arrayDobservacion[$indice];	            						
        	$detalledevolucion->guardar(); 						
        }        
        redireccionar("/devoluciones/imprimirNC?id=$devolucion->id");   
   }
   
    public function detalle(){
        $devolucion = Devolucion::find(input("id"));
    	return Vista::crear("devoluciones.detalle",array(
    		"devolucion" => $devolucion
    	));
       }    
   	
	public function imprimirNC(){
		$devolucion = Devolucion::find(input("id"));
		return Vista::crear("devoluciones.imprimirNC",array(
			"devolucion" => $devolucion
		));
	}
   
    public function cantidad(){
        $devolucion = Devolucion::all();
        $cantidad = count($devolucion);        
        echo $cantidad;    
     }
    
}
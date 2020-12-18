<?php
use \vista\Vista;
use \App\modelo\Compra;
use \App\modelo\Detallecompra;
use \App\modelo\Existencia;

use \App\modelo\Detallepagocompra;
use \App\modelo\Flujodecaja;
 
class CompraController {     
    public function index(){
    	$data = Compra::all();
        return Vista::crear("compras.index",array(
        	"compras" => $data
        ));
    }
	
    public function crear(){
    	$data = Compra::all();
        return Vista::crear("compras.crear",array(
        	"compras" => $data
        ));
    }
    
    public function crearcompra(){
    	$compra = new Compra();        
        //Guardo en tabla COMPRAS
        $compra->idUsuario = input("txtIdUsuario");		
        $compra->idProveedor = input("txtIdProveedor");
        $compra->nroCompra = input("txtNroCompraOk");		
    	$compra->idComprobante = input("txtIdComprobanteCompra");				
        $compra->nroComprobante  = input("txtNroComprobanteCompra");			
        $compra->descGlobal = input("txtDescC");        		
		$compra->nom_imp = input("txtNomImpCompra"); //nombre de impuesto
		$compra->porc_imp = input("txtPorcImpCompra"); //porcentaje de impuesto
		$compra->totalImpuesto = input("txtImpuestoCompraOk"); //total de impuesto
		$compra->subTotalNeto = input("txtSubTotalCompraOk"); //subtotal Neto sin impuesto		
        $compra->totalCompra = input("txtTotalCompraOk");
    	$compra->fecha = input("txtFechaActualOk");
    	$compra->estado = "Emitida";
        $compra->guardar();        
		
        //Ahora guardo en tabla DETALLECOMPRAS
        $detallecompra = new Detallecompra();
        //recibo los array en formato JSON y los decodifico a arrays comunes
        $cantidad = $_POST['txtRowCount'];
        $arrayIdProd = json_decode($_POST['txtArrayIdProd'], true); 
        $arrayCodxProd = json_decode($_POST['txtArrayCodxProd'], true); 
		$arrayNomxProd = json_decode($_POST['txtArrayNomxProd'], true); 
		
		//nuevo talle/color
		
		$arrayIdExistenciaProd = json_decode($_POST['txtArrayIdExistenciaProd'], true);	
		$arrayTallexProd = json_decode($_POST['txtArrayTallexProd'], true);
		$arrayColorxProd = json_decode($_POST['txtArrayColorxProd'], true);
		
		$arrayCantxProd = json_decode($_POST['txtArrayCantxProd'], true);                                 
		$arrayDescxProd = json_decode($_POST['txtArrayDescxProd'], true);         
        $arrayPrecioCompraxProd = json_decode($_POST['txtArrayPrecioCompraxProd'], true); 
        $arraysubTotalxProd = json_decode($_POST['txtArraysubTotalxProd'], true); 
        //recorro todos los Arrays con el mismo indice (ya que todos son del mismo tamaño). 
        //De esta forma guardo cada producto en detalle de compra
        //Uso cualquier array, ejemplo arrayIdProd
        foreach($arrayIdProd as $indice=>$valor){
            $detallecompra->idCompra = $compra->id;//El ID de compra es el mismo siempre
            $detallecompra->idProducto = $arrayIdProd[$indice];                      
            $detallecompra->codProd = $arrayCodxProd[$indice];                      
            $detallecompra->nomProd = $arrayNomxProd[$indice];   
			
			//nuevo talle/color
			$detallecompra->talle = $arrayTallexProd[$indice];
			$detallecompra->color = $arrayColorxProd[$indice];
			
            $detallecompra->cantidad = $arrayCantxProd[$indice];                                  
            $detallecompra->descuento = $arrayDescxProd[$indice];            
            $detallecompra->precioCompra = $arrayPrecioCompraxProd[$indice];                      
            $detallecompra->total = $arraysubTotalxProd[$indice];                      
            
        $detallecompra->guardar(); 
        }
        
        //actualizamos el stock de la tabla Existencias (ya que realizamos una compra)
        $existencia = new Existencia();            
        foreach($arrayIdExistenciaProd as $indice=>$valor){
            //echo "<br>ID:  ".$arrayIdExistenciaProd[$indice];
            $lista_productos = Existencia::where("id", $arrayIdExistenciaProd[$indice]);
            //echo "- Cantidad que se compra: ".$arrayCantxProd[$indice]."<br>"; //esto está bien
            foreach($lista_productos as $lista_producto){
                //echo "Stock ACTUAL (sin aumento): ".$lista_producto->stock;
                $lista_producto->stock = $lista_producto->stock + $arrayCantxProd[$indice];
                //echo "<br>Stock ACTUAL (con el AUMENTO): ".$lista_producto->stock."<br>";
                $existencia->id = $lista_producto->id;
                $existencia->stock = $lista_producto->stock;                
                $existencia->guardar();                     
            }    
        }
		
        //Guardo en tabla PAGOS
        $detallepagocompra = new Detallepagocompra();
        
        $detallepagocompra->idCompra = $compra->id;
        $detallepagocompra->idFormaPago = input("txtIdFormaPagoC");
        $detallepagocompra->cuotas = input("txtCuotasC");
        $detallepagocompra->pagoEfectivo = input("txtPagoEfectivoC");
        $detallepagocompra->pagoDebito = input("txtPagoDebitoC");
        $detallepagocompra->pagoCredito = input("txtPagoCreditoC");
        $detallepagocompra->totalCompra = $compra->totalCompra;
        $detallepagocompra->tarjDebito = input("txtTarjetaDebitoC");
        $detallepagocompra->tarjCredito = input("txtTarjetaCreditoC");
        $detallepagocompra->fechaCompra = $compra->fecha; 
       
        $detallepagocompra->guardar();
		
		//nuevo para flujo de cajas
		if(input("txtIdFormaPagoC") == 1){
			$flujodecaja = new Flujodecaja();
			$flujodecajas = Flujodecaja::all();

			$flujodecaja->fecha = date('Y/m/d H:i:s'); //toma fecha y hora actual
			$flujodecaja->descripcion = "Compra";
			$flujodecaja->entrada = "";
			$flujodecaja->salida = $compra->totalCompra;

			//debo sumar al ultimo valor del saldo
			$compras = Compra::all();
			$last = [];

			if (empty($flujodecajas)){	
				$flujodecaja->saldoActual = $compra->totalCompra;
			 }else{
				$last = array_pop($flujodecajas);
				$last->saldoActual = $last->saldoActual - $compra->totalCompra;    
				$flujodecaja->saldoActual =  $last->saldoActual;
			}
			$flujodecaja->guardar();	
		}else 
		if(input("txtIdFormaPagoC") == 4 || input("txtIdFormaPagoC") == 5 || input("txtIdFormaPagoC") == 7){
			$flujodecaja = new Flujodecaja();
			$flujodecajas = Flujodecaja::all();

			$flujodecaja->fecha = date('Y/m/d H:i:s'); //toma fecha y hora actual
			$flujodecaja->descripcion = "Compra";
			$flujodecaja->entrada = "";
			$flujodecaja->salida = $detallepagocompra->pagoEfectivo;

			//debo sumar al ultimo valor del saldo
			$compras = Compra::all();
			$last = [];

			if (empty($flujodecajas)){	
				$flujodecaja->saldoActual = $detallepagocompra->pagoEfectivo;
			 }else{
				$last = array_pop($flujodecajas);
				$last->saldoActual = $last->saldoActual - $detallepagocompra->pagoEfectivo;    
				$flujodecaja->saldoActual =  $last->saldoActual;
			}
			$flujodecaja->guardar();
		}		     
    	redireccionar("/compras/detalle?id=$compra->id");   
    }    
      
    public function detalle(){
        $compra = Compra::find(input("id"));
    	return Vista::crear("compras.detalle",array(
    		"compra" => $compra
    	));
    }
    
	public function imprimir(){
        $compra = Compra::find(input("id"));
    	return Vista::crear("compras.imprimir",array(
    		"compra" => $compra
    	));
    }
	    
    public function historial(){
    	$data = Compra::all();
        return Vista::crear("compras.historial",array(
        	"compras" => $data
        ));    
    }
        
    public function cantidad(){
        $compra = Compra::all();
        $cantidad = count($compra);        
        echo $cantidad;    
    }   
}

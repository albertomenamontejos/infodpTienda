<?php
use \App\modelo\Genero;
use \App\modelo\Rubro;
use \App\modelo\Categoria;
use \App\modelo\Estilo;
use \App\modelo\Marca; 
use \App\modelo\Talle;
use \App\modelo\Color;
use \App\modelo\Existencia;
use \App\modelo\Parametro;
$parametro = Parametro::find(1); //para que me traiga los param de la moneda  
include("vistas/includes/menuSupABM.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-lg-12">
                <hr>
			</div>
        </div>	
		<div class="row">
		<form action="<?php url("productos/editarproducto") ?>" method="POST" role="form">
			<div class="col-lg-12">	
				<div class="panel panel-azulTienda">
					<div class="panel-heading">
				  		<h3 class="panel-title">Editar producto</h3>
				    </div>	
                    <div class="panel-body">    
						<input type="hidden" value="<?php echo $producto->id ?>" name="id" id="id">                         
						<div class="form-group">
						<div class="row">	
						<div class="col-lg-6">
							<label for="">Código</label>
							<input value="<?php echo $producto->codigo ?>" id="txtCodigo" name="txtCodigo" class="form-control" type="text" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9_-]{1,35}" required autofocus tabindex="1">
						</div>    
						<div class="col-lg-6">	
							<label for="">Nombre</label>
							<input value="<?php echo $producto->nombre ?>" id="txtNombre" name="txtNombre" type="text" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9._-]{1,50}" class="form-control" required tabindex="2">
						</div>
						</div>						
						<div class="row"> 
						<div class="col-lg-3">
							<label for="txtRubro">Rubros</label>
							<select class="form-control" id="txtRubro" name="txtRubro" tabindex="3" style="color:#337ab7;" disabled>
							<?php
							$rubros = Rubro::all();
							foreach($rubros as $rubro) {
							?>
							<option value="<?php echo $rubro->id; ?>">
								<?php
									echo $rubro->descripcion;
								?>  
							</option>
							<?php    
							}
							?> 
							</select>
							<!--Aquí guardamos el ID de la genero para enviarlo al GeneroController -->
							<!--Esto se hace con jquery dentro de codigo_base.js -->    
							<input name="txtIdRubro" id="txtIdRubro" value="<?php echo $producto->idRubro;?>" type="hidden">
						</div>	
						<div class="col-lg-3">
							<label for="txtGenero">Géneros</label>
							<select class="form-control" id="txtGenero" name="txtGenero" tabindex="4" style="color:#337ab7;" disabled>
							<?php
							$generos = Genero::all();
							foreach($generos as $genero) {
							?>
							<option value="<?php echo $genero->id; ?>">
								<?php
									echo $genero->descripcion;
								?>  
							</option>
							<?php    
							}
							?> 
							</select>
							<!--Aquí guardamos el ID de la genero para enviarlo al GeneroController -->
							<!--Esto se hace con jquery dentro de codigo_base.js -->    
							<input name="txtIdGenero" id="txtIdGenero" value="<?php echo $producto->idGenero;?>" type="hidden">       							
						</div>						
						<div class="col-lg-6">
							<label for="txtCategoria">Categorías</label>
							<select class="form-control" id="txtCategoria" name="txtCategoria" tabindex="5" style="color:#337ab7;" disabled>
							<?php
							$categorias = Categoria::all();
							foreach($categorias as $categoria) {
							?>
							<option value="<?php echo $categoria->id; ?>">
								<?php
									echo $categoria->descripcion;
								?>  
							</option>
							<?php    
							}
							?> 
							</select>
							<!--Aquí guardamos el ID de la categoria para enviarlo al ProductoController -->
							<!--Esto se hace con jquery dentro de codigo_base.js -->    
							<input name="txtIdCategoria" id="txtIdCategoria" value="<?php echo $producto->idCategoria;?>" type="hidden">
						</div>	 
						</div>	
						<div class="row">							
						<div class="col-lg-3">
							<label for="txtEstilo">Estilos</label>
							<select class="form-control" id="txtEstilo" name="txtEstilo" tabindex="6">
							<?php
							$estilos = Estilo::all();
							foreach($estilos as $estilo) {
							?>
							<option value="<?php echo $estilo->id; ?>">
								<?php
									echo $estilo->descripcion;
								?>  
							</option>
							<?php    
							}
							?> 
							</select>
							<!--Aquí guardamos el ID de la genero para enviarlo al GeneroController -->
							<!--Esto se hace con jquery dentro de codigo_base.js -->    
							<input name="txtIdEstilo" id="txtIdEstilo" value="<?php echo $producto->idEstilo;?>" type="hidden">       
						</div>
						<div class="col-lg-3">
							<label for="txtMarca">Marcas</label>
							<select class="form-control" id="txtMarca" name="txtMarca" tabindex="7">
							<?php
							$marcas = Marca::all();
							foreach($marcas as $marca) {
							?>
							<option value="<?php echo $marca->id; ?>">
								<?php
									echo $marca->descripcion;
								?>  
							</option>
							<?php    
							}
							?> 
							</select>							
							<input name="txtIdMarca" id="txtIdMarca" value="<?php echo $producto->idMarca;?>" type="hidden"> 
						</div>	
						<div class="col-lg-3">    
							<label for="">Precio de Compra</label>
							<div class="input-group">
							<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
							<input value="<?php echo $producto->precioCompra ?>" name="txtPrecioCompra" type="number" step="any" min="1" class="form-control" required tabindex="8">
							</div>	
						</div>
						<div class="col-lg-3">    
							<label for="">Precio de Venta</label>
							<div class="input-group">
							<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
							<input value="<?php echo $producto->precioVenta ?>" name="txtPrecioVenta" type="number" step="any" min="1" class="form-control" required tabindex="9">
							</div>	
						</div>	
							
							
						</div>	
						<hr>
						<div class="row">						
						<div class="col-lg-3">	
							<?php	
							$arrayStockUni = [];								   
							$existencias = Existencia::all();	
	   	   
							foreach ($existencias as $existencia){								
								 if($existencia->idProducto == $producto->id){
									//$arrayStockUni[]= [$existencia->talle, $existencia->stock];
									$arrayStockUni[]= [$existencia->id,$existencia->talle,$existencia->color,$existencia->stock];
									$cantidad+= $existencia->stock; //sumo el stock total				
									//$arrayStockUni[] = $existencia->stock;//para guardar stock unitario 
									$cantIdProd++;//cuantas veces se repite el IdProducto
								 }								 
							}
															   
							$arrayStockOrdenado = [];
							//funcion que ordena por dos columnas	   
							function array_msort($array, $cols){
								$colarr = array();
								foreach ($cols as $col => $order) {
									$colarr[$col] = array();
									foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
								}
								$eval = 'array_multisort(';
								foreach ($cols as $col => $order) {
									$eval .= '$colarr[\''.$col.'\'],'.$order.',';
								}
								$eval = substr($eval,0,-1).');';
								eval($eval);
								$ret = array();
								foreach ($colarr as $col => $arr) {
									foreach ($arr as $k => $v) {
										$k = substr($k,1);
										if (!isset($ret[$k])) $ret[$k] = $array[$k];
										$ret[$k][$col] = $array[$k][$col];
									}
								}
								return $ret;
							}	   
							$arrayOrder = array_msort($arrayStockUni, array('1'=>SORT_ASC, '2'=>SORT_ASC));	   
							$arrayStockOrdenado = array_values($arrayOrder);	   
							//var_dump($arrayStockOrdenado);
							?>																					
							<label for="">Stock Total</label>
							<input name="txtStock" id="txtStock" type="number" class="form-control" value="<?php echo $cantidad?>" tabindex="10" disabled>
						</div>
						<input name="txtArrayCantidades" id="txtArrayCantidades" type="hidden"> 						
						<input name="txtArrayNuevosTalles" id="txtArrayNuevosTalles" type="hidden">
						<input name="txtArrayNuevosColores" id="txtArrayNuevosColores" type="hidden">
						<div class="col-lg-3">
						<br>	
							<div>																				
								<input class="checkbox-custom" type="checkbox" name="chkTU" id="chkTU" value="" <?php if ($producto->controlTalles == "U" ) echo 'checked' ; ?> disabled>
								<label for="chkTU" class="checkbox-custom-label">Talle U</label>							<input class="checkbox-custom" type="checkbox" name="chkCU" id="chkCU" value="" <?php if ($producto->controlColores == "U" ) echo 'checked' ; ?> disabled>
								<label for="chkCU" class="checkbox-custom-label">Color U</label>
							</div>	
						</div>	
						<div class="col-lg-3">														
						<label>Tabla</label>	
						<br>	
						<button id="btnActualizarStock" name="btnActualizarStock" type="button" class="btn btn-primary" tabindex="11">Talles y Colores</button>								
						</div>    											
						<div class="col-lg-3">	
							<label>Código de Barras</label>	
							<div class="input-group">	
							<select name="formatoCodeBar" id="formatoCodeBar" class="form-control" tabindex="12">		
<option value="Ninguno" <?php if ($producto->formato_codigo == "Ninguno") echo ' selected="selected"' ;?>>Ninguno</option>
<option value="EAN-13" <?php if ($producto->formato_codigo == "EAN-13") echo ' selected="selected"' ;?>>EAN-13</option>
<option value="CODE128" <?php if ($producto->formato_codigo == "CODE128") echo ' selected="selected"' ;?>>CODE128</option>
							</select>	
							<span class="input-group-btn">	
								<a class="btn btn-info" id="btnGenerarCodigo" tabindex="11" style="color:white;">Generar</a>
							</span>	
							</div>	
						</div>	
						</div>	
						<div class="col-lg-12 text-center">
							<div id="printCodeBar" style="display:none;">
							   <svg id="barcode"></svg>					
							</div>
							<br>
							<button class="btn btn-default" id="btnImpCodeBar" type="button" style="display:none">Imprimir</button>
						</div>  
						</div>
                    </div>
						<div class="panel-footer clearfix">
							<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>" tabindex="13"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
							<button type="submit" id="btnEditarProd" class="btn btn-danger pull-right" tabindex="12"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>      
						</div>
                </div>	
			</div>	
		</form>		
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<!-- Modal Alta de Existencias -->
<div class="modal fade" id="modal_alta_existencias" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header modal-header-primary">
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 class="modal-title" id="">Actualizar Stock</h4>	 	 
  </div>		
	<div class="panel-body"> 			
		<div class="form-group">			
			<div class="row">				
			<div class="col-lg-12">                        
				<button id="btnAgregarFilCol" class="btn btn-naranja btn-sm" data-toggle="tooltip" title="Agregar Talles y/o Colores"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Talles/Colores</button>
				<div class="table-responsive">        				
				<table id="tablaTalleColor" class="table table-condensed table-bordered" cellspacing="0" width="100%">
					<thead>
						<th class="text-center" style="width:15%">Talle / Color</th>
							<?php 
							//nuevo obtengo los datos directamente de tabla existencias							
							$existencias = Existencia::all();							
							foreach ($existencias as $existencia) {
								if($existencia->idProducto == $producto->id){	
									$arrayC[] = $existencia->color;
									$arrayT[] = $existencia->talle;
								}
							}
							$arrayColores = array_unique($arrayC);
							sort($arrayColores);							
							foreach($arrayColores as $arrayColor){
							?>														
						<th class="text-center"><?php echo $arrayColor; ?></th>						
							<?php							
							}								
							?>	
					</thead>						
					<tbody>							
					<?php	
						$j=0;												
						$arrayTalles = array_unique($arrayT);	
						sort($arrayTalles);
						foreach($arrayTalles as $arrayTalle){					
					?>							
						<tr>														
							<td class="text-center" style="background-color:#337ab7; color:white;"><?php echo $arrayTalle; ?></td>
							<?php														
							$cantCol = count($arrayColores); 														
							for ($i = 1; $i <= $cantCol; $i++) {														
								echo "<td class='text-center cantidad' onkeypress='return testEnteros(event);' contenteditable='true'>".$arrayStockOrdenado[$j][3]."</td>";
								$j = $j + 1;								
							}											
							?>														
						</tr>																			
					<?php						
						}//foreach							
					?>
					</tbody>									
				</table>
				</div>
			</div>
			</div>
		</div>			
	</div>        
	  <div class="modal-footer clearfix">		
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex=""><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
		<button id="btnSaveTalleColor" name="btnSaveTalleColor" type="button" class="btn btn-danger pull-right" tabindex=""><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>
	  </div>	
</div>
</div>
</div>	 
<!--Modal Agregar talles y/o colores-->
<div id="modal_agregarTalleColor" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header modal-header-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Talles/Colores</h4>
      </div>
      <div class="modal-body">
		 <div id="nuevosTalles" class="row">
			 <div class="col-lg-12">
				<label for="">Talles</label>
				<div class="input-group">
					<select class="form-control" id="txtTalle" name="txtTalle" tabindex="7">						
					</select>
					<span class="input-group-btn">	
						<a class="btn btn-naranja" id="btnAgregarTalle" name="btnAgregarTalle" tabindex="">Agregar</a>
					</span>
				</div>	
			 </div>
		 </div>	 
			 		
		 <div id="nuevosColores" class="row">
			 <div class="col-lg-12">				 
				<label for="">Colores</label>
				<div class="input-group">
				<select class="form-control" id="txtColor" name="txtColor" tabindex="8">									</select>			
				<span class="input-group-btn">	
					<a class="btn btn-naranja" id="btnAgregarColor" name="btnAgregarColor" tabindex="">Agregar</a>
				</span>
			</div>	
			 </div>
		  </div>
      </div>
      <div class="modal-footer clearfix">				
	  </div>
    </div>
  </div>
</div>
<script>
$('#txtGenero > option[value="<?php echo $producto->idGenero; ?>"]').attr('selected', 'selected');
$('#txtRubro > option[value="<?php echo $producto->idRubro; ?>"]').attr('selected', 'selected');
$('#txtCategoria > option[value="<?php echo $producto->idCategoria; ?>"]').attr('selected', 'selected');  	
$('#txtEstilo > option[value="<?php echo $producto->idEstilo; ?>"]').attr('selected', 'selected');            
$('#txtMarca > option[value="<?php echo $producto->idMarca; ?>"]').attr('selected', 'selected');        

$('#txtIdGenero').val(<?php echo $producto->idGenero;?>);
$('#txtIdRubro').val(<?php echo $producto->idRubro;?>);		
$('#txtIdCategoria').val(<?php echo $producto->idCategoria;?>);		
$('#txtIdEstilo').val(<?php echo $producto->idEstilo;?>);		
$('#txtIdMarca').val(<?php echo $producto->idMarca;?>);	
idGenero = $('select#txtGenero').val();				
idRubro = $('select#txtRubro').val();
idCategoria = $('select#txtCategoria').val();		
</script>
<script src="<?php asset("bower_components/js/codigo_productos_editar.js")?>"></script>
<?php
    include("vistas/includes/menuInferior.php");
?>
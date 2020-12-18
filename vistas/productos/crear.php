<?php
use \App\modelo\Producto;
use \App\modelo\Genero;
use \App\modelo\Rubro;
use \App\modelo\Categoria;
use \App\modelo\Estilo;
use \App\modelo\Marca;
use \App\modelo\Talle;
use \App\modelo\Color;
use \App\modelo\Parametro;
$parametro = Parametro::find(1);
include("vistas/includes/menuSupABM.php");
?> 
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">				
				<hr>
				<div id="cuerpo"><h1><?php echo $_SESSION['var'];?></h1></div>				
			</div>	
		</div>
		<form action="<?php url("productos/crearproducto") ?>" method="POST" role="form" id="formCrearProducto">	
                <div class="panel panel-azulTienda">
				  <div class="panel-heading">
					<h3 class="panel-title">Nuevo Producto</h3>
				  </div>
                  <div class="panel-body">
						<div class="form-group">
						<div class="row">
						<div class="col-lg-6">
							<label for="">Código</label>
							<input name="txtCodigo" type="text" class="form-control" id="txtCodigo" placeholder="" required pattern="[A-Za-z0-9_-]{1,35}" style="text-transform:uppercase" autofocus tabindex="1">  
						</div>	   
						<div class="col-lg-6">	
							<label for="">Nombre</label>
							<input name="txtNombre" type="text" class="form-control" id="" pattern="[A-Z a-zñÑáéíóúÁÉÍÓÚ0-9_-]{1,50}" required tabindex="2">
						</div>   
						</div>	
						<div class="row"> 
						<div class="col-lg-3">
							<label for="txtGenero">Rubros</label>					
							<select class="form-control" id="txtRubro" name="txtRubro" tabindex="3" style="background-color:#337ab7; color:white;">
							<?php
							$rubros = Rubro::all();
							foreach($rubros as $rubro) {
							?>
							<option value="<?php echo $rubro->id;?>">
								<?php
									echo $rubro->descripcion;										
								?>  
							</option>
							<?php																
							}
							?> 
							</select>																		
							<input name="txtIdRubro" id="txtIdRubro" value="<?php echo $producto->idRubro;?>" hidden>
						</div>	
						<div class="col-lg-3">
							<label for="txtGenero">Géneros</label>
							<select class="form-control" id="txtGenero" name="txtGenero" tabindex="4" style="background-color:#337ab7; color:white;">
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
							<input name="txtIdGenero" id="txtIdGenero" value="<?php echo $producto->idGenero;?>" hidden>       
						</div>																
						<div class="col-lg-6">
							<label for="txtCategoria">Categorías</label>
							<select class="form-control" id="txtCategoria" name="txtCategoria" tabindex="5" style="background-color:#337ab7; color:white;">
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
							<input name="txtIdCategoria" id="txtIdCategoria" value="<?php echo $producto->idCategoria;?>" hidden>
						</div>	
						</div>	
							
						<div class="row">	
						<div class="col-lg-3">
							<label for="txtGenero">Estilos</label>
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
							<input name="txtIdEstilo" id="txtIdEstilo" value="<?php echo $producto->idEstilo;?>" hidden>       
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
								<!--Aquí guardamos el ID de la marca para enviarlo al MarcaController  -->
								<!--Esto se hace con jquery dentro de codigo_base.js -->    
								<input name="txtIdMarca" id="txtIdMarca" value="<?php echo $producto->idMarca;?>" hidden>   
							</div>	
						<div class="col-lg-3">	
							<label for="">Precio de Compra</label>
							<div class="input-group">
							<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
							<input name="txtPrecioCompra" id="txtPrecioCompra" type="number" step="any" min="1" pattern="[A-Za-z0-9_-]{1,20}" class="form-control" required tabindex="8">
							</div>	
						</div>
						<div class="col-lg-3">	
							<label for="">Precio de Venta</label>
							<div class="input-group">
							<span class="input-group-addon"><?php echo $parametro->moneda;?></span> 
							<input name="txtPrecioVenta" id="txtPrecioVenta" type="number" step="any" min="1" class="form-control" required tabindex="9">
							</div>	
						</div>								
						</div>							
						<hr>
						<div class="row">								
							<div class="col-lg-3">	
							<label for="">Stock Total</label>
							<input name="txtStock" id="txtStock" type="number" value="0" min="0" class="form-control" required tabindex="10" disabled>
							</div>    							
							<input name="txtArrayCantidades" id="txtArrayCantidades" hidden> 
							<input name="txtControlTalles" id="txtControlTalles" hidden>
							<input name="txtControlColores" id="txtControlColores" hidden>
							<div class="col-lg-3">
							<br>	
								<div>
									<input class="checkbox-custom" type="checkbox" name="chkTU" id="chkTU" value="">
									<label for="chkTU" class="checkbox-custom-label">Talle U</label>
									
									<input class="checkbox-custom" type="checkbox" name="chkCU" id="chkCU" value="">
									<label for="chkCU" class="checkbox-custom-label">Color U</label>
								</div>	
							</div>
							<div class="col-lg-3">																
							<label for="btnActualizarStock">Actualizar</label>	
							<br>							
							<button id="btnActualizarStock" name="btnActualizarStock" type="button" class="btn btn-primary" tabindex="11">Talles y Colores</button>	
							</div> 		
							
						
							<div class="col-lg-3">	
							<label>Código de Barras</label>	
							<div class="input-group">	
							<select name="formatoCodeBar" id="formatoCodeBar" class="form-control" tabindex="12">		
								<option value="Ninguno" selected>NINGUNO</option>
								<option value="EAN-13">EAN-13</option>
								<option value="CODE128">CODE128</option>								
							</select>		
							<span class="input-group-btn">	
								<a class="btn btn-info" id="btnGenerarCodigo" tabindex="13" style="color:white;">Generar</a>
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
					<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>" tabindex="15"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
					<button name="btnSubmit" type="submit" class="btn btn-danger pull-right" tabindex="14"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
				  </div>
                </div>  				
		</form>	 		
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
<form id="">
	<div class="panel-body"> 			
		<div class="form-group">			
			<div class="row">				
			<div class="col-lg-12">                        
				<div class="table-responsive">
				<table id="tablaTalleColor" class="table table-condensed table-bordered" cellspacing="0" width="100%">			<thead>
						<th class="text-center">Talle / Color</th>					
					</thead>
					<tbody>
					</tbody>
				</table>						
				</div>
			</div>
			</div>
		</div>			
	</div>        
	  <div class="modal-footer clearfix">
		<button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex="2"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
		<button id="btnSaveTalleColor" type="button" class="btn btn-danger pull-right" tabindex="1"><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>
	  </div>	
</form>	
</div>
</div>
</div>	 

<!-- tabla no visible solo para control de codigos que no se repita al crear nuevo prod -->
<table id="tablaCodigos" style="display:none;">
	<thead>
		<tr>
			<th>Código</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$productos = Producto::all()   ;
	foreach ($productos as $producto) {
	?>
		<tr>
			<td><?php echo $producto->codigo; ?></td>
		</tr>
	<?php
	} ?>
	</tbody>
</table>

<script src="<?php asset("bower_components/js/codigo_productos_crear.js")?>"></script>
<?php	
    include("vistas/includes/menuInferior.php");
?>
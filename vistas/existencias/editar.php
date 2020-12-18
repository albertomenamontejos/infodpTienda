<?php
if ($_SESSION["privilegio"] != "admin"){
	redireccionar("/admin/error");
}
use \App\modelo\Producto;
include("vistas/includes/menuSupLimpio.php");
?> 
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">			
		<hr>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-azulTienda">
					  <div class="panel-heading">
							<h3 class="panel-title">Editar Producto</h3>
					  </div>
						 <form action="<?php url("existencias/editarexistencia") ?>" method="POST" role="form">
					  <div class="panel-body">            
						<input type="hidden" value="<?php echo $existencia->id ?>" name="id">
						<div class="col-lg-6 form-group">
							<label for="">Código de Producto</label>
							<input value="<?php echo $existencia->codProducto ?>" name="txtCodProducto" type="text" class="form-control" id="" placeholder="" tabindex="1" disabled>    
						</div> 						
						<div class="col-lg-6 form-group">
							<label for="">Nombre del Producto</label>
							<?php
							$producto = Producto::find($existencia->idProducto);
							?>
							<input value="<?php echo $producto->nombre ?>" name="txtNombre" type="text" class="form-control" id="" placeholder="" tabindex="2" disabled>    
						</div>  
						  
						<div class="col-lg-6 form-group">
							<label for="">Talle</label>
							<input value="<?php echo $existencia->talle ?>" name="txtTalle" type="text" class="form-control" id="" placeholder="" tabindex="3" disabled>    
						</div>
						<div class="col-lg-6 form-group">
							<label for="">Color</label>
							<input value="<?php echo $existencia->color ?>" name="txtColor" type="text" class="form-control" id="" placeholder="" tabindex="4" disabled>    
						</div>
						<div class="col-lg-6 form-group">
							<label for="">Stock</label>
							<input value="<?php echo $existencia->stock ?>" name="txtStock" type="number" class="form-control" id="" placeholder="" tabindex="5" autofocus>    
						</div>
					  </div>
					  <div class="panel-footer clearfix">
							<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
							<button type="submit" class="btn btn-danger pull-right" tabindex="3"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
					  </div>
				   </form>			 
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->
<?php
    include("vistas/includes/menuInferior.php");
?>
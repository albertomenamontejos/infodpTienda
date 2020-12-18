<?php
//comprobamos si tiene privilegios de admin para ver la pag - funciona OK
if($_SESSION["privilegio"] != "admin" || $_SESSION["user"] != "admin"){
	redireccionar("/admin/error");
}
include("vistas/includes/menuSupABM.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">    	
        <br>
        <div class="row">
			<hr>
        	<div class="col-lg-12">    
				<form role="form" action="<?php url("usuarios/editarusuario") ?>" method="post">
				<div class="panel panel-azulTienda">
					<div class="panel-heading">Editar Usuario</div>
					<div class="panel-body">
						<input type="hidden" value="<?php echo $usuario->id ?>" name="id" id="id">
						<label for="">Cuenta de Usuario</label>
						<div class="input-group">							
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span><strong><input class="form-control" placeholder="" value="<?php echo $usuario->user;?>" name="txtUser" id="txtUser" type="text" tabindex="1" required autofocus></strong>
						</div>
						<br>
						<label for="">Nombre y Apellido</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span><strong><input class="form-control" placeholder="Nombre y Apellido" name="txtNomyApe" id="txtNomyApe" type="text" value="<?php echo $usuario->nomyape ?>" required autocomplete="on" tabindex="2"></strong>
						</div>     
						<br>      
						<label for="">Dirección</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span><strong><input class="form-control" placeholder="Dirección" value="<?php echo $usuario->direccion; ?>" name="txtDireccion" id="txtDireccion" type="text"  required autocomplete="on" tabindex="3"></strong>
						</div>     
						<br> 
						<label for="">Teléfono</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span><strong><input class="form-control" placeholder="Teléfono" value="<?php echo $usuario->telefono; ?>" name="txtTelefono" id="txtTelefono" type="text"  required autocomplete="on" tabindex="4"></strong>
						</div>     
						<br>
						<label for="">E-mail</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span><input class="form-control" placeholder="E-mail" value="<?php echo $usuario->email; ?>" name="txtEmail" id="txtEmail" type="email" required autocomplete="on" tabindex="5">
						</div>     
						<br>
						<label for="">Permisos</label>	
						<div class="input-group">    
						  <span class="input-group-addon"><i class="fa fa-briefcase fa-fw"></i> Rol: </span>
						<strong>
						  <select id="txtPrivilegio" name="txtPrivilegio" class="selectpicker form-control"  tabindex="6">
							  <option value="admin" <?php if ($usuario->privilegio == "admin") echo ' selected="selected"' ;?> >Administrador</option>
							  <option value="normal" <?php if ($usuario->privilegio == "normal") echo ' selected="selected"' ;?> >Normal</option>
						   </select>
						</strong>
						</div>  							
					</div> 
					<div class="panel-footer clearfix">
						<a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>  
						<button type="submit" class="btn btn-danger pull-right" tabindex="7"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
					</div>
				</div>
				</form>	
            </div>			        
        </div>       
		 <div class="row">
        	<div class="col-lg-12 text-center">   
				<button class="btn btn-naranja" id="btnResetPass" name="btnResetPass">Resetear Password</button>
			 </div>
		</div> 
	</div>
</div>     
<!-- Contenido Principal -->
<?php
    include("vistas/includes/menuInferior.php");
?>
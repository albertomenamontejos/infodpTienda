<?php
//comprobamos si tiene privilegios de admin para ver la pag - funciona OK
if($_SESSION["privilegio"] == "normal" && $usuario->id == $_SESSION["id"]){
	//url("usuarios/editar?id=$usuario->id");
}else
if ($_SESSION["privilegio"] != "admin"){
	redireccionar("/admin/error");
}    
include("vistas/includes/menuSupABM.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
    	<hr>		
		<div class="row">        
			<div class="col-lg-12">    
				<form role="form" action="<?php url("usuarios/editarperfilusuario") ?>" method="post">                 
					<div class="panel panel-naranja">
						<div class="panel-heading">Editar Perfil de usuario</div>
							<div class="panel-body">
								<input type="hidden" value="<?php echo $usuario->id ?>" name="id">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span><strong><input class="form-control" placeholder="Nombre y Apellido" name="txtNomyApe" id="txtNomyApe" type="text" value="<?php echo $usuario->nomyape ?>" required autocomplete="on" autofocus tabindex="1"></strong>
								</div>     
								<br>      
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-home fa-fw"></i></span><strong><input class="form-control" placeholder="Dirección" value="<?php echo $usuario->direccion; ?>" name="txtDireccion" id="txtDireccion" type="text"  required autocomplete="on" tabindex="2"></strong>
								</div>     
								<br> 
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-phone fa-fw"></i></span><strong><input class="form-control" placeholder="Teléfono" value="<?php echo $usuario->telefono; ?>" name="txtTelefono" id="txtTelefono" type="text" autocomplete="on" tabindex="3"></strong>
								</div>     
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa-fw"></i></span><input class="form-control" placeholder="E-mail" value="<?php echo $usuario->email; ?>" name="txtEmail" id="txtEmail" type="email" required autocomplete="on" tabindex="4">
								</div>     
								<br>
								<hr>								
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span><input class="form-control" placeholder="Ingrese su password" name="password" id="password" type="password" required tabindex="5">
								</div>
								<br>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span><input class="form-control" placeholder="Confirme su password" name="confirmaPassword" id="confirmaPassword" type="password" required tabindex="6">
								</div>
								<br>  
							</div> 						
							   <input name="txtUser" id="txtUser" type="hidden">   
                            <input name="txtPassword" id="txtPassword" type="hidden">                              
                            <button type="submit" id="btnRegistrarUsuario" name="btnRegistrarUsuario" style="display:none;"></button>	
					</div>
				</form> 
			</div>  
			<div class="col-lg-12">
			  <div class="panel-group">
				<div class="panel panel-naranja">
				  <div class="panel-body">
					<div class="btn-group">
						 <a class="btn btn-default pull-left" href="<?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?>"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a> 
					</div>
					<div class="btn-group pull-right">
					  <div class="btn-group">  
						 <button id="btnControlaPass2" class="btn btn-naranja" tabindex="8"><i class="fa fa-floppy-o" aria-hidden="true" tabindex="7"></i> Guardar</button>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div> 		
	</div>
</div>     
<!-- Contenido Principal -->
<?php
    include("vistas/includes/menuInferior.php");
?>
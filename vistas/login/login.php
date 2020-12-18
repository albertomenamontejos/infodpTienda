<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content=""> 
    <title>InfoDP | TIENDA</title>
    <!-- Para ICONOS -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php asset("img/icoDP/apple-icon-57x57.png") ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php asset("img/icoDP/apple-icon-60x60.png") ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php asset("img/icoDP/apple-icon-72x72.png") ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php asset("img/icoDP/apple-icon-76x76.png") ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php asset("img/icoDP/apple-icon-114x114.png") ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php asset("img/icoDP/apple-icon-120x120.png") ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php asset("img/icoDP/apple-icon-144x144.png") ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php asset("img/icoDP/apple-icon-152x152.png") ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php asset("img/icoDP/apple-icon-180x180.png") ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php asset("img/icoDP/android-icon-192x192.png") ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php asset("img/icoDP/favicon-32x32.png") ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php asset("img/icoDP/favicon-96x96.png") ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php asset("img/icoDP/favicon-16x16.png") ?>">
    <link rel="manifest" href="<?php asset("img/icoDP/manifest.json") ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php asset("img/icoDP/ms-icon-144x144.png") ?>">
    <meta name="theme-color" content="#ffffff">    
	
	<link rel="shortcut icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">
	<link rel="icon" href="<?php asset("img/icoDP/favicon.ico") ?>" type="image/x-icon">	
	<!-- Archivos CSS -->
 	<!-- Bootstrap Core CSS -->
    <link href="<?php asset("bower_components/bootstrap/css/bootstrap.min.css") ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php asset("bower_components/metisMenu/dist/metisMenu.min.css")?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php asset("bower_components/css/sb-admin-2.css")?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php asset("bower_components/font-awesome/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"> 
    <!--Archivos CSS para Alertify -->
    <!-- include the style -->
    <link href="<?php asset("bower_components/alertify/css/alertify.min.css") ?>" rel="stylesheet">
    <!-- include a theme -->
    <link href="<?php asset("bower_components/alertify/css/themes/bootstrap.min.css") ?>" rel="stylesheet">			
	<!-- Archivos JS -->
	<!-- jQuery -->
	<script src="<?php asset("bower_components/js/jquery.min.js")?>"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="<?php asset("bower_components/bootstrap/js/bootstrap.min.js")?>"></script>    
	<!-- Metis Menu Plugin JavaScript -->
	<script src="<?php asset("bower_components/metisMenu/dist/metisMenu.min.js")?>"></script>
	<!-- Custom Theme JavaScript -->
	<script src="<?php asset("bower_components/js/sb-admin-2.js")?>"></script>
	<!--Código custom JS para alertify -->
	<script src="<?php asset("bower_components/alertify/alertify.min.js")?>"></script>	
	<script>
	$(document).ready(function(){
		$('#page-loader').fadeOut(500);
	});
	</script>
</head>
<body id="login_body">
	<div id="page-loader"><span class="preloader-interior"></span></div>
<div class="container">
    <div class="row">		
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-azulTienda">                
                <div class="panel-body" id="panel-login">
					<div id="logoContenedor" >
						<img src="<?php asset("img/logos/logoDP.png")?>" alt="logo" id="logoLogin">			
					</div>
					<h2 class="panel-title text-center" style="color:white;">InfoDP TIENDA</h2>					
					<br>
                    <form role="form" action="<?php url("login/ingresar") ?>" method="post">						
                        <input value="<?php csrf_token() ?>" name="_token" type="hidden">						
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa-fw text-info"></i></span>
							<input class="form-control" placeholder="usuario" name="user" pattern="[A-Za-z0-9_-]{1,20}" id="user" type="text" required autocomplete="on" autofocus>
                        </div>     
                        <br>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key fa-fw text-info"></i></span>
							<input class="form-control" placeholder="password" name="password" pattern="[A-Za-z0-9_-]{1,20}" id="password" type="password" required>
                        </div>
                            <br>
                            <button type="submit" id="singin" class="btn btn-lg btn-redTienda btn-block">Ingresar</button>
                    </form>					
                </div>
				
            </div>
        </div>
    </div>
</div>	
</body>
</html>
<?php
    //como usuario y/o pass son incorrectos envia un mensaje de error
    if (isset($_SESSION["valor"]) == "false") {
        echo "<script>     
                    alertify.error('Usuario y/o password incorrectas');
              </script>";
    }
?>
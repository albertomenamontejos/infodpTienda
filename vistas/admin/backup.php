<?php
include("vistas/includes/menuSupLimpio.php");
?>
<!-- Contenido Principal -->
    <div id="page-wrapper">
        <div class="container-fluid">
			<h2 class="hstyle">Backup de Datos</h2>
			<hr>
            <div class="row">
                <div class="col-lg-4">                                          
                        <div class="panel panel-celeste">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-database fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">
                                        
                                        </div>
                                        <div>Copia de Seguridad</div>
                                    </div>
                                </div>
                            </div>                           
                                <div class="panel-footer">
                                    <span class="pull-left"></span>
                                    <span>Realice diariamente un Backup</span>
                                    <div class="clearfix"></div>
                                </div>                            
                        </div>                
                </div>				
            </div>
			<p>Notas:</p>
			<p>Si la instalación del sistema se realiza de forma LOCAL, el backup se realiza desde esta opción.</p>
			<p>Si la instalación del sistema se realiza en un HOSTING WEB, el backup debe realizarse con las herramientas de copia de seguridad que brinde el hosting contratado.</p>
        </div>
    </div>
<!-- Contenido Principal -->
<script>
	alertify.success("¡Backup generado con Éxito!")    
</script>                    
<?php
    include("vistas/includes/menuInferior.php");
	exec('C:\wamp\bin\mysql\mysql5.6.17\bin\mysqldump --user=root --password=root2017 --host=localhost bd_infodp_tienda > C:\wamp\www\infodpTienda\bkp\bd_infodp_tienda_%Date:~6,4%%Date:~3,2%%Date:~0,2%_.sql');
?>
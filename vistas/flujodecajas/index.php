<?php
use \App\modelo\Parametro;
$parametro = Parametro::find(1); //para que me traiga los param de la moneda    
include("vistas/includes/menuSupFlujo.php");            
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">                        
			<h3 class="hstyle">Flujo de Dinero</h3>
			<br>	
			<button id="btnIngreso" class="btn btn-success" aria-hidden="true" data-toggle="tooltip" title="Ingresar Dinero"><span class="glyphicon glyphicon-plus"></span> Dinero</button>				
			<button id="btnEgreso" class="btn btn-danger pull-right" aria-hidden="true" data-toggle="tooltip" title="Retirar Dinero"><span class="glyphicon glyphicon-minus"></span> Dinero</button>	
			</div>
		</div>			
		<hr>		
		<div class="row">
			<div class="col-lg-12"> 
				<div class="table-responsive">    
				<table id="tablaFlujos" class="table-condensed table-bordered" cellspacing="0" width="100%">	
						<thead>
							<tr>
								<th>Id</th>
								<th>Fecha y Hora</th>
								<th>Descripción</th>
								<th>Entrada (<?php echo $parametro->moneda;?>)</th>
								<th>Salida (<?php echo $parametro->moneda;?>)</th>
								<th>Saldo Actual (<?php echo $parametro->moneda;?>)</th>
							</tr>
						</thead>																						
					</table> 					
				</div>    
			</div>
		</div>		
	</div>
</div>
<!-- Contenido Principal -->
<!-- MODAL Ingresos y Egresos -->
<div class="modal fade" id="modal_flujos" tabindex="-1" role="dialog" aria-labelledby="titulo_modal_ingresos">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="cabecera_modal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulo_modal_flujos">New message</h4>
      </div>
      <div class="modal-body">
        <form>
		<div class="row">
          <div class="col-lg-4 form-group">
            <label for="importeFlujo" class="control-label">Importe:</label>
			<div class="input-group">
				<span class="input-group-addon"><?php echo $parametro->moneda;?></span>  
				<input id="importeFlujo" type="number" step="any" class="form-control" tabindex="1" required autofocus>
			</div>   
          </div>
		</div>	
          <div class="form-group">
            <label for="descripcionFlujo" class="control-label">Descripción:</label>
            <textarea id="descripcionFlujo" class="form-control" tabindex="2" required></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer clearfix">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal" tabindex="4"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
        <button id="btnEnviarFlujo" type="button" class="btn btn-danger pull-right" tabindex="3"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>	                    
<?php
    include("vistas/includes/menuInferior.php");
?>
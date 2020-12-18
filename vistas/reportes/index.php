<?php
include("vistas/includes/menuSupReportes.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header hstyle"><i class="fa fa-bar-chart fa-fw"></i> Reportes Gráficos</h2>
			 </div>   
		</div>  		
		<div class="row">
			<div class="col-lg-6">
				<div class="panel panel-lila">
				  <div class="panel-heading">
					<h3 class="panel-title"> Ventas</h3>
				  </div>
				  <div class="panel-body">
					<div class="list-group"> 
						<div class="row">
							<div class="col-lg-6">	
								 <div class="radio">
								  <label><input type="radio" id="opcion" name="opcion" value="1" checked>Diarias</label>
								 </div>
								 <div class="radio">
								  <label><input type="radio" id="opcion" name="opcion" value="2">Mensuales</label>
								</div>
							</div>	 	 
							<div class="col-lg-6">		
								<div class="radio">
								  <label><input type="radio" id="opcion" name="opcion" value="3">Por forma de Pago</label>
								</div>
							</div>		
						</div>    
					</div>  
					<label for="fechaInicioVtas">Fecha Inicial</label>
					<input type="date" id="fechaInicioVtas" name="fechaInicioVtas" class="form-control" required>
					<br>
					<label for="fechaFinVtas">Fecha Final</label>
					<input type="date" id="fechaFinVtas" name="fechaFinVtas" class="form-control" required>
				  </div>  
				<div class="panel-footer clearfix">
					<button id="btnGenerarReporteVentas" class="btn btn-lila pull-right">Ver Gráfico</button>      
				</div>
				</div>
			</div>    
			<div class="col-lg-6">
				<div class="panel panel-lila">
				  <div class="panel-heading">
					<h3 class="panel-title"> Compras</h3>
				  </div>
				  <div class="panel-body">
					<div class="list-group"> 
					<div class="row">
						<div class="col-lg-6">	
						 <div class="radio">
						  <label><input type="radio" id="opcionCompras" name="opcionCompras" value="1" checked>Diarias</label>
						</div>
						 <div class="radio">
						  <label><input type="radio" id="opcionCompras" name="opcionCompras" value="2">Mensuales</label>
						</div>
						</div>	
					</div>	
					</div> 	
					<label for="fechaInicioCompras">Fecha Inicial</label>
					<input type="date" id="fechaInicioCompras" name="fechaInicioCompras" class="form-control" required>
					<br>
					<label for="fechaFinCompras">Fecha Final</label>
					<input type="date" id="fechaFinCompras" name="fechaFinCompras" class="form-control" required>
					</div>  
				<div class="panel-footer clearfix">
					<button id="btnGenerarReporteCompras" class="btn btn-lila pull-right">Ver Gráfico</button>      
				</div>
				</div>
			</div>    
		</div>
		<div class="row">
			<div class="col-lg-6">
				  <div class="panel panel-lila">
				  <div class="panel-heading">
					<h3 class="panel-title"> Productos</h3>
				  </div>
				  <div class="panel-body">
					 
					<div class="list-group">
						<div class="input-group">	 	
						<select class="form-control" id="select1">
							<option value="3" selected>Con Mayor Stock (Top 10)</option>
							<option value="4">Más Caros (Top 10)</option>
							<option value="5">Más Vendidos (Top 10)</option>
						</select>
						<span class="input-group-btn">
							<button id="btnReporteProd" class="btn btn-lila pull-right" title="Ver Gráfico"><i class="fa fa-line-chart" aria-hidden="true"></i></button>      	
						</span>							
						</div>
					</div>
					  
					<div class="row">
					<div class="col-lg-12 form-group">
						<div class="input-group">	
						   <input type="text" class="form-control" id="codProd" value="" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Código del Producto" tabindex="" autofocus>
						   <span class="input-group-btn">
							<button id="btnBuscarCodTalles" class="btn btn-primary pull-right" title="Talles más vendidos"><span class="fa fa-search-plus" aria-hidden="true"></span> Talles</button>							
						  </span>	
							<span class="input-group-btn">
							<button id="btnBuscarCodColores" class="btn btn-lila pull-right" title="Colores más vendidos"><span class="fa fa-search-plus" aria-hidden="true"></span> Colores</button>   
							</span>	
						</div>	
					 </div> 
					</div>  					  
				  </div>
				  <div style="height:68px"></div> 
					  
				<div class="panel-footer clearfix">
<!--					<button id="btnReporteProd" class="btn btn-lila pull-right">Ver Gráfico</button>    -->
				</div>				
			</div>				
			</div>			
			<div class="col-lg-6">
				  <div class="panel panel-lila">
				  <div class="panel-heading">
					<h3 class="panel-title"> Ingresos y Egresos (Dinero efectivo)</h3>
				  </div>
				    <div class="panel-body">
						<div class="row">
							<div class="col-lg-6 form-group">
<!--							   <label for="mesReporte">Mes</label>-->
								<select name="mesReporte" id="mesReporte" class="form-control">
									<option value="0" selected disabled>-- Seleccione el Mes --</option>
									<option value="1">Enero</option>
									<option value="2">Febrero</option>
									<option value="3">Marzo</option>
									<option value="4">Abril</option>
									<option value="5">Mayo</option>
									<option value="6">Junio</option>
									<option value="7">Julio</option>
									<option value="8">Agosto</option>
									<option value="9">Septiembre</option>
									<option value="10">Octubre</option>
									<option value="11">Noviembre</option>
									<option value="12">Diciembre</option>
								</select>
							</div>
							<div class="col-lg-6 form-group">
<!--							   <label for="anioReporte">Año</label>    -->
								<div class="input-group">	
							   <input type="number" class="form-control" id="anioReporte" name="anioReporte" value="" placeholder="" tabindex="">
								<span class="input-group-btn">
								<button class="btn btn-lila pull-right" id="btnReporteIyE" data-toggle="tooltip" data-placement="left" title="Ver Gráfico"><i class="fa fa-line-chart" aria-hidden="true"></i></button>
							  </span>	
								</div>	
							</div>	
						</div>
						<label>Ingresos</label><label id="totIng"></label>
						<div id="myProgress">
						  <div id="myBar">
							<div id="label">0%</div>
						  </div>
						</div>
						<br>
						<label>Egresos</label><label id="totEgr"></label>
						<div id="myProgress2">
						  <div id="myBar2">
							<div id="label2">0%</div>
						  </div>
						</div>
				  </div> 
				<div class="panel-footer clearfix">
				</div>
			</div>
			</div>
		</div>                
	</div>
</div>
<!-- Contenido Principal -->
 <!--      Ventana Modal    -->
  <div class="modal fade" id="modalGraficos" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header modal-header-primary">
		  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  <h4 class="modal-title" id="tituloModal">Reportes Gráficos</h4>
		</div>      
		  <div class="modal-body">
			<div class="container-fluid">
				<div class="row">
				<div class="col-lg-12"> 
				<div style="width: 100%; padding-left: -5px;">    
				<div class="table-responsive">    
				<div id="container1" style="min-width: 510px; height: 500px; max-width: 600px; margin: 0 auto">
				</div>
					</div>
					</div>
					</div>
				</div>
			</div>
		  </div>  
	  </div>
	</div>
  </div>
<!--      Ventana Modal    -->	
<?php
    include("vistas/includes/menuInferior.php");
?>
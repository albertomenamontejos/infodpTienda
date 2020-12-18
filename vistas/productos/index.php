<?php
include("vistas/includes/menuSupDataTable.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">	
	<div class="container-fluid">			
		<div class="row">
			<div class="col-lg-12">                        
			<h3 class="hstyle">Productos</h3>
			<a href="<?php url("productos/crear") ?>" id="btnNuevoProd" class="btn btn-redTienda"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Nuevo</a>				
			<hr>
			</div>			 
		</div>
		<div class="row">
			<div class="col-lg-12"> 				
				<div class="table-responsive">  
					<table id="tablaProductos" class="table-condensed table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Id</th>
								<th>Código</th>
								<th>Nombre</th>
								<th>Precio Compra</th>
								<th>Precio Venta</th>								
								<th>Stock</th>
								<th>Marca</th>								
								<th>Acción</th>
							</tr>
						</thead>						
					</table>			
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Contenido Principal -->     
<script>
	//tabla PRODUCTOS
	//Control de stock con JQuery
   	$('#tablaProductos').DataTable({
		"lengthChange": true,
		"deferRender": true,		
		"bProcessing": true,		
        "bServerSide": true,
		"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
    	"pageLength": 10,
		dom: 'Bfrtilp',
        "sAjaxSource": "libreria/ServerSide/serversideControlStock.php",
		"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='btn-group'><button class='btn btn-primary btnEditar' data-toggle='tooltip' title='Editar'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button class='btn btn-danger btnEliminar' data-toggle='tooltip' title='Eliminar'><i class='fa fa-trash-o' aria-hidden='true'></i></button></div>"
        } ],		
		"bDestroy": true,				
		//configuro lenguaje en español
		"language": {
			"sProcessing":    "Procesando...",
			"sLengthMenu":    "Mostrar _MENU_ registros",
			"sZeroRecords":   "No se encontraron resultados",
			"sEmptyTable":    "Ningún dato disponible en esta tabla",
			"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":   "",
			"sSearch":        "Buscar:",
			"sUrl":           "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":    "Último",
				"sNext":    "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		},
		//extension para BUTTONS		
		buttons:[
			{
				extend:    'excelHtml5',
				text:      '<i class="fa fa-file-excel-o fa-lg"></i> ',
				titleAttr: 'Exportar a Excel',
				className: 'btn btn-default'
			},
			{
				extend:    'pdfHtml5',
				text:      '<i class="fa fa-file-pdf-o fa-lg"></i> ',
				titleAttr: 'Exportar a PDF',
				className: 'btn btn-default'
			},
			{
				extend:    'print',
				text:      '<i class="fa fa-print fa-lg"></i> ',
				titleAttr: 'Imprimir',
				className: 'btn btn-default'
			},
		]	
    });		
	$(document).on("click", ".btnEditar", function(){		
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ; //capturo la cantidad
		window.location.href="productos/editar?id="+id;	
	 });
	$(document).on("click", ".btnEliminar", function(){		
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ; //capturo la cantidad		
		alertify.confirm('Eliminar Registro','¿Está seguro de eliminar el registro?',
		function(){window.location.href=window.location.href="productos/eliminar?id="+id;},
		function(){alertify.error('Cancelado')});
	 });
</script>
<?php	
    include("vistas/includes/menuInferior.php"); 	
    if ($_SESSION["temp_elimina"] == "false") {
        echo "<script>     
                    alertify.error('No se pudo eliminar!').delay(2);
              </script>";
        $_SESSION["temp_elimina"] = "true";
    }
?>
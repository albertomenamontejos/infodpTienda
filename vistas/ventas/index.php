<?php
use \App\modelo\Cliente;
use \App\modelo\Detallepagoventa;
use \App\modelo\Formapago;
use \App\modelo\Parametro;
$parametro = Parametro::find(1); //para que me traiga los param de la moneda
include("vistas/includes/menuSupDataTable.php");
?>
<!-- Contenido Principal -->
<div id="page-wrapper">
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-lg-12">                        
                <h3 class="hstyle">Gestión de VENTAS</h3>					
                <a href="<?php url("ventas/crear") ?>" id="btnNuevaVenta" class="btn btn-redTienda"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> VENTA</a>
			</div>
		</div>
        <hr>
		<div class="row">
        	<div class="col-lg-12">  
                <div class="table-responsive">        
                <table id="vistaVentas" class="table-striped table-bordered table-condensed" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <!-- Datos de la tabla VENTAS -->
							<th>Id</th>
                            <th>Nro. de Venta</th>
                            <th>Fecha de la Venta</th>
                            <th>Cliente</th>
							<th>Forma de Pago</th>
							<th>Total (<?php echo $parametro->moneda;?>)</th>
                            <th>Estado</th>                            
							<th class="text-center">Acción</th>
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
	//tabla VENTAS	
   	$('#vistaVentas').DataTable({	
		"lengthChange": true,
		"deferRender": true,		
		"bProcessing": true,		
        "bServerSide": true,
		"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
		"pageLength": 10,
		dom: 'Bfrtilp',
        "sAjaxSource": "../libreria/ServerSide/serversideVentas.php",		
		"columnDefs": [ {
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='wrapper text-center'><div class='btn-group'><button class='btn btn-info btnDetalle' data-toggle='tooltip' title='Ver detalle'><i class='fa fa-file-text' aria-hidden='true'></i></button><button class='btn btn-danger btnDevolucion' data-toggle='tooltip' title='Realizar Devolución'><i class='fa fa-reply-all' aria-hidden='true'></i></button></div></div>"
        } ],
		"bDestroy": true,
		"createdRow": function ( row, data, index ) { 		
		switch (data[6]){
		   case "Emitida":
		   	$('td', row).eq(6).css({ //para pintar una sola celda			
				'background-color':'#00E676',
				'color':'black',	
				'text-align':'center',				
			});
			break;	
		   case "Dev_Parcial":
				$('td', row).eq(6).css({ //para pintar una sola celda			
				'background-color':'#009688',
				'color':'white',						
				'text-align':'center',
				});
			break;	
		   case "Anulada": 	
				$('td', row).eq(6).css({ //para pintar una sola celda			
				'background-color':'#F44336',
				'color':'white',		
				'text-align':'center',	
				});
			break;	
		}				
        },				
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
	$(document).on("click", ".btnDetalle", function(){		
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ; //capturo la cantidad
		window.location.href="../ventas/detalle?id="+id;	
	 });
	$(document).on("click", ".btnDevolucion", function(){		
		var id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ; //capturo la cantidad				
		window.location.href=window.location.href="../ventas/devolucion?id="+id;		
	 });
</script>
<?php
    include("vistas/includes/menuInferior.php");
?> 
$(document).ready(function(){		
/* CODIGO DATATABLES JS -- inicio*/	
	//-- Código para traducir datatable a español --//     
    var table = $('.tabla').DataTable({		
						"lengthChange": true,
						"deferRender": true,
		 				"bProcessing": true,    	
						"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
						"pageLength": 10,
						dom: 'Bfrtilp',
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
						//botones con estilo dropdown	
						/*buttons: [
							{
								extend: 'collection',
								text: 'Enviar a...',
								className: 'btn btn-primary',
								buttons: [
									{
										text:'<i class="fa fa-file-excel-o fa-lg"></i> Exportar a Excel',
									},
									{
										text:'<i class="fa fa-file-pdf-o fa-lg"></i> Guardar como PDF',
									},
									{
										text:'<i class="fa fa-print fa-lg"></i> Imprimir',
									}
								]
							}
						]*/						
						//botones position horizontal agrupados	
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
						],				
		
						//codigo para scroller
						/*deferRender:    true,
						scrollY:        400,
						scrollCollapse: true,
						scroller:       true,	*/
                    });			
});
/* CODIGO DATATABLES JS -- fin*/
	
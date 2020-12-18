$(document).ready(function() {
/*CODIGO FLUJO DE CAJAS*/	
	var tipoFlujo = 0;
	//Para abrir la ventana modal Ingresos y Egresos
	$("#btnEgreso").click(function(){
		$("#cabecera_modal").css( "background-color", "#d9534f");
		$("#cabecera_modal").css( "color", "white" );
		$('#titulo_modal_flujos').text("Egreso de Dinero");
		$("#importeFlujo").val("").focus();
		$("#descripcionFlujo").val("");
        $('#modal_flujos').modal('show');
		tipoFlujo = 0;
	});	
	//Para abrir la ventana modal Ingresos y Egresos
	$("#btnIngreso").click(function(){
		$("#cabecera_modal").css( "background-color", "#5cb85c");
		$("#cabecera_modal").css( "color", "white" );
		$('#titulo_modal_flujos').text("Ingreso de Dinero");
		$("#importeFlujo").val("").focus();
		$("#descripcionFlujo").val("");
        $('#modal_flujos').modal('show');	
		tipoFlujo = 1;
	});
   
	var importeFlujo = 0;
	var descripcionFlujo;
	var fecha;
	var descripcion;
	var entrada;
	var salida;
	var saldoActual;
	//var t = $('#tablaFlujos').DataTable(); //creo una varible para usar el row.add()
	
	//var t = $('.tabla').DataTable({										
	var t = $('#tablaFlujos').DataTable({										
						"bDestroy": true,						
						"lengthChange": true,
						"deferRender": true,
		 				"bProcessing": true,
    					"bDeferRender": true,				
						//nuevo serverside
						"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
						"pageLength": 10,
						dom: 'Bfrtilp', //para ver opciones de 10, 20 o mas paginas hay que añadir letra "l"
						"sAjaxSource": "libreria/ServerSide/serversideFlujoCajas.php",		
						//para controlar que no muestre nada en las celdas con valores igual a cero
						"createdRow": function ( row, data, index ) { 
							//columna de ingresos
							if ( data[3] == "0.00" || data[3] == "0") {
								$('td', row).eq(3).css({ //para pintar una sola celda									
									'color':'transparent',
								});							
							}
							//columna de egresos	
							if ( data[4] == "0.00" || data[4] == "0") {
								$('td', row).eq(4).css({ //para pintar una sola celda									
									'color':'transparent',
								});							
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
	//BTN busca enviar flujo de cajas con ajax
	$("#btnEnviarFlujo").click(function(){
		if (parseFloat($("#importeFlujo").val()).toFixed(2) < 0)
		{	
			alertify.warning("Debe ingresar valores positivos");
			$("#importeFlujo").focus();
		}
		else
		{
			if ($("#descripcionFlujo").val() == ""){
				alertify.warning("Ingrese una descripción");
				//$("#importeFlujo").focus();
			}
			else{
				importeFlujo = parseFloat($("#importeFlujo").val()).toFixed(2);		
				descripcionFlujo = $("#descripcionFlujo").val();		
				 $.ajax({
				  url: "libreria/ORM/flujoDeCajas.php",
				  type: "POST",
				  datatype:"json",    
				  data:  {tipoFlujo:tipoFlujo ,importeFlujo:importeFlujo, descripcionFlujo: descripcionFlujo},    
				  success: function(data) {
						//recibo el json desde PHP y lo parseo	
						//console.log(data);
						var datos = JSON.parse(data); 
						id = datos[0].id;
						fecha = datos[0].fecha;
						descripcion = datos[0].descripcion;	
						entrada = datos[0].entrada;	
						salida = datos[0].salida;	
						saldoActual = datos[0].saldoActual;	

						t.row.add( [
							id,
							fecha,
							descripcion,
							entrada.toFixed(2),
							salida.toFixed(2),
							saldoActual.toFixed(2)
						] ).draw();
				   }
				});
			$('#modal_flujos').modal('hide');
			}
		}
	});
	
	
}); 
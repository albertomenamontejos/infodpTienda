//definimos como variable Global
var chart1, chart2, chart3, chart4, chart5;
var options; 
//variables de ventas
var fechaInicioVtas; 
var fechaFinVtas;
var opcionV; 
//variables de productos
var opcionP; 
//variables de compras
var fechaInicioCompras; 
var fechaFinCompras;
var opcionCompras;   
//variables de reportes varios
var porc_Ing;
var porc_Egr;
var porc_Tot;	
//variables nuevas para talles y colores
var codProd;
$(document).ready(function() {       
	/*CODIGO REPORTES VENTAS JS*/
   $("#btnGenerarReporteVentas").click(function(){             
		fechaInicioVtas = $("#fechaInicioVtas").val();
		fechaFinVtas = $("#fechaFinVtas").val();            
		if(fechaInicioVtas.length > 0 && fechaFinVtas.length > 0){
			//capturo la opcion
			opcionV = parseInt($("input:radio[name ='opcion']:checked").val());    
			$.ajax({
			  url: "libreria/ORM/reportes_ventas.php",
			  type: "POST",
			  datatype:"json",    
			  data:  {fechaInicioVtas:fechaInicioVtas, fechaFinVtas:fechaFinVtas, opcionV:opcionV },    
			  success: function(data) {
						//recibo el json desde PHP y lo paso a string
						options.series[0].data = data;
						var chart1 = new Highcharts.Chart(options);	
						//console.log(data);
				}
			});
			switch(opcionV) {
				 case 1:
					opcion1();
					break;
				 case 2:
				   opcion2();
				   break;
				case 3:
				   opcion3();
				   break;	
			}                 
		}else{
			alertify.warning("Ingrese el rango de fechas.");
			$("#fechaInicioVtas").focus();
		}             
   });              
	// opcion 1 - Ventas Diarias
	function opcion1(){
		var theModal = $("#modalGraficos").modal({
							show: false
							});   
		options = {
			chart: {
				renderTo: 'container1',
				type: "area"
			},
			title: {
				text: "Ventas Diarias"
			},
			subtitle: {
				text: "Volumen de ventas."
			},
			 xAxis: { 
				 type: "category"
			},
			yAxis: {
				title: {
					text: "Ventas en Dinero"
				},

			},
			dataLabels: {
				enabled: true,
				format: "{point.y:,.2f}"
			},

			tooltip: {
				//pointFormat: "{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}"
				pointFormat: "Total Ventas: <b>${point.y:,.2f}</b><br/>"
			},
			plotOptions: {
				area: {
					marker: {
						enabled: false,
						symbol: "circle",
						radius: 2,
						states: {
							hover: {
								enabled: true
							}
						}
					}
				}
			},
			series: [{
			data: [

				],
			}]

		};
		theModal.on("shown",function(){           
		});
		theModal.modal("show");
	}    
    //opcion 2 - Ventas Mensuales
    function opcion2(){ 
    var theModal = $("#modalGraficos").modal({
                            show: false
                            });       
    //defino "options" para usar como param del objeto chart1
    options = {    
                chart: {
                    renderTo: 'container1', // es lo mismo que $("#container1").highcharts()
                    type: "column"               
                },
                title: {
                    text: "Ventas Mensuales"
                },
                subtitle: {
                    text: "Período consultado, desde: <strong>"+fechaInicioVtas+"</strong> hasta: <strong>"+fechaFinVtas+"</strong>"
                },
                xAxis: {
                    type: "category",
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: "13px",
                            fontFamily: "Verdana, sans-serif"
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: "Ventas en Dinero"
                    }
                },
                //establecemos los colores de las columnas por Mes
                colors: [
                    "#4572A7", 
                    "#80699B",
                    "#ff8e31", 
                    "#89A54E", 
                    "#3D96AE", 
                    "#92A8CD", 
                    "#A47D7C", 
                    "rgba(142, 162, 110, 0.81)"
                    ],
                    plotOptions: {
                        column: {
                            colorByPoint: true
                        }
                    },
                legend: {
                    enabled: false
                },
                tooltip: {
                    pointFormat: "Total del Mes: <b> ${point.y:.2f}</b>"     
					
                },
                series: [{
                    name: "Ventas por mes",
                    dataLabels: {
                        enabled: true,
                        //rotation: -90,
                        rotation: 0,
                        color: "#ffffff",
                        align: "center",
                        format: "{point.y:,.2f}", 
                        y: 30, // 10 pixels down from the top
                        style: {
                            fontSize: "13px",
                            fontFamily: "Verdana, sans-serif"
                        }
                    },
                    data:[
                    ],
                }]
    }; //fin options       
        theModal.on("shown",function(){
           // Recreate the chart now and it will be correct
        }); 
        theModal.modal("show");   
    }    
	//opcion 3 - Ventas por formas de pago
	function opcion3() {
        var theModal = $("#modalGraficos").modal({
                            show: false
                            });   
        options = {
                    chart: {
                        renderTo: 'container1',
						type: 'column',
							options3d: {
								enabled: true,
								alpha: 10,
								beta: 25,
								depth: 70
							}
						},
						title: {
							text: 'Ventas por Formas de Pago'
						},
						 
						tooltip: {
							pointFormat: "Total: <b>${point.y:.2f}</b>"
						},
						plotOptions: {
							column: {
								depth: 30
							}
						},
						xAxis: {
							type:'category'
						},
						yAxis: {
							title: {
								text: null
							}
						},
						series: [{
							name:'Ventas',
							data:[]
						}]
                };
        theModal.on("shown",function(){
           // Recreate the chart now and it will be correct
        });
        theModal.modal("show");
    }	
    $("#modalGraficos").draggable({ handle: ".modal-header" });

	/* CODIGO REPORTES PRODUCTOS JS*/
	$("#btnReporteProd").click(function(){ 
		//capturo la opcion
		opcionP = parseInt($("#select1 option:selected").val());                    
		$.ajax({
		  url: "libreria/ORM/reportes_productos.php",
		  type: "POST",
		  datatype:"json",    
		  data:  {opcionP:opcionP},    
		  success: function(data) {
					  //recibo el json desde PHP y lo paso a string
					  options.series[0].data = data;
					  var chart2 = new Highcharts.Chart(options);
					  //console.log(data);
		   }
		});
		switch(opcionP) {
			 case 3:
				opcion4();
				break;
			 case 4:
			   opcion5();
			   break;
			case 5:
			   opcion6();
			   break;    
		}   
	});   
	/// opcion 4 - Productos con mayor stock
	function opcion4() {
		var theModal = $("#modalGraficos").modal({
							show: false
							});   
		options = {
					chart: {
						renderTo: 'container1',
						width: 500,
						height: 500,
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
						type: "pie",
					},
					title: {
						text: "Productos con mayor Stock"                        
					},
					subtitle: {
					text: "Productos"
					},
					tooltip: {
						//pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>"
					pointFormat: "{series.name}: <b>{point.y:.0f}</b>" //muestra el stock sin decimales (.0f)
					},
					plotOptions: {
						pie: {	
							allowPointSelect: true,
							cursor: "pointer",
							dataLabels: {
								enabled: false
							},
							showInLegend: true
						}
					},
					series: [{
						name: "Stock",
						colorByPoint: true,
						data: [

						],
					}]
				};
		theModal.on("shown",function(){           
		});
		theModal.modal("show");
	}
	/// opcion 5 - Productos más caros    
	function opcion5(){
		var theModal = $("#modalGraficos").modal({
							show: false
							});   
		options = {
			chart: {
				renderTo: 'container1',
				type: "column"
			},
			title: {
				text: "Productos más caros"
			},
			subtitle: {
				text: "Origen de datos, tabla: productos"
			},
			xAxis: {
				type: "category"
			},
			yAxis: {
				title: {
					text: "Precios"
				}
			},
			legend: {
				enabled: false
			},
			plotOptions: {
				series: {
					borderWidth: 0,
					dataLabels: {
						enabled: true,
						format: "{point.y:.2f}"
					}
				}
			},
			tooltip: {
				headerFormat: "<span style='font-size:11px'>{series.name}</span><br>",
				pointFormat: "<span style='color:{point.color}'>{point.name}</span>: <b> ${point.y:.2f}</b><br/>"
			},
			series: [{
				name: "Marca/Modelo",
				colorByPoint: true,
				data: [
				],
			}]
		};
		theModal.on("shown",function(){
		   // Recreate the chart now and it will be correct
		});
		theModal.modal("show");
	}
	/// opcion 6 - Productos más vendidos    
	function opcion6(){ 
		var theModal = $("#modalGraficos").modal({
							show: false
							});   
		options = {
		chart: {
			renderTo: 'container1',
			type: "bar"
		},
		title: {
			text: "Productos más Vendidos"
		},
		subtitle: {
			text: "Productos que más se vendieron"
		},
		xAxis: {
			type: "category",
			title: {
				text: "Productos"
			}
		},
		yAxis: {
			title: {
				text: "Cantidad"
			},
			labels: {
				overflow: "justify"
			}
		},
		tooltip: {

		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: "vertical",
			align: "right",
			verticalAlign: "bottom",
			x: -40,
			y: 80,
			floating: true,
			borderWidth: 1,
			backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || "#FFFFFF"),
			shadow: true
		},
		credits: {
			enabled: false
		},
		   series: [{
				name: "Cantidad",
				colorByPoint: true,
				data: [
				],
			}]
	};    
		theModal.on("shown",function(){
		   // Recreate the chart now and it will be correct
		}); 
		theModal.modal("show");
	}             
	$("#modalGraficos").draggable({ handle: ".modal-header" });

	/* CODIGO REPORTES COMPRAS JS */
	$("#btnGenerarReporteCompras").click(function(){            
		fechaInicioCompras = $("#fechaInicioCompras").val();
		fechaFinCompras = $("#fechaFinCompras").val();            
		if(fechaInicioCompras.length > 0 && fechaFinCompras.length > 0){
			//capturo la opcion
			opcionCompras = parseInt($("input:radio[name ='opcionCompras']:checked").val());    
			$.ajax({
			  url: "libreria/ORM/reportes_compras.php",
			  type: "POST",
			  datatype:"json",    
			  data:  {fechaInicioCompras:fechaInicioCompras, fechaFinCompras:fechaFinCompras, opcionCompras:opcionCompras }, success: function(data) {
				  //recibo el json desde PHP y lo paso a string
				  options.series[0].data = data;
				  var chart3 = new Highcharts.Chart(options);
				  //console.log(data);
			  }
			});
			switch(opcionCompras){
				 case 1:
					opcion7();
					break;
				 case 2:
				   opcion8();
				   break;
			}                 
		}else{
			alertify.warning("Ingrese el rango de fechas.");
			$("#fechaInicioCompras").focus();
		}             
	});          

	// opcion 7 - Compras Diarias
	function opcion7(){
	var theModal = $("#modalGraficos").modal({
						show: false
						});   
	options = {
		chart: {
			renderTo: 'container1',
			type: "area"
		},
		title: {
			text: "Compras Diarias"
		},
		subtitle: {
			text: "Volumen de Compras."
		},
		 xAxis: { 
			 type: "category"
		},
		yAxis: {
			title: {
				text: "Compras en Dinero"
			},

		},
		dataLabels: {
			enabled: true,
			format: "{point.y:,.2f}"
		},
		tooltip: {
			//pointFormat: "{series.name} produced <b>{point.y:,.0f}</b><br/>warheads in {point.x}"
			pointFormat: "Total: <b>${point.y:,.2f}</b><br/>"
		},
		plotOptions: {
			area: {
				marker: {
					enabled: false,
					symbol: "circle",
					radius: 2,
					states: {
						hover: {
							enabled: true
						}
					}
				}
			}
		},
		series: [{
		data: [

			],
		}]

	};
	theModal.on("shown",function(){
	   // Recreate the chart now and it will be correct
	});
	theModal.modal("show");
}   

	// opcion 8 - Compras Mensuales
	function opcion8(){     
	var theModal = $("#modalGraficos").modal({
							show: false
							});   

	//defino "options" para usar como param del objeto chart3
	options = {    
				chart: {
					renderTo: 'container1', // es lo mismo que $("#container1").highcharts()
					type: "column"               
				},
				title: {
					text: "Compras Mensuales"
				},
				subtitle: {
					text: "Período consultado, desde: <strong>"+fechaInicioCompras+"</strong> hasta: <strong>"+fechaFinCompras+"</strong>"
				},
				xAxis: {
					type: "category",
					labels: {
						rotation: -45,
						style: {
							fontSize: "13px",
							fontFamily: "Verdana, sans-serif"
						}
					}
				},
				yAxis: {
					min: 0,
					title: {
						text: "Dinero"
					}
				},
				//establecemos los colores de las columnas por Mes
				colors: [
					"#4572A7", 
					"#80699B",
					"#ff8e31", 
					"#89A54E", 
					"#3D96AE", 
					"#92A8CD", 
					"#A47D7C", 
					"rgba(142, 162, 110, 0.81)"
					],
					plotOptions: {
						column: {
							colorByPoint: true
						}
					},
				legend: {
					enabled: false
				},
				tooltip: {
					pointFormat: "Total del Mes: <b> ${point.y:.2f}</b>"     
				},
				series: [{
					name: "Compras por mes",
					dataLabels: {
						enabled: true,
						//rotation: -90,
						rotation: 0,
						color: "#ffffff",
						align: "center",
						format: "{point.y:,.2f}", 
						y: 30, // 10 pixels down from the top
						style: {
							fontSize: "13px",
							fontFamily: "Verdana, sans-serif"
						}
					},
					data:[
					],
				}]
	}; //fin options       
	theModal.on("shown",function(){
	// Recreate the chart now and it will be correct
	}); 
	theModal.modal("show");   
	}    
	$("#modalGraficos").draggable({ handle: ".modal-header" });

	/* CODIGO REPORTES VARIOS JS*/
	$("#btnReporteIyE").click(function(){ 
			var mes;
			var anio;
			var ingresos = 0;
			var egresos = 0;		
			mes = $("#mesReporte").val();
			anio = $("#anioReporte").val();        	
			$.ajax({
				  url: "libreria/ORM/reportes_varios.php",
				  type: "POST",
				  datatype:"json",    
				  data:  {mes: mes, anio:anio},     
				  success: function(data) {
							var datos = JSON.parse(data);            		  					  		
							if(datos[0][0] == null || datos[0][1] == null){
								ingresos = 0;
								egresos = 0;
								porc_Ing = 0;
								porc_Egr = 0;
							}else{
								ingresos = parseFloat(datos[0][0]).toFixed(2);
								egresos = parseFloat(datos[0][1]).toFixed(2);	
								total = parseFloat(ingresos) + parseFloat(egresos);
								porc_Ing = Math.round(ingresos/total * 100);
								porc_Egr = Math.round(egresos/total * 100);
								porc_Tot = Math.round(total/total * 100);
								//console.log(porc_Ing, porc_Egr, porc_Tot);
							}	
							$("#totIng").text(": $ "+ingresos);
							$("#totEgr").text(": $ "+egresos);
							move1();
							move2();
					}
				});		
	});	
	function move1() {
	  var elem = document.getElementById("myBar");
	  var width = 0;
	  var id = setInterval(frame, 10); //velocidad que crece la barra
		function frame() {
			if (width >= porc_Ing) {
			  clearInterval(id);			  
			  elem.style.width = width + '%';
			  document.getElementById("label").innerHTML = width * 1  + '%';					
			} else {
			  width++;
			  elem.style.width = width + '%';
			  document.getElementById("label").innerHTML = width * 1  + '%';
			}
		  }
	}	
	function move2() {
	  var elem = document.getElementById("myBar2");
	  var width = 0;
	  var id = setInterval(frame, 10);
		  function frame() {
			if (width >= porc_Egr) {
			  clearInterval(id);				
			  elem.style.width = width + '%';
			  document.getElementById("label").innerHTML = width * 1  + '%';		
			} else {
			  width++;
			  elem.style.width = width + '%';
			  document.getElementById("label2").innerHTML = width * 1  + '%';
			}
		  }
	}	
	//toma el año actual
	$("#anioReporte").val((new Date).getFullYear());	

	/* CODIGO REPORTES PRODUCTOS NUEVOS JS*/	
	$("#btnBuscarCodTalles").click(function(){		
		codProd = $.trim($("#codProd").val()); 
		opcionTC = 1;
		if (codProd != ""){
			$.ajax({
			  url: "libreria/ORM/reportes_productos_nuevos.php",
			  type: "POST",
			  datatype:"json",    
			  data: {codProd:codProd, opcionTC:opcionTC},    
			  success: function(data) {
						  //recibo el json desde PHP y lo paso a string						
				  		options.series[0].data = data;
						var chart4 = new Highcharts.Chart(options);	
						 //console.log(data);
			   }
			});	
			opcion9();		
			function opcion9(){ 
		var theModal = $("#modalGraficos").modal({
							show: false
							});   
		options = {
		
		colors: ['#f45b5b', '#8085e9', '#8d4654', '#7798BF', '#aaeeee',
        '#ff0066', '#eeaaee', '#55BF3B', '#DF5353', '#7798BF', '#aaeeee'],	
			
		chart: {
			renderTo: 'container1',
			type: "bar"
		},
		title: {
			text: "Talles más Vendidos"
		},
		subtitle: {
			text: "Talles que más se vendieron"
		},
		xAxis: {
			type: "category",
			title: {
				text: "Talles"
			}
		},
		yAxis: {
			title: {
				text: "Cantidad"
			},
			labels: {
				overflow: "justify"
			}
		},
		tooltip: {

		},
		plotOptions: {
			bar: {
				dataLabels: {
					enabled: true
				}
			}
		},
		legend: {
			layout: "vertical",
			align: "right",
			verticalAlign: "bottom",
			x: -40,
			y: 80,
			floating: true,
			borderWidth: 1,			
			shadow: true
		},
		credits: {
			enabled: false
		},
		   series: [{
				name: "Cantidad",
				colorByPoint: true,
				data: [
				],
			}]
	};    
		theModal.on("shown",function(){
		   // Recreate the chart now and it will be correct
		}); 
		theModal.modal("show");
	}             		
		}else{
			alertify.warning("Ingrese un COD válido.");
			$("#codProd").focus();
		}		
	});  
	
	$("#btnBuscarCodColores").click(function(){		
		codProd = $.trim($("#codProd").val()); 
		opcionTC = 2;
		if (codProd != ""){
			$.ajax({
			  url: "libreria/ORM/reportes_productos_nuevos.php",
			  type: "POST",
			  datatype:"json",    
			  data: {codProd:codProd, opcionTC:opcionTC},    
			  success: function(data) {
						  //recibo el json desde PHP y lo paso a string						
				  		options.series[0].data = data;
						var chart5 = new Highcharts.Chart(options);	
						 //console.log(data);
			   }
			});	
			opcion10();		
			function opcion10(){ 
				var theModal = $("#modalGraficos").modal({
									show: false
									});   
				options = {

				colors: ['#2962FF', '#448AFF', '#1565C0', '#1E88E5', '#64B5F6', '#BBDEFB', '#0097A7', '#006064'],	

				chart: {
					renderTo: 'container1',
					type: "bar"
				},
				title: {
					text: "Colores más Vendidos"
				},
				subtitle: {
					text: "Colores que más se vendieron"
				},
				xAxis: {
					type: "category",
					title: {
						text: "Colores"
					}
				},
				yAxis: {
					title: {
						text: "Cantidad"
					},
					labels: {
						overflow: "justify"
					}
				},
				tooltip: {

				},
				plotOptions: {
					bar: {
						dataLabels: {
							enabled: true
						}
					}
				},
				legend: {
					layout: "vertical",
					align: "right",
					verticalAlign: "bottom",
					x: -40,
					y: 80,
					floating: true,
					borderWidth: 1,			
					shadow: true
				},
				credits: {
					enabled: false
				},
				   series: [{
						name: "Cantidad",
						colorByPoint: true,
						data: [
						],
					}]
			};    
				theModal.on("shown",function(){
				   // Recreate the chart now and it will be correct
				}); 
				theModal.modal("show");
	}             		
		}else{
			alertify.warning("Ingrese un COD válido.");
			$("#codProd").focus();
		}		
	});
	
	
	
	
});  

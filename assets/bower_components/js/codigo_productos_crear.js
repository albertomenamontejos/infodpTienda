var checkTalle = false;
var checkColor = false;
var modi = 0;// si es 0 no cargamos datos, si es 1 cargamos datos en la tabla
var tablaTC = false; //para saber si cargo los talles/colores
var cantTotal = 0;			
var cantidades = [];
var myObj = {};		
$("#txtControlTalles").val("M"); //por defecto vale M (Multiples)
$("#txtControlColores").val("M"); //por defecto vale M (Multiples)
idGenero = $('select#txtGenero').val();				
idRubro = $('select#txtRubro').val();
idCategoria = $('select#txtCategoria').val();				
idEstilo = $('select#txtEstilo').val();
idMarca = $('select#txtMarca').val();	
$('#txtIdGenero').val(idGenero);	
$('#txtIdRubro').val(idRubro);
$('#txtIdCategoria').val(idCategoria);
$('#txtIdEstilo').val(idEstilo);
$('#txtIdMarca').val(idMarca);	

$('select#txtGenero').on('change',function(){			
	idGenero = $(this).val();					
	$('#txtIdGenero').val(idGenero);
	modi = 0;
});
$('select#txtRubro').on('change',function(){			
	idRubro = $(this).val();						 
	$('#txtIdRubro').val(idRubro);			
	modi = 0;
});    	
$('select#txtCategoria').on('change',function(){			
	 idCategoria = $(this).val();			
   $('#txtIdCategoria').val(idCategoria);
	modi = 0;
});		

//para controlar talles únicos
$("#chkTU").on( 'change', function() {
	if( $(this).is(':checked') ) {			
		$('#txtStock').val(0);	
		$("#txtControlTalles").val("U"); //Unico		
		checkTalle = true; //si es true el talle es U	
		modi = 0;	
		tablaTC = false;
	} else {			
		$('#txtStock').val(0);
		$("#txtControlTalles").val("M");//Multiple
		checkTalle = false;	//si es false el talle es Multiple			
		modi = 0;		
		tablaTC = false;
	}
});	


//para controlar colores únicos
$("#chkCU").on( 'change', function() {
	if( $(this).is(':checked') ) {			
		$('#txtStock').val(0);	
		$("#txtControlColores").val("U"); //Unico
		checkColor = true; //si es true el color es U		
		modi = 0;	
		tablaTC = false;
	} else {			
		$('#txtStock').val(0);
		$("#txtControlColores").val("M"); //Multiple
		checkColor = false;	//si es false el color es Multiple					
		modi = 0;		
		tablaTC = false;
	}
});	


//para tabla de talles/colores
$("#btnActualizarStock").click(function(){	
	if(modi == 1){ //si tuvo cambios en cantidades, hay que mostrar		
		$("#tablaTalleColor tr td").not(':first-child').each( function(){	  
			if($.isNumeric($(this).html())){
				cantidades.push(parseInt($(this).html()));						
				cantTotal = cantTotal + parseInt($(this).html());						
			}else{
				if($(this).html() === ""){
					cantidades.push(parseInt(0));				
				}
			}	   
		});	
		$('#modal_alta_existencias').modal('show');					
	}else{ //hay cambios en los select, se inicializan todos los valores		
		$("#tablaTalleColor td").parent().remove();	//limpio la tabla antes de traer los datos				
		cantTotal = 0; //inicializo el stock total
		$("#txtStock").val(cantTotal);		
		$.ajax({			  
			  url: "../libreria/ORM/consulta_talles.php",
			  type: "POST",
			  datatype:"json",    
			  data: {idRubro:idRubro, idGenero:idGenero, idCategoria:idCategoria, checkTalle:checkTalle},    
			  success: function(data) {									  			  
				var datos = JSON.parse(data); 				 
				var talles=[];
				var colores=[];  
				for (var i = 0; i < datos.length; i++) {											
					talles.push(datos[i].descripcion);					
				}					
				if(talles.length != 0){	
					$("#tablaTalleColor th:not(:first-child)").remove();				
					$.ajax({			  
						  url: "../libreria/ORM/consulta_colores.php",
						  type: "POST",
						  datatype:"json",  						  
						  data: {idRubro:idRubro, idGenero:idGenero, idCategoria:idCategoria, checkColor:checkColor},
						  success: function(data) {									  			  
							var datos = JSON.parse(data); 
							colores=[];
							for (var i = 0; i < datos.length; i++) {											
								colores.push(datos[i].descripcion);					
							}							
							for(var j=0; j<colores.length;j++){  
							$('#tablaTalleColor thead th:last-child').after('<th class="text-center">'+colores[j]+'</th>');	
							}
							var cantCol = $("#tablaTalleColor th:not(:first-child)").length; //cant de colores 			  
							$("#tablaTalleColor tbody tr").each(function(e){
								for(var j=0; j< cantCol;j++){
									$(this).append('<td class="text-center" onkeypress="return testEnteros(event);" contenteditable="true"></td>');					
								}  						
							});														  

						  }
					});					
					for(var i=0; i<talles.length;i++){				
					$('#tablaTalleColor > tbody:last-child').append('<tr><td class="text-center" style="background-color:#337ab7; color:white; width:20%">'+talles[i]+'</td></tr>');					 
					}					
					
				}
				else{
					alertify.warning("Revise las opciones seleccionadas.");			
				}  
			  }
		});		
		$('#modal_alta_existencias').modal('show');	
	}	
}); 
	
//para guardar talles y colores
//var myObj = {};		
$("#btnSaveTalleColor").click(function(){
	tablaTC = true;
	var talles = [];
	var colores = [];	
	cantidades = [];	
	cantTotal = 0;
	var arrayTalleColor = [];
	$("#tablaTalleColor tr").not(':first').each(function(){	
		talles.push($(this).find("td:first").text());
	});		
	$("#tablaTalleColor th:not(:first-child)").each(function(){	
		colores.push($(this).text());
	});		
	$("#tablaTalleColor tr td").not(':first-child').each( function(){	  
		if($.isNumeric($(this).html())){
			cantidades.push(parseInt($(this).html()));						
			cantTotal = cantTotal + parseInt($(this).html());						
		}else{
			if($(this).html() === ""){
				cantidades.push(parseInt(0));				
			}
		}	   
	});				
	var j=0;	
	for(x=0; x<talles.length;x++){			
		for (var y=0; y<colores.length; y++) {											
			arrayTalleColor.push([talles[x],colores[y],cantidades[j]]);		
			j++;
		}		
	}
	/*console.log(arrayTalleColor);
	console.log(talles);
	console.log("Cant de talles: "+talles.length);	
	console.log(colores);
	console.log("Cant de colores: "+colores.length);	
	console.log("Cantidades: "+cantidades);	*/	
	myObj = arrayTalleColor;	
	$("#txtStock").val(cantTotal);
	//envio el array a editar o crear
	$('#txtArrayCantidades').val(JSON.stringify(myObj));		
	alertify.success("¡Actualizado!");			
	modi = 1; //vale 1 para saber que hay datos en la tabla	
	$('#modal_alta_existencias').modal('hide');
});		
	
//funcion que solo permite numeros enteros				
function testEnteros(event) {
  if ((event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 13) {
    return true;
  } else {
    return false;
  }
}			
//control previo al envio del submit
$('form').submit(function(){    	
	var var_genero = $.trim($('#txtGenero').val());		
	var var_rubro = $.trim($('#txtRubro').val());
	var var_categoria = $.trim($('#txtCategoria').val());		
	var var_estilo = $.trim($('#txtEstilo').val());
	var var_marca = $.trim($('#txtMarca').val());		
	
	if(var_genero == "" || var_rubro == "" || var_categoria == "" || var_estilo == "" || var_marca == ""){
		alertify.warning("Seleccione las opciones.");			
		return false;
	}
	if ($("#formatoCodeBar").val() == "EAN-13" && $("#txtCodigo").val().length < 13){		
		alertify.warning("Revise el formato EAN-13.");			
		return false;
	}
	if ($("#formatoCodeBar").val() == "CODE128" && $("#txtCodigo").val() == ""){		
		alertify.warning("Revise el formato CODE128.");			
		return false;
	}
	if (cantTotal < 0){
		alertify.warning("El Stock no puede ser negativo.");			
		return false;
	}
	if(tablaTC == false){
		alertify.warning("Debe presionar el botón 'Actualizar'.");			
		return false;
	}
});
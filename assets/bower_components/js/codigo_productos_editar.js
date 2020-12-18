//CODIGO DE BARRAS para form EDITA PRODUCTOS	
codigo = $("#txtCodigo").val();	
formatoCodeBar = $("#formatoCodeBar").val();	
switch (formatoCodeBar) {
	case 'EAN-13': //admite SOLO NUMEROS
		codigo = codigo.substring(0,12);//tomo solo los primeros 12º digitos, al 13º lo calcula	
		JsBarcode("#barcode", codigo, {
		format: "EAN13",				
		font: "OCRB",
		fontSize: 16,
		textMargin: 0							
		});	
		$("#printCodeBar").show();
		$("#btnImpCodeBar").show();
		break;
	case 'CODE128'://admite LETRAS Y/O NUMEROS
		JsBarcode("#barcode", codigo, {
		format: "CODE128",				
		font: "bold",
		fontSize: 16,
		textMargin: 0				
		});				
		$("#printCodeBar").show();
		$("#btnImpCodeBar").show();
		break;
	case 'Ninguno'://admite LETRAS Y/O NUMEROS
		$("#printCodeBar").hide();
		$("#btnImpCodeBar").hide();
		break;
}		
//para controlar el checkbox
/*if($("#chkTU").prop('checked') == true && $("#chkCU").prop('checked') == true){
	//talle unico - no se pueden agregar talles/colores
	 $("#btnAgregarFilCol").hide();
}else{
	//talles multiples - SI se pueden agregar talles/colores
	$("#btnAgregarFilCol").show();
}	*/


if($("#chkTU").prop('checked') == true && $("#chkCU").prop('checked') == true){
	 //talle y color Unicos (no se puede agregar nada)
	 $("#btnAgregarFilCol").hide();
}else{			 
	if($("#chkTU").prop('checked') == true){	
		//si es talle unico, no se pueden agregar mas talles
		$("#nuevosTalles").hide();
	}else{
		$("#btnAgregarFilCol").show();
		$("#nuevosTalles").show();
	}
	if($("#chkCU").prop('checked') == true){		
		//si es color unico, no se pueden agregar mas colores
		 $("#nuevosColores").hide();
	}else{
		$("#btnAgregarFilCol").show();
		$("#nuevosColores").show();
	}
}
//NUEVO para tabla talles/colores	
$("#btnActualizarStock").click(function(){			
	$('#modal_alta_existencias').modal('show');		
	$("#modal_alta_existencias").draggable({ handle: ".modal-header" });
}); 		
//para guarda talles y colores
var myObj = {};			
$("#btnSaveTalleColor").click(function(){	
	var cantTotal = 0;					
	var talles = [];
	var colores = [];
	var cantidades=[];	
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
			if($(this).html() == ""){
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
	myObj = arrayTalleColor;	
	/*console.log(arrayTalleColor);
	console.log(talles);
	console.log("Cant de talles: "+talles.length);	
	console.log(colores);
	console.log("Cant de colores: "+colores.length);	
	console.log("Cantidades: "+cantidades);*/
	//console.log(JSON.stringify(myObj));					
	$("#txtStock").val(cantTotal);
	//envio el array a editar o crear
	$('#txtArrayCantidades').val(JSON.stringify(myObj));			
	alertify.success("¡Actualizado!");
	$('#modal_alta_existencias').modal('hide');		
});		
//NUEVO PARA AGREGAR TALLES/COLORES EN EDITAR.PHP
	$("#btnAgregarFilCol").click(function(){ 		
		$('#txtTalle').empty();//limpio el select
		//para TALLES NUEVOS
		$.ajax({			  
			  url: "../libreria/ORM/consulta_talles_nuevos.php",
			  type: "POST",
			  datatype:"json",    
			  data: {idRubro:idRubro, idGenero:idGenero, idCategoria:idCategoria},    
			  success: function(data) {									  			  
				var datos = JSON.parse(data); 				
				talles=[];				
				for (var i = 0; i < datos.length; i++) {																
					talles.push(String(datos[i].descripcion));					
				}			  
				listaTalles = [];
				$("#tablaTalleColor tr").not(':first').each(function(){	
					listaTalles.push($(this).find("td:first").text()); //capturo la lista de talles actual
				});  								
				var tempTalles = [];
				var i = 0;
				$.grep(talles, function(el){					
					if ($.inArray(el, listaTalles) == -1)
						tempTalles.push(el);											
					i++;
				}); 				  
				for(var i=0; i<tempTalles.length;i++){									
					$('#txtTalle').append('<option>'+tempTalles[i]+'</option>');					 
				}  
			  }
		});		
		
		//para COLORES NUEVOS
		$.ajax({			  
			  url: "../libreria/ORM/consulta_colores_nuevos.php",
			  type: "POST",
			  datatype:"json",    
			  data: {idRubro:idRubro, idGenero:idGenero, idCategoria:idCategoria},    
			  success: function(data) {									  			  
				var datos = JSON.parse(data); 								
				colores=[];				
				for (var i = 0; i < datos.length; i++) {																
					colores.push(String(datos[i].descripcion));					
				}			  
				listaColores = [];
				$("#tablaTalleColor th:not(:first-child)").each(function(){	
					listaColores.push($(this).text()); //capturo la lista de colores actual					
				});  				  								
				var tempColores = [];
				var i = 0;
				$.grep(colores, function(el){					
					if ($.inArray(el, listaColores) == -1)
						tempColores.push(el);											
					i++;
				}); 				  
				for(var i=0; i<tempColores.length;i++){									
					$('#txtColor').append('<option>'+tempColores[i]+'</option>');					 
				}  
			  }
		});		
		
		$('#modal_agregarTalleColor').modal('show');			
	});		
	
	arrayNuevosTalles=[]; 
	$("#btnAgregarTalle").click(function(){		
		listaTalles = [];
		$("#tablaTalleColor tr").not(':first').each(function(){	
			listaTalles.push($(this).find("td:first").text()); //capturo la lista de talles actual
		});			
		talleTxt = $.trim($("#txtTalle option:selected").text());//capturo el talle del select				
		if(jQuery.inArray(talleTxt, listaTalles) !== -1 || talleTxt == ""){
			alertify.alert("Control de Talles", "¡Controle la selección!");
		}else{
			//para añadir talle
			cantCol = $("#tablaTalleColor th:not(:first-child)").length;				
			var $td = '<td class="text-center cantidad" onkeypress="return testEnteros(event);" contenteditable="true"></td>';	
			var res = '';
			for (i = 0; i < cantCol; i++) {
				res += $td;
			}
			$('#tablaTalleColor > tbody:last-child').append('<tr><td class="text-center" style="background-color:#337ab7; color:white; width:20%">'+talleTxt+'</td>'+res+'</tr>');
			arrayNuevosTalles.push(talleTxt);			
		}						
		//console.log(arrayNuevosTalles);
		$('#txtArrayNuevosTalles').val(JSON.stringify(arrayNuevosTalles));
	});
	
	arrayNuevosColores=[]; 
	$("#btnAgregarColor").click(function(){		
		listaColores = [];
		$("#tablaTalleColor th:not(:first-child)").each(function(){	
			listaColores.push($(this).text());
		});			
		colorTxt = $.trim($("#txtColor option:selected").text());//capturo el talle del select				
		if(jQuery.inArray(colorTxt, listaColores) !== -1 || colorTxt == ""){
			alertify.alert("Control de Colores", "¡Controle la selección!");
		}else{
			//para añadir color			
			$('#tablaTalleColor thead tr').append('<th>'+colorTxt+'</th>');
			$('#tablaTalleColor tr:gt(0)').append('<td class="text-center cantidad" onkeypress="return testEnteros(event);" contenteditable="true"></td>');			
			arrayNuevosColores.push(colorTxt);			
		}		
		//console.log(arrayNuevosColores);
		$('#txtArrayNuevosColores').val(JSON.stringify(arrayNuevosColores));
	});

function testEnteros(event) {
  if ((event.keyCode >= 48 && event.keyCode <= 57) || event.keyCode === 13) {
    return true;
  } else {
    return false;
  }
}		
	
$('form').submit(function(){
	if ($("#formatoCodeBar").val() == "EAN-13" && $("#txtCodigo").val().length < 13){		
		alertify.warning("Revise el formato EAN-13");			
		return false;
	}
	if ($("#formatoCodeBar").val() == "CODE128" && $("#txtCodigo").val() == ""){		
		alertify.warning("Revise el formato CODE128");			
		return false;
	}
});	
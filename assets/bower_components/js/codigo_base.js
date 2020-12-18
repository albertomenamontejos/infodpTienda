$(document).ready(function(){
/*CODIGO BASE*/	
	//Funcion para validar numeros en Compras y Ventas
	$(function(){
	  $('.soloNumeros').keypress(function(e) {
		if(isNaN(this.value+""+String.fromCharCode(e.charCode))) return false;
	  })
	  .on("cut copy paste",function(e){
		e.preventDefault();
	  });
	});	
    //Inicializa el tema bootstrap de Alertify
    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-primary";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";  
	
	//--Para la vista NUEVO PRODUCTO--inicio//	
	var idGenero;
	var idRubro;
	var idCategoria;
	var idEstilo;
	var idMarca;
 	var idTalle;
 	var idColor;
		
	$('select#txtGenero').on('change',function(){			
		idGenero = $(this).val();					
		$('#txtIdGenero').val(idGenero);
	});	
	$('select#txtRubro').on('change',function(){			
		idRubro = $(this).val();						 
		$('#txtIdRubro').val(idRubro);			
	});    	
	$('select#txtCategoria').on('change',function(){			
		 idCategoria = $(this).val();			
	   $('#txtIdCategoria').val(idCategoria);
	});
	$('select#txtEstilo').on('change',function(){			
		 idEstilo = $(this).val();						
	   $('#txtIdEstilo').val(idEstilo);
	});    	
	$('select#txtMarca').on('change',function(){
		 idMarca = $(this).val();			 
	   $('#txtIdMarca').val(idMarca);
	});	
	$('select#txtTalle').on('change',function(){
		 idTalle = $(this).val();			
	   $('#txtIdTalle').val(idTalle);
	});	
	$('select#txtColor').on('change',function(){
		 idColor = $(this).val();			 
	   $('#txtIdColor').val(idColor);
	});
		
	//--Para la vista NUEVO PRODUCTO--fin//            
	
	//Para que al abrir una ventana modal, se haga foco en el elemento que tiene el autofocus
	$('.modal').on('shown.bs.modal', function() {
	  $(this).find('[autofocus]').focus();
	});
	
    // Código para imprimir
   $(".btnImprime").click(function (){
        $("div#myPrintArea").printArea();
    })
   
    //-- Control para que no se ingresen DUPLICADOS -- inicio//		
        //Productos - controla que el codigo ingresado no se repita en la Base de datos
        var codProdArray = [] ;
        var v_codigo_control;
        $("#tablaCodigos tbody tr").each(function(){
            codProdArray.push($(this).find("td:eq(0)").text());
        });          
        $('#txtCodigo').focusout(function () {
            if ($("#txtCodigo").val().length < 1){
                //campo vacío
            }else {
                v_codigo_control = $("#txtCodigo").val().toUpperCase();//captura el codigo y lo pone en Mayusc
                if ($.inArray(v_codigo_control,codProdArray) != -1) {
                    alertify.error("¡El Código ya existe!");
                    $("#txtCodigo").focus();    
            }
            }            
        });                 			       
    //*** Inicio USUARIOS ***//
    //Para abrir la ventana modal BUSCAR USUARIOS
    function abrirModalUsuarios(){
        $('#tituloModal').text("Buscar Usuarios");
        $('#modal_usuarios').modal('show');
    }
    //*** Fin USUARIOS ***//
	
    //-- Código para ALTA de USUARIO  --//		
    $('#btnControlaPass').click(function(){
		var user_nomyape = $("#txtNomyApe").val();	 
		var user_direccion = $("#txtDireccion").val();	 
		var user_telefono = $("#txtTelefono").val();	 
		var user_privilegio = $("#txtPrivilegio").val();	 		
		var user = $("#user").val();	 
        var password = $("#password").val();
        var confirm_password = $("#confirmaPassword").val();        
        if (user_nomyape.length < 1 || user_direccion.length < 1 || user_telefono.length < 1 || user_privilegio.length < 1 || password.length < 1 || user.length < 1) {            
			alertify.warning("Complete los campos.");
        }else{
        	if (password != confirm_password) {
            	alertify.error("La Password no coincide.");
            	$('#password').focus();
          	}else{
              	alertify.alert("Alta de Usuario","¡Operación Exitosa!", function(){
                userU = $('#user').val();
                passwordU = $('#password').val();
                $('#txtUser').val(userU);
                $('#txtPassword').val(passwordU);
                $('#btnRegistrarUsuario').click();
            	});
            }              
        }
     });	 	
	
	//-- Código para que CADA usuario pueda EDITAR SU PERFIL  --//
    $('#btnControlaPass2').click(function(){
		var user_nomyape = $("#txtNomyApe").val();	 
		var user_direccion = $("#txtDireccion").val();	 
		var user_telefono = $("#txtTelefono").val();	 		
        var password = $("#password").val();
        var confirm_password = $("#confirmaPassword").val();        			 
        if (user_nomyape.length < 1 || user_direccion.length < 1 || user_telefono.length < 1 || password.length < 1) {     
			alertify.warning("Complete los campos");
        }else{
        	if (password != confirm_password) {
            	alertify.error("La Password no coincide");
            	$('#password').focus();
          	}else{
              	alertify.alert("Modificación de Datos","¡Operación Exitosa!", function(){
                userU = $('#user').val();
                passwordU = $('#password').val();
                $('#txtUser').val(userU);
                $('#txtPassword').val(passwordU);
                $('#btnRegistrarUsuario').click();
            	});
            }              
        }
     });
	
	/*NUEVO PARA RESETEAR PASS*/
	$("#btnResetPass").click(function(){		
	alertify.confirm(
	  "Resetear Password",
	  "<strong>¿Desea generar una nueva password?</strong>", 
	  function(){
		var id = parseInt($("#id").val());
		//alert(id+"-"+password);		
			 $.ajax({
			  url: "../libreria/ORM/resetPass.php",
			  type: "POST",
			  datatype:"json",    
			  data: {id:id},    
			  success: function(data) {														  
				  alertify.alert("Reset de Passwrod","La nueva Password es: "+data, function(){});  					  
			   } 	 
			});				  
	  },
	  function(){
		alertify.warning('Operación Cancelada.');
	});	
	});
		
	/*Generar código de barras para formulario CREAR*/				
	$("#btnGenerarCodigo").click(function(){
				codigo = $("#txtCodigo").val();					
				formato = $("#formatoCodeBar").val();
				$('select#formatoCodeBar').on('change',function(){
					formato = $(this).val(); 					
				});				
				switch (formato) {
				case 'EAN-13': //admite SOLO NUMEROS
						if (codigo == "" || isNaN(codigo) == true || codigo.length < 13){							
							alertify.warning("EAN-13: Ingrese un código válido");;
							$("#txtCodigo").focus();	
							$("#printCodeBar").hide();
							$("#btnImpCodeBar").hide();							
						}else{
							codigo = codigo.substring(0,12);//tomo solo los primeros 12º digitos, al 13º lo calcula	
							JsBarcode("#barcode", codigo, {
							format: "EAN13",				
							font: "OCRB",
							fontSize: 16,
							textMargin: 0							
							});	
							$("#printCodeBar").show();
							$("#btnImpCodeBar").show();
						}										
					break;
				case 'CODE128'://admite LETRAS Y/O NUMEROS
						if (codigo == ""){			
							alertify.warning("CODE128 : Debe ingresar un código");;
							$("#txtCodigo").focus();	
							$("#printCodeBar").hide();
							$("#btnImpCodeBar").hide();							
						}else{
							JsBarcode("#barcode", codigo, {
							format: "CODE128",				
							font: "bold",
							fontSize: 16,
							textMargin: 0				
							});				
							$("#printCodeBar").show();
							$("#btnImpCodeBar").show();
						}	
					break;
				case 'Ninguno'://admite LETRAS Y/O NUMEROS
						$("#printCodeBar").hide();
						$("#btnImpCodeBar").hide();
				break;		
				}
	});		
	//Código para imprimir la etiqueta
	$("#btnImpCodeBar").click(function(){
		$("#printCodeBar").printArea();
	}); 	
	$("#btnBkp").click(function(){ 
	  alertify.success("¡Backup generado con Éxito!");
	});		
	
});
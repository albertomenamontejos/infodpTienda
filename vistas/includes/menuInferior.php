</div><!-- Fin "wrapper" -->
<!--Script para dialogo de eliminar con alertify -->
<script>
	$(document).ready(function(){
		$('#page-loader').fadeOut(500);		
	});	
	function confirmar(url){
		alertify.confirm(
			'Eliminar Registro',
			'¿Está seguro de eliminar el registro?',
			function(){
				window.location.href=url;
				 }
			, function(){
				alertify.error('Cancelado')});
	}
	
</script>
</body>
</html>
<?php
require 'serverside.php';
$table_data->get('flujodecajas', 'id', array('id', 'fecha', 'descripcion', 'entrada', 'salida', 'saldoActual'));
?>	
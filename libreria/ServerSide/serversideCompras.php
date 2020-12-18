<?php
require 'serverside.php';
$table_data->get('vista_compras', 'id', array('id', 'nroDeCompra', 'fechaCompra', 'proveedor', 'totalCompra'));
?>	
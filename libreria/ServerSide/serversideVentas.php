<?php
require 'serverside.php';
$table_data->get('vista_ventas', 'id', array('id', 'nroDeVenta', 'fechaVenta', 'cliente', 'formaPago', 'totalVenta', 'estado'));
?>
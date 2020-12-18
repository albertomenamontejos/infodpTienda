<?php
require 'serverside.php';
$table_data->get('productos', 'id', array('id','codigo', 'nombre','precioVenta'));
?>
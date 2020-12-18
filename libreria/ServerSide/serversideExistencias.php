<?php
require 'serverside.php';
$table_data->get('vista_existencias', 'id', array('id', 'codigo', 'nombre', 'talle', 'color' ,'stock'));
?>
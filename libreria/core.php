<?php
define("APP_RUTA",RUTA_BASE."app/");
define("VISTA_RUTA",RUTA_BASE."vistas/");

define("ASSETS_PATH",RUTA_BASE."assets/");
define("ASSETS_IMG",ASSETS_PATH."img/");
define("LIBRERIA",RUTA_BASE."libreria/");

define("RUTA",APP_RUTA."rutas/");
define("CONTROLADORES",APP_RUTA."controlador/");
define("MODELS",APP_RUTA."modelo/");

//configuraciones
//require_once(RUTA_BASE."config/config.php");
require_once("ORM/Conexion.php");
require_once("ORM/DpORM.php");
require_once("ORM/Modelo.php");
require_once("help/class.inputfilter.php");
require_once("help/funciones.php");

includeModels();
require_once("Vista.php");
include "Ruta.php";
include RUTA."rutas.php";
<?php
namespace libreria\ORM;

    class Modelo extends DpORM{
        //propiedad  que va a contener a todas las propiedades dinamicamente
        private $data = array();
        protected static $table;
		
        //Generamos un constructor para instanciar a $data    
        function __construct($data = null) {
            $this->data = $data;
        }
        //Generamos los getters        
        function __get($name) {         
            if (array_key_exists($name, $this->data)) {
                return $this->data[$name];
            }
        }
		//Generamos los setters
        function __set($name, $value) {            
            $this->data[$name] = $value;
        }
		//Para tomar los campos(columnas) de cada tabla
        public function getColumnas() {
			return $this->data;	
        }

    }
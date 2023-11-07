<?php
    class ControladorProductos{
        //Funcion para consultar el listado de productos en venta.
        static function consultaDispositivos(){
            $tabla = 'dispositivos';
            $obj = ModeloDispositivos::selectDispositivos($tabla);
            $arregloDispositivos = $obj->fetch_all();
            return $arregloDispositivos;
        }
    }
        ?>
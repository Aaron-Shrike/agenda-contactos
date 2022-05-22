<?php 
    function obtenerContactos(){
        try {
            include "bd-conexion.php";
            return $conexion->query("SELECT * FROM contactos");
        } catch (\Exception $e) {
            echo "Error!" . $e->getMessage() . "<br>";
            return false;
        }
    }

    //optine un contacto
    function obtenerUnContacto($id){
        include "bd-conexion.php";
        try {
            return $conexion->query("SELECT * FROM contactos WHERE id_contacto = $id");
        } catch (\Exception $e) {
            echo "Error!" . $e->getMessage() . "<br>";
            return false;
        }
    }
?>
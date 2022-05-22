<?php 
    //contactes como javascript const hello;
    define("BD_USUARIO", "root");
    define("BD_PASSWORD", "root");
    define("BD_HOST", "localhost");
    define("BD_NAME", "agendaPHP");
    define("BD_PORT", "3306");

    $conexion = new mysqli(BD_HOST, BD_USUARIO, BD_PASSWORD, BD_NAME, BD_PORT);

    //comprueba si se conecto, 1:conecto 0 o null: no conecto
    //echo $conexion->ping();
?>
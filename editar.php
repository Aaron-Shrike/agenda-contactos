<?php include "includes/funciones/funciones.php"; ?>

<?php include_once "includes/layout/header.php"; ?>
    <?php 
        $id = filter_var($_GET['id'], FILTER_VALIDATE_INT); 
        if(!$id){
            die('No es valido');
        }
        $resultado = obtenerUnContacto($id);
        //con foreach o fetchassoc
        $contacto = $resultado->fetch_assoc();
        // echo "<pre>";
        //     //echo var_dump($contacto);
        //     // foreach($resultado as $i){
        //     //     echo var_dump($i);
        //     // }
        // echo "<pre>";
    ?>
    <div class="contenedor-barra">
        <div class="contenedor barra">
            <a href="index.php" class="btn volver">Volver</a>
            <h1>Editar Contacto</h1>
        </div>
    </div>
    <div class="bg-amarillo contenedor sombra">
        <form action="#" id="contacto">
            <legend>Editar el contacto</legend>
            <?php include_once "includes/layout/formulario.php"; ?>
        </form>
    </div>
<?php include_once "includes/layout/footer.php"; ?>
<?php include_once "includes/funciones/funciones.php"; ?>
<?php include_once "includes/layout/header.php"; ?>
    <div class="contenedor-barra">
        <h1>Agenda de Contactos</h1>
    </div>
    <div class="bg-amarillo contenedor sombra">
        <form action="#" id="contacto">
            <legend>Añada un campo<span>Todos los campos son abligatorios</span></legend>
            <?php include_once "includes/layout/formulario.php"; ?>
        </form>
    </div>
    <div class="site-contactos bg-blanco contenedor sombra">
        <div class="contenedor-contactos">
            <h2>Contactos</h2>
            <input type="text" name="" id="buscar" class="buscador sombra" placeholder="Buscar contacto...">
            <p class="num-contactos"><span></span> Contacto(s)</p>
            <div class="contenedor-tabla">
                <table id="listado-contactos">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $contactos = obtenerContactos(); ?>
                        <?php 
                            if($contactos->num_rows){
                                foreach($contactos as $i){ ?>
                                    <tr>
                                        <td><?php echo $i['nombre']; ?></td>
                                        <td><?php echo $i['empresa']; ?></td>
                                        <td><?php echo $i['telefono']; ?></td>
                                        <td>
                                            <a href="editar.php?id=<?php echo $i['id']; ?>" class="btn btn-editar">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button class="btn btn-borrar" data-id="<?php echo $i['id']; ?>">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php }
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php include_once "includes/layout/footer.php"; ?>
<div class="campos">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input 
            type="text" 
            name="nombre" 
            id="nombre" 
            placeholder="Nombre Contacto" 
            value="<?php echo (isset($contacto['nombre_contacto'])) ? $contacto['nombre_contacto'] : ""; ?>"
        >
    </div>
    <div class="campo">
        <label for="empresa">Empresa:</label>
        <input 
            type="text" 
            name="empresa" id="empresa" 
            placeholder="Nombre Empresa"
            value="<?php echo (isset($contacto['empresa_contacto'])) ? $contacto['empresa_contacto'] : ""; ?>"
        >
    </div>
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input 
            type="tel" 
            name="telefono" 
            id="telefono" 
            placeholder="Numero telefonico"
            value="<?php echo (isset($contacto['telefono_contacto'])) ? $contacto['telefono_contacto'] : ""; ?>"
        >
    </div>
</div>
<div class="campo enviar">
    <?php 
        $textoBtn = (isset($contacto['telefono_contacto'])) ? "Guardar" : "Añadir";
        $accion = (isset($contacto['telefono_contacto'])) ? "editar" : "crear";
    ?>
    <input type="hidden" name="" id="accion" value="<?php echo $accion; ?>">
    <?php if(isset($contacto['id_contacto'])){ ?>
        <input type="hidden" name="" id="id" value="<?php echo $contacto['id_contacto']; ?>">
    <?php } ?>
    <input type="submit" value="<?php echo $textoBtn; ?>">
</div>
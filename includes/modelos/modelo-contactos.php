<?php 
    if($_POST['accion'] == "crear"){
        require_once("../funciones/bd-conexion.php");
        //validar entradas
        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);

        try {
            $stmt = $conexion->prepare("INSERT INTO contactos (nombre, empresa, telefono) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $empresa, $telefono);
            $stmt->execute();
            if($stmt->affected_rows == 1){
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'datos' => array(
                        'id_insertado' => $stmt->insert_id,
                        'nombre' => $nombre,
                        'empresa' => $empresa,
                        'telefono' => $telefono
                    )
                );
            }
            $stmt->close();
            $conexion->close();
        } catch (\Exception $e) {
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }

        echo json_encode($respuesta);
    }

    if(isset($_GET['accion']) && $_GET['accion'] == "borrar"){
        require_once("../funciones/bd-conexion.php");

        $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $stmt = $conexion->prepare("DELETE FROM contactos WHERE id_contacto = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            if($stmt->affected_rows == 1){ // si hay algun cambio
                $respuesta = array(
                    'respuesta' => 'correcto'
                );
            }
            $stmt->close();
            $conexion->close();
        } catch (\Exception $e) {
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        echo json_encode($respuesta);
    }

    if($_POST['accion'] == "editar"){
        //echo json_encode($_POST);
        require_once("../funciones/bd-conexion.php");

        $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
        $empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
        $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $stmt = $conexion->prepare("UPDATE contactos SET nombre_contacto = ?, empresa_contacto = ?, telefono_contacto = ? WHERE id_contacto = ?");
            $stmt->bind_param("sssi", $nombre, $empresa, $telefono, $id);
            $stmt->execute();
            if($stmt->affected_rows == 1){ // si hay algun cambio
                $respuesta = array(
                    'respuesta' => 'correcto'
                );
            }
            $stmt->close();
            $conexion->close();
        } catch (\Exception $e) {
            $respuesta = array(
                'error' => $e->getMessage()
            );
        }
        echo json_encode($respuesta);
    }
?>
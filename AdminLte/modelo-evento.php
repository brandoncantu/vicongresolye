<?php
include_once('funciones/funciones.php');
if(isset($_POST['evento'])){
    $evento = $_POST['evento'];
    $invitados = (int) $_POST['invitados'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];

    $hora = str_replace(" PM", ":00", $_POST['hora']) ;
    $categorias = (int) $_POST['categorias'];
    $clave = $_POST['clave'];
}

function check(){
    if(empty($_POST['evento']) || empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['clave'])){
        $respuesta = array(
            'respuesta' => 'error',
            'message' => 'Error al insertar! Datos vacios'
        );
        die(json_encode($_POST));
    }
}
if(isset($_POST['registro'])){
    if($_POST['registro'] == 'nuevo'){
        check();
        //die(json_encode($fecha));
        try{
            $sql = "INSERT INTO eventos (nombre_evento, id_invitado, fecha_evento, hora_evento, cat_evento, clave) values (?,?,?,?,?,?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("sissis", $evento, $invitados, $fecha, $hora, $categorias, $clave);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($id_registro > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro,
                    'message' => 'Evento dado de alta!'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Error al insertar! Evento ya existe'
                );
            }
            $stmt->close();
            $link->close();
        }catch(Exception $e){
            $respuesta = array(
                'respuesta' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
    /////////////
    if($_POST['registro'] == 'editar'){
        check();
        try{
            $sql = "UPDATE eventos SET nombre_evento = ?, id_invitado  = ?, fecha_evento  = ?, 
                                        hora_evento  = ?, cat_evento  = ?, clave  = ? WHERE id_evento = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("sissisi", $evento, $invitados, $fecha, $hora, $categorias, $clave, $_POST['id']);
            $stmt->execute();
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'message' => 'Se actualizaron los datos'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Error al actualizar! Los datos son los mismos'
                );
            }
            $stmt->close();
            $link->close();
        }catch(Exception $e){
            $respuesta = array(
                'respuesta' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
    /////////////
    if($_POST['registro'] == 'borrar'){
        $id = $_POST['id'];
        try{

            $sql = "DELETE FROM eventos WHERE id_evento = ?";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'message' => 'Se borro el registro'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Error al borrar! Hubo un problema'
                );
            }
            $stmt->close();
            $link->close();
        }catch(Exception $e){
            $respuesta = array(
                'respuesta' => 'error',
                'message' => 'Error: ' . $e->getMessage()
            );
        }

        die(json_encode($respuesta));
    }
}

?>
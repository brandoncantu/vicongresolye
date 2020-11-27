<?php
include_once('funciones/funciones.php');
if(isset($_POST['nombre'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $descripcion = $_POST['descripcion'];
}

function check(){
    if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['descripcion'])){
        $respuesta = array(
            'respuesta' => 'error',
            'message' => 'Error al insertar! Datos vacios'
        );
        die(json_encode($respuesta));
    }
}

if(isset($_POST['registro'])){
    
    if($_POST['registro'] == 'nuevo'){
        check();
        $directorio = "../img/invitados/";
        if(!is_dir($directorio)){
            mkdir($directorio, 0755, true);
        }
        if(move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . $_FILES['foto']['name'])) {
            $imagen_url = $_FILES['foto']['name'];
            $imagen_resultado = "Se subio correctamente";
        }else{
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }

        try{
            $sql = "INSERT INTO invitados (nombre_invitado, apellido_invitado, descripcion, url_imagen) values (?,?,?,?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $apellido, $descripcion, $imagen_url);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($id_registro > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro,
                    'message' => $imagen_resultado
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Error al insertar! Invitado ya existe'
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
            $directorio = "../img/invitados/";
            if($_FILES['foto']['size'] > 0){

                if(!empty($_POST['imgActual'])){
                    $file_to_delete = $directorio.$_POST['imgActual'];
                    unlink($file_to_delete);
                }

                if(move_uploaded_file($_FILES['foto']['tmp_name'], $directorio . $_FILES['foto']['name'])) {
                    $imagen_url = $_FILES['foto']['name'];
                    $imagen_resultado = "Se subio correctamente";
                }else{
                    $respuesta = array(
                        'respuesta' => error_get_last()
                    );
                }

                $sql = "UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ? WHERE id_invitado = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("ssssi", $nombre, $apellido, $descripcion, $imagen_url, $_POST['id']);

            }else{
                $sql = "UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ? WHERE id_invitado = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("sssi", $nombre, $apellido, $descripcion, $_POST['id']);
            }
            
            $stmt->execute();
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'message' => 'Se actualizaron los datos',
                    'imagenNueva' => $directorio.$_FILES['foto']['name']
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
            $directorio = "../img/invitados/";
            $file_to_delete = $directorio.$_POST['imagen'];
            unlink($file_to_delete);

            $sql = "DELETE FROM invitados WHERE id_invitado = ?";
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
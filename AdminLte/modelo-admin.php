<?php
include_once('funciones/funciones.php');
function check(){
    if(empty($_POST['usuario']) || empty($_POST['password']) || empty($_POST['nombre'])){
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
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $nombre = $_POST['nombre'];
        $opciones = array(
            'cost' => 12
        );

        $password_hash = password_hash($password, PASSWORD_BCRYPT, $opciones);

        try{
            $sql = "INSERT INTO admins (admin, nombre, pass) values (?,?,?)";
            $stmt = $link->prepare($sql);
            $stmt->bind_param("sss", $usuario, $nombre, $password_hash);
            $stmt->execute();
            $id_registro = $stmt->insert_id;
            if($id_registro > 0){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_admin' => $id_registro,
                    'message' => 'Se creo el administrador'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Error al insertar! Usuario ya existe'
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
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        try{
            if(empty($_POST['password'])){
                $sql = "UPDATE admins SET admin = ?, nombre = ?, fecha_mod = NOW() WHERE id_admin = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("ssi", $usuario, $nombre, $_POST['id']);
            }else{
                $opciones = array(
                    'cost' => 12
                );   
                $password_hash = password_hash($password, PASSWORD_BCRYPT, $opciones);
                $sql = "UPDATE admins SET admin = ?, nombre = ?, pass = ?, fecha_mod = NOW() WHERE id_admin = ?";
                $stmt = $link->prepare($sql);
                $stmt->bind_param("sssi", $usuario, $nombre, $password_hash, $_POST['id']);
            }
            $stmt->execute();
            if($stmt->affected_rows){
                $respuesta = array(
                    'respuesta' => 'exito',
                    'message' => 'Se actualizaron los datos'
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Error al actualizar! Hubo un problema'
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
            $sql = "DELETE FROM admins WHERE id_admin = ?";
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
/////////////
if(isset($_POST['login-admin'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    try{
        include_once('funciones/funciones.php');
        $sql = "SELECT * FROM admins WHERE admin = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $url_imagen, $editado);
        if($stmt->affected_rows){
            $existe = $stmt->fetch();
            if($existe){
                if(password_verify($_POST['password'], $password_admin)){
                    session_start();
                    $_SESSION['usuario']= $usuario_admin;
                    $_SESSION['nombre']= $nombre_admin;
                    $_SESSION['imagen']= $url_imagen;
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'id_admin' => $id_admin,
                        'usuario' => $usuario_admin,
                        'nombre' => $nombre_admin,
                        'message' => 'Bienvenido '.$nombre_admin
                    );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error',
                        'id_admin' => $id_admin,
                        'message' => 'Contraseña incorrecta'
                    );
                }
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Usuario no existe'
                );
            }
        }else{
            $respuesta = array(
                'respuesta' => 'error',
                'message' => 'Error al ingresar! Usuario ya existe'
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
////////////
if(isset($_POST['login-admin'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    try{
        include_once('funciones/funciones.php');
        $sql = "SELECT * FROM admins WHERE admin = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id_admin, $usuario_admin, $nombre_admin, $password_admin, $url_imagen, $editado);
        if($stmt->affected_rows){
            $existe = $stmt->fetch();
            if($existe){
                if(password_verify($_POST['password'], $password_admin)){
                    session_start();
                    $_SESSION['usuario']= $usuario_admin;
                    $_SESSION['nombre']= $nombre_admin;
                    $_SESSION['imagen']= $url_imagen;
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'id_admin' => $id_admin,
                        'usuario' => $usuario_admin,
                        'nombre' => $nombre_admin,
                        'message' => 'Bienvenido '.$nombre_admin
                    );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error',
                        'id_admin' => $id_admin,
                        'message' => 'Contraseña incorrecta'
                    );
                }
            }else{
                $respuesta = array(
                    'respuesta' => 'error',
                    'message' => 'Usuario no existe'
                );
            }
        }else{
            $respuesta = array(
                'respuesta' => 'error',
                'message' => 'Error al ingresar! Usuario ya existe'
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
?>
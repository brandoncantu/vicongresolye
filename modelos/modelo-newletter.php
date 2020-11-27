<?php
    //creará un nuevo registro en la base de datos

    require_once('../includes/templates/funciones/config.php');

    // Validar las entradas
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    
    try {
         $stmt = $link->prepare("INSERT INTO newsletter (email) VALUES (?)");         
         $stmt->bind_param("s", $email);
         $stmt->execute();
         if($stmt->affected_rows == 1) {
              $respuesta = array(
                   'respuesta' => 'correcto',
                    'email' => $email,
                    'id_insertado' => $stmt->insert_id
                   
              );
         }
         $stmt->close();
         $link->close();
    } catch(Exception $e) {
         $respuesta = array(
              'error' => $e->getMessage()
         );
    }
    echo json_encode($respuesta);
?>
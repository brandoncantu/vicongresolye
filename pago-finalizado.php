<?php require_once('includes/templates/header.php'); 

use PayPal\Rest\ApiContext;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Payment;
require 'includes/templates/funciones/config-paypal.php';

?>

<section class="seccion contenedor pag-validar-registro">
    <h2>Resumen Registro</h2>

    <?php   
          $paymentID = $_GET['paymentId'];
          $idPago = (int) $_GET['id_pago'];
          $payer = $_GET['PayerID'];

          //Peticion a REST API
          $pago = Payment::get($paymentID, $apiContext);
          $ejecucion = new PaymentExecution();
          $ejecucion->setPayerId($payer);
          
          $resultado = $pago->execute($ejecucion, $apiContext);
          $respuesta = $resultado->transactions[0]->related_resources[0]->sale->state;

          if($respuesta == 'completed'){
              echo '<div class="resultado correcto">';
              echo '<h3>';
              echo "Registro exitoso";
              echo "<p>El ID del pago es: <span>".$paymentID." </span>.</p>";
              echo "</h3>";
              echo "</div>";

              require_once('includes/templates/funciones/config.php');
              $stmt = $link->prepare("UPDATE registrados SET pagado = ? WHERE id_registrado = ?");
              $pagado = 1;
              $stmt->bind_param('ii', $pagado, $idPago);
              $stmt->execute();
              $stmt->close();
              $link->close();
          }else{ 
            echo '<div class="resultado error">';
            echo '<h3>';
            echo "!! Hubo un problema con el pago !!";
            echo "</h3>";
            echo "</div>";
          }
    ?>

</section>

<?php require_once('includes/templates/footer.php') ?>
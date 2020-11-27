<?php

if(!isset($_POST['submit'])){
    exit('Hubo un error');
}

use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

require 'includes/templates/funciones/config-paypal.php';

if(isset($_POST['submit'])){
  $result = "";
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $regalo = (int) $_POST['regalo'];
  $total = $_POST['total_pedido'];
  $fecha = date('Y-m-d H:i:s');   
  //PEDIDOS
  $boletos = $_POST['boletos'];
  $numero_boletos = $boletos;

  $pedidoExtra =  $_POST['pedido_extra'];
  $camisas = $_POST['pedido_extra']['camisas']['cantidad'];
  $precioCamisa = $_POST['pedido_extra']['camisas']['precio'];

  $etiquetas = $_POST['pedido_extra']['sticker']['cantidad'];
  $precioEtiquetas = $_POST['pedido_extra']['sticker']['precio'];

  require_once('includes/templates/funciones/funciones.php');
  $pedido = productos_json($boletos, $camisas, $etiquetas);
  //EVENTOS
  $eventos = $_POST['registro'];
  $registro = eventos_json($eventos);

  try{
      require_once('includes/templates/funciones/config.php');
      $sql = "INSERT INTO `registrados` (`nombre_registrado`, `apellido_registrado`, `email_registrado`, `fecha_registro`, `pases_articulos`, `talleres_registrados`, `regalo`, `total_pagado`) VALUES (?,?,?,?,?,?,?,?)";
      if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          mysqli_stmt_bind_param($stmt, "ssssssis",$p_nombre,$p_apellido,$p_email,$p_fecha,$p_pedido,$p_registro,$p_regalo,$p_total);            
          // Set parameters
          $p_nombre = $nombre;
          $p_apellido = $apellido;
          $p_email = $email;
          $p_fecha = $fecha;
          $p_pedido = $pedido;
          $p_registro = $registro;
          $p_regalo = $regalo;
          $p_total = $total;
          // Attempt to execute the prepared statement
          if(mysqli_stmt_execute($stmt)){
              $id_registro = $stmt->insert_id;
              mysqli_stmt_close($stmt);
              $link->close();
              //header('Location: validar-registro.php?exitoso=1&id_pago={$id_registro}');
          } else{
              mysqli_stmt_close($stmt);
              $link->close();
              //header('Location: validar-registro.php?error==1');
          }
      }
  }catch(Exception $e){
       $error = $e->getMessage();
  } 

$compra = new Payer();
$compra->setPaymentMethod('paypal');

// $articulo = new Item();
// $articulo->setName($producto)
//          ->setCurrency('MXN')
//          ->setQuantity(1)
//          ->setPrice($precio);

$i = 0;
$arreglo_pedido = array();
foreach($numero_boletos as $key => $value){

  if( (int) $value['cantidad'] > 0){

    ${"articulo$i"} = new Item();
    $arreglo_pedido[] = ${"articulo$i"};
    ${"articulo$i"}->setName('Pase: '.$key)
                    ->setCurrency('MXN')
                    ->setQuantity( (int) $value['cantidad'])
                    ->setPrice((int) $value['precio']);
    $i++;
  }
}

foreach($pedidoExtra as $key => $value){

  if( (int) $value['cantidad'] > 0){

    if($key == 'camisas'){
      $precio = (float) $value['precio'] * .93;
    }else{
      $precio = (int) $value['precio'];
    }

    ${"articulo$i"} = new Item();
    $arreglo_pedido[] = ${"articulo$i"};
    ${"articulo$i"}->setName('Extras: '.$key)
                    ->setCurrency('MXN')
                    ->setQuantity( (int) $value['cantidad'])
                    ->setPrice($precio);
    $i++;
  }
}

$lista = new ItemList();
$lista->setItems($arreglo_pedido);

$detalles = new Details();
$detalles->setShipping(0);

// echo "<pre>";
// var_dump($lista);
// echo "--------- </pre>";
        
$cant = new Amount();
$cant->setCurrency('MXN')
      ->setDetails($detalles)
      ->setTotal($total);

$transaccion = new Transaction();
$transaccion->setAmount($cant)
            ->setItemList($lista)
            ->setDescription('Pago VICONGRESO')
            ->setInvoiceNumber($id_registro);

$redireccion = new RedirectUrls();
$redireccion->setReturnUrl(URL_SITIO."/pago-finalizado.php?id_pago={$id_registro}")
            ->setCancelUrl(URL_SITIO."/pago-finalizado.php?&id_pago={$id_registro}");
        
$pago = new Payment();
$pago->setIntent("sale")
        ->setPayer($compra)
        ->setRedirectUrls($redireccion)
        ->setTransactions(array($transaccion));

try {
    $pago->create($apiContext);
  } catch (PayPal\Exception\PayPalConnectionException $pce) {
    // Don't spit out errors or use "exit" like this in production code
    echo '<pre>';print_r(json_decode($pce->getData()));exit;
}

$aprobado = $pago->getApprovalLink();


header("Location: {$aprobado}");

// //echo $redireccion->getReturnUrl();
}

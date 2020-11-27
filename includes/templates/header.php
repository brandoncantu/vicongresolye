<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Home</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="icon" href="img/icon.png" sizes="96x96">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/all.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Oswald&family=PT+Sans&display=swap"
    rel="stylesheet">
  <?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    if($pagina == 'invitados'){ echo '<link rel="stylesheet" href="css/colorbox.css">'; }else
    if($pagina == 'conferencias'){ echo '<link rel="stylesheet" href="css/lightbox.css"> '; }else
    if($pagina == 'registro' || $pagina == 'index'){ echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">'; }
  ?>  
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <link rel="stylesheet" href="css/main.css">

  <meta name="theme-color" content="#fafafa">
</head>

<body>
  <header class="site-header">
    <div class="hero">
      <div class="contenido-header">
        <nav class="redes-sociales">
          <?php include 'social-media.php'; ?>
        </nav>
        <div class="informacion-evento">
          <div class="lugar-fecha">
            <p class="fecha"><i class="fas fa-calendar-alt"></i>05-07 Mayo</p>
            <p class="ciudad"><i class="fas fa-map-marker-alt"></i>Monterrey, Mx</p>
          </div>
          <!--<h1 class="nombre-sitio"><a href="index.html" class="title">VI CONGRESO</a></h1>-->
          <a href="index" class="title">
            <img src="img/logo-congress.PNG" alt="logo_congreso">
          </a>
          <p class="slogan">De <span>Líderes </span>y <span>Emprendedores</span></p>
        </div>
        <!--info-evento-->
      </div>
      <!--contenido-header-->
    </div>
    <!--hero-->
  </header>
  <div class="barra">
    <div class="contenedor clearfix">
      <div class="img-movil">
        <div class="logo">
          <a href="index">
            <img src="img/logo.png" alt="logo VICONGRESO LE">
          </a>
        </div>
        <!--logo-->
        <div class="menu-movil">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <!--menu-movil-->
      </div>
      <nav class="navegacion-principal clearfix">
        <a href="conferencias">Conferencia</a>
        <a href="calendario">Calendario</a>
        <a href="invitados">Invitados</a>
        <a href="registro">Reservaciones</a>
      </nav>
    </div>
    <!--contenedor-->
  </div>
  <!--barra-->
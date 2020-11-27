<section class="seccion contenedor">
  <h2>Invitados</h2>

<?php
    try{
        require_once('includes/templates/funciones/config.php');
        $sql = "SELECT * FROM invitados";
        $res = $link->query($sql);
    }catch(Exception $e){
        echo $e->getMessage();
    }
?>

<?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    $cursor = "default";
    if($pagina == 'invitados'){ $cursor = "pointer"; } 
?>

<div class="invitados">
    <ul class="lista-invitados clearfix">
    <?php     
    while($invitados = $res->fetch_assoc() ){
    ?>
    <li>
        <div class="invitado">
            <a style="cursor:<?php echo $cursor ?>" href="#invitado<?php echo $invitados['id_invitado']; ?>" class="invitado-info">
                <img src="img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="imagen_invitado1">
                <p><?php echo $invitados['nombre_invitado']." ".$invitados['apellido_invitado']; ?></p>
            </a>
        </div>
        <!--invitado-->
      </li>

      <div style="display:none">
        <div class="invitado-info" id="invitado<?php echo $invitados['id_invitado']; ?>">
            <h2><?php echo $invitados['nombre_invitado']." ".$invitados['apellido_invitado']; ?></h2>
            <img src="img/invitados/<?php echo $invitados['url_imagen']; ?>" alt="imagen_invitado1">
            <p><?php echo $invitados['descripcion']; ?></p>
        </div>
      </div>

    <?php } ?>
    
</div>

        <?php $link->close(); ?>
</section>
<?php require_once('includes/templates/header.php') ?>

  <section class="seccion contenedor pag-index">
    <h2>La mejor conferencia de liderazgo y emprendimiento para jóvenes</h2>
    <p>El VI Congreso de Lideres y Emprendedores de la Universidad del Valle de México ya está aquí.
    Desde ponencias y conferencias impartidas por expertos, hasta dinámicas y actividades que harán despertar
    tus habilidades de líder y explotarlas tanto como desees.</p>
  </section>
  <!--seccion-->

  <section class="programa">
    <div class="contenedor-video">
      <img src="img/bg-talleres.jpg" alt="bg-talleres.jpg">
    </div>
    <!--contenedor video-->
    <div class="contenido-programa">
      <div class="contenedor">
        <div class="programa-evento">
          <h2>Programa del Evento</h2>

          <?php //Traer categoria desde SQL
              try {
                require_once('includes/templates/funciones/config.php');
                $sql = "SELECT * FROM `categoria_evento` ";
                $resultado = $link->query($sql);
              }catch (Exception $e) {
                $error = $e->getMessage();
               }
          ?>
          <nav class="menu-programa">
          <?php //Imprimir categorias en NAV
            while($cat = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
            <?php $categoria = $cat['cat_evento']; ?>
              <a href="#<?php echo strtolower($categoria) ?>">
              <i class="fa <?php echo $cat['icono'] ?>" aria-hidden="true"></i> <?php echo $categoria ?>
              </a>
          <?php } ?>
          </nav>

          <?php //Traer ventos desde SQL
              try {
                require_once('includes/templates/funciones/config.php');
                $sql = "SELECT eventos.id_evento, eventos.nombre_evento, eventos.fecha_evento, eventos.hora_evento, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado 
                FROM `eventos` 
                INNER JOIN `categoria_evento` 
                ON eventos.cat_evento=categoria_evento.id_categoria 
                INNER JOIN `invitados` 
                ON eventos.id_invitado=invitados.id_invitado 
                AND eventos.cat_evento = 1 
                ORDER BY `id_evento` LIMIT 2;
                SELECT eventos.id_evento, eventos.nombre_evento, eventos.fecha_evento, eventos.hora_evento, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado 
                FROM `eventos` 
                INNER JOIN `categoria_evento` 
                ON eventos.cat_evento=categoria_evento.id_categoria 
                INNER JOIN `invitados` 
                ON eventos.id_invitado=invitados.id_invitado 
                AND eventos.cat_evento = 2 
                ORDER BY `id_evento` LIMIT 2;
                SELECT eventos.id_evento, eventos.nombre_evento, eventos.fecha_evento, eventos.hora_evento, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado 
                FROM `eventos` 
                INNER JOIN `categoria_evento` 
                ON eventos.cat_evento=categoria_evento.id_categoria 
                INNER JOIN `invitados` 
                ON eventos.id_invitado=invitados.id_invitado 
                AND eventos.cat_evento = 3 
                ORDER BY `id_evento` LIMIT 2;";
              }catch (Exception $e) {
                $error = $e->getMessage();
              }
          ?>

          <?php $link->multi_query($sql); ?>
          <?php //Imprimir Eventos
            do {
              $resultado = $link->store_result();
              $row = $resultado->fetch_all(MYSQLI_ASSOC);
              $i = 0; ?>
              <?php foreach($row as $evento): ?>
                <?php if($i % 2 == 0) { ?>
                  <div id="<?php echo strtolower($evento['cat_evento']) ?>" class="info-curso ocultar clearfix">
                <?php } ?>
                    <div class="detalle-evento">
                      <h3><?php echo html_entity_decode($evento['nombre_evento']) ?></h3>
                      <p><i class="fa fa-clock" aria-hidden="true"></i> <?php echo $evento['hora_evento']; ?></p>
                      <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $evento['fecha_evento']; ?></p>
                      <p><i class="fa fa-user" aria-hidden="true"></i> <?php echo $evento['nombre_invitado'] . " " .  $evento['apellido_invitado']; ?></p>
                    </div>
                  <?php if($i % 2 == 1): ?>
                    <a href="calendario" class="button float-right">Ver todos</a>
                  </div> <!--#talleres-->
                  <?php endif; ?>
                  <?php $i++; ?>
              <?php endforeach; ?>
              <?php $resultado->free(); ?>
            <?php  } while ($link->more_results() && $link->next_result());?>

      </div>
      <!--programa evento-->
    </div>
    <!--contenedor-->
    </div>
    <!--contenido programa-->
  </section>
  <!--programa-->

  <?php require_once('includes/templates/invitados_temp.php') ?>


  <div id="contador-parallax" class="contador parallax">
    <div class="contenedor">
      <ul class="resumen-evento clearfix">
        <li>
          <p id="num-cont1" class="numero"></p>Invitados
        </li>
        <li>
          <p id="num-cont2" class="numero"></p>Talleres
        </li>
        <li>
          <p id="num-cont3" class="numero"></p>Dias
        </li>
        <li>
          <p id="num-cont4" class="numero"></p>Conferencias
        </li>
      </ul>
    </div>
    <!--contenedor-->
  </div>
  <!--contador-->

  <section class="precios seccion">
    <h2>Precios</h2>
    <div class="contenedor">
      <ul class="lista-precios clearfix">
        <li>
          <div class="tabla-precio">
            <h3>Pase por día</h3>
            <p class="numero">$30</p>
            <ul>
              <li><i class="fa fa-check"></i>Bocadillos gratis</li>
              <li><i class="fa fa-check"></i>Todas las Conferencias</li>
              <li><i class="fa fa-check"></i>Todos los talleres</li>
            </ul>
            <a href="registro" class="button hollow">Comprar</a>
          </div>
        </li>

        <li>
          <div class="tabla-precio">
            <h3>Todos los Dias</h3>
            <p class="numero">$50</p>
            <ul>
              <li><i class="fa fa-check"></i>Bocadillos gratis</li>
              <li><i class="fa fa-check"></i>Todas las Conferencias</li>
              <li><i class="fa fa-check"></i>Todos los talleres</li>
            </ul>
            <a href="registro" class="button hollow">Comprar</a>
          </div>
        </li>

        <li>
          <div class="tabla-precio">
            <h3>Pase por 2 Dias</h3>
            <p class="numero">$45</p>
            <ul>
              <li><i class="fa fa-check"></i>Bocadillos gratis</li>
              <li><i class="fa fa-check"></i>Todas las Conferencias</li>
              <li><i class="fa fa-check"></i>Todos los talleres</li>
            </ul>
            <a href="registro" class="button hollow">Comprar</a>
          </div>
        </li>
      </ul>
      <!--lista precios-->
    </div>
    <!--contenedor-->
  </section>
  <!--precios-->

  <div class="mapa" id="mapa"></div>

  <section class="section">
    <h2>Testimoniales</h2>
    <div class="contenedor testimoniales clearfix">

      <?php //Traer testimoniales desde SQL
                require 'includes/templates/funciones/config.php';
                $sql = "SELECT * FROM testimoniales WHERE activo = 1 LIMIT 3 ";
                $resultado = $link->query($sql);
                
          ?>
          <?php //Imprimir testimonales
            while($test = $resultado->fetch_assoc()) { ?>

                <div class="testimonial">
                  <blockquote>
                    <i class="fa fa-quote-left"></i>
                    <p><?php echo $test['texto']; ?></p>
                    <footer class="info-testimonial clearfix">
                      <img src="img/testimoniales/<?php echo $test['url_imagen']; ?>" alt="img_testimonio1">
                      <cite><?php echo $test['autor']." "; ?> <span><?php echo $test['puesto']; ?></span></cite>
                    </footer>
                  </blockquote>
                </div><!--testimonial-->

          <?php } ?>
    </div>
    <!--contenedor-->
  </section>

  <div class="newsletter parallax">
    <div class=" newsletter-registro contenedor">
      <p>Registrate al newsletter</p>
      <h3>VICONGRESO LE</h3>
      <a id="myBtn" class="button transparent">Registro</a>
    </div>
  </div>

  <div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Registrate al newletter</h2>
    
    <form id="registroNews" class="registroNews submit" action="#" method="post">
      <div class="campo form-group" id="campo-emailNews">
        <label for="email">Tu email:</label>
        <input type="text" id="email-news">
        <span class="help-block" id="help-block-apellido"></span>
      </div>
      <div class="campo form-group" id="campo-submitNews">
      <input type="submit" id="accion" class="button" value="registro">
      </div>
      </div>
    </form>
  </div>

</div>

  <section class="seccion">
    <h2>Faltan</h2>
    <div class="contenedor">
      <ul class="cuenta-regresiva clearfix">
        <li>
          <p id="dias" class="numero"></p>Dias
        </li>
        <li>
          <p id="hora" class="numero"></p>Horas
        </li>
        <li>
          <p id="minut" class="numero"></p>Minutos
        </li>
        <li>
          <p id="seg" class="numero"></p>Segundos
        </li>
      </ul>
    </div>
    <!--contenedor-->
  </section>

  <?php require_once('includes/templates/footer.php') ?>

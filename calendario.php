<?php require_once('includes/templates/header.php') ?>


  <section class="seccion contenedor pag-calendario">
    <h2>Calendario</h2>

    <?php
        try{
            require_once('includes/templates/funciones/config.php');
            $sql = "SELECT eventos.id_evento, eventos.nombre_evento, eventos.fecha_evento, eventos.hora_evento, categoria_evento.icono, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado
            FROM eventos
            INNER JOIN invitados
            ON eventos.id_invitado = invitados.id_invitado
            INNER JOIN categoria_evento
            ON eventos.cat_evento = categoria_evento.id_categoria
            ORDER BY eventos.hora_evento";
            $res = $link->query($sql);
        }catch(Exception $e){
            echo $e->getMessage();
        }
    ?>

    <div class="calendario">
        <?php 
        $calendario = array(); 
        
        while($eventos = $res->fetch_assoc() ){
        $fecha = $eventos['fecha_evento'];        
        
        $evento = array(
             'titulo' => $eventos['nombre_evento'],
             'fecha' => $eventos['fecha_evento'],
             'hora' => $eventos['hora_evento'],
             'categoria' => $eventos['cat_evento'],
             'icono' => $eventos['icono'],
             'invitado' => $eventos['nombre_invitado']. " ". $eventos['apellido_invitado']  
        );
        
        $calendario[$fecha][] = $evento;
        ?>


        <?php } ?>

        <?php 
            foreach( $calendario as $dia => $lista_eventos){ ?>
            <div class="x-dia">
            <div class="title-fecha">
            <h3 >
                <i class="fa fa-calendar"></i>
            <?php
                setlocale(LC_TIME, 'es.ES.UTF-8');
                setlocale(LC_TIME, 'spanish');

                echo utf8_encode(strftime('%A %d de %B', strtotime($dia)));
            ?>
            </h3>
            
            <i class="fas fa-caret-up cal-arrow"></i>
            </div>
            
            
            <div class="line-dia">
            <?php
                foreach($lista_eventos as $evento){ ?>
                <div class="dia">
                <p class="titulo"><?php echo $evento['titulo'];?></p>
                <p class="hora">
                <i class="fa fa-clock" aria-hiden="true"></i>
                    <?php echo $evento['hora'];?>
                </p>
                <p>
                <i class="<?php echo $evento['icono'];?>" aria-hiden="true"></i>
                    <?php echo $evento['hora'];?>
                </p>
                <p class="inv">
                <i class="fa fa-user" aria-hiden="true"></i>    
                <?php echo $evento['invitado'];?>
                </p>

                </div><!--dia-->
            
            <?php } //foreach evento ?>
            </div><!--line-dia-->
            </div><!--x-dia-->
        <?php } //foreach dia s?>
        
    </div>

            <?php $link->close(); ?>
  </section>

  <?php require_once('includes/templates/footer.php'); ?>

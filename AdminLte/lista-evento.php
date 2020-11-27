<?php 
  include_once('funciones/sesiones.php');

  include_once('templates/header.php');

  include_once('templates/barra.php');

  include_once('templates/sidenav.php');

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Eventos
        <small>Lista de eventos</small>
      </h1>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Mantenimiento de eventos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body contenedor-tabla">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Evento</th>
                  <th>Invitado</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoria</th>
                  <th>Clave</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    include_once('funciones/funciones.php');
                        try{
                            $sql = 'SELECT  eventos.id_evento, eventos.nombre_evento, CONCAT(invitados.nombre_invitado , " " , invitados.apellido_invitado) as invitado, eventos.fecha_evento, eventos.hora_evento, categoria_evento.cat_evento, eventos.clave FROM eventos
                            INNER JOIN invitados
                            ON eventos.id_invitado = invitados.id_invitado
                            INNER JOIN categoria_evento
                            ON eventos.cat_evento = categoria_evento.id_categoria';
                            $res = $link->query($sql);

                        }catch(Exception $e){
                            echo $e->getMessage();
                        }

                        while($evento = $res->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $evento['nombre_evento']; ?></td>
                                <td><?php echo $evento['invitado']; ?></td>
                                <td><?php echo $evento['fecha_evento']; ?></td>
                                <td><?php echo $evento['hora_evento']; ?></td>
                                <td><?php echo $evento['cat_evento']; ?></td>
                                <td><?php echo $evento['clave']; ?></td>
                                <td>
                                    <a href="editar-evento?id=<?php echo $evento['id_evento'];?>" class="btn bg-orange btn-flat margin">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" data-id="<?php echo $evento['id_evento']; ?>" data-tipo="evento" class="btn bg-maroon btn-flat margin borrar-registro">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                
                            </tr>

                        <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Evento</th>
                  <th>Invitado</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Categoria</th>
                  <th>Clave</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
  </div>
  <!-- /.content-wrapper -->

  <?php 
    include_once('templates/footer.php');
?>

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
        Invitados
        <small>Lista de invitados</small>
      </h1>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Mantenimiento de invitados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body contenedor-tabla">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Biografia</th>
                  <th>Imagen</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    include_once('funciones/funciones.php');
                        try{
                            $sql = "SELECT * FROM invitados";
                            $res = $link->query($sql);

                        }catch(Exception $e){
                            echo $e->getMessage();
                        }

                        while($invitado = $res->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $invitado['nombre_invitado']." ".$invitado['apellido_invitado']; ?></td>
                                <td><?php echo $invitado['descripcion']; ?></td>
                                <td><?php echo $invitado['url_imagen']; ?></td>
                                <td>
                                    <a href="editar-invitado?id=<?php echo $invitado['id_invitado'];?>" class="btn bg-orange btn-flat margin">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="#" data-id="<?php echo $invitado['id_invitado']; ?>" data-tipo="invitado" class="btn bg-maroon btn-flat margin borrar-registro">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                                
                            </tr>

                        <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Biografia</th>
                  <th>Imagen</th>
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


<?php 
  include_once('funciones/sesiones.php');

  include_once('funciones/funciones.php');

  include_once('templates/header.php');

  include_once('templates/barra.php');

  include_once('templates/sidenav.php');

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Evento
        <small>LLene el formulario para dar de alta nuevos eventos</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Crear Evento</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        <form role="form" name="guardar-registro" id="guardar-registro" method="post" action="modelo-evento.php" enctype="multipart/form-data">
              <div class="box-body">
                <!-- evento-->  
                <div class="form-group">
                  <label for="evento">Evento:</label>
                  <input type="text" class="form-control" id="evento" name="evento" placeholder="Ingrese evento">
                </div>
                <!-- Invitado-->
                <div class="form-group">
                  <label for="invitado">Invitado:</label>
                  <select class="form-control" name="invitados" id="invitados">
                <?php
                    $sql = "SELECT id_invitado, nombre_invitado, apellido_invitado FROM invitados";
                    $res = $link->query($sql);
                    while($inv = $res->fetch_assoc()){
                ?>
                        <option id="apellido" name="apellido" value="<?php echo $inv['id_invitado'];?>"> 
                        <?php echo $inv['nombre_invitado']." ".$inv['apellido_invitado'];?>
                        </option> 
                <?php
                    };
                ?>             
                  </select>
                </div>
                <!-- Fecha-->
                <div class="form-group">
                <label>Fecha:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input data-date-format="yyyy-mm-dd" autocomplete="off"  type="text" class="form-control pull-right" id="datepicker" name="fecha">
                </div>
                </div><!-- /.form group -->

                <!-- Hora -->
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                    <label>Hora:</label>

                        <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                            </div>
                            <input autocomplete="off" name="hora" type="text" class="form-control timepicker">
                        </div><!-- /.input group -->
                    </div><!-- /.form group -->
                </div>

                    <!-- categoria-->
                <div class="form-group">
                  <label for="categoria">Categoria:</label>
                  <select class="form-control" name="categorias" id="categorias">
                <?php
                    $sql = "SELECT id_categoria, cat_evento FROM categoria_evento";
                    $res = $link->query($sql);
                    while($cat = $res->fetch_assoc()){
                ?>
                        <option id="apellido" name="apellido" value="<?php echo $cat['id_categoria'];?>"> 
                        <?php echo $cat['cat_evento'];?>
                        </option> 
                <?php
                    };
                ?>             
                  </select>
                </div>

                <!-- evento-->  
                <div class="form-group">
                  <label for="clave">Clave:</label>
                  <input type="text" class="form-control" id="clave" name="clave" placeholder="Ingrese clave">
                </div>

              </div>     
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary" >Crear</button>
              </div>
            </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>

        </div>
    </div>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php 
    include_once('templates/footer.php');
?>
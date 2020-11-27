<?php 
  include_once('funciones/sesiones.php');

  include_once('funciones/funciones.php');

  $id = $_GET['id'];

  if(!filter_var($id, FILTER_VALIDATE_INT)){
      die('Error!');
  }
  include_once('templates/header.php');

  include_once('templates/barra.php');

  include_once('templates/sidenav.php');

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Invitado
        <small>LLene el formulario para editar el invitado</small>
      </h1>
    </section>

    <div class="row">
        <div class="col-md-8">

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Invitado</h3>

        <?php
            $sql = "SELECT nombre_invitado, apellido_invitado, descripcion, url_imagen FROM invitados WHERE id_invitado = $id";
            $res = $link->query($sql);
            $inv = $res->fetch_assoc();
        ?>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div>
        <div class="box-body">
        <form role="form" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-invitado.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre" value="<?php echo $inv['nombre_invitado']; ?>">
                </div>
                <div class="form-group">
                  <label for="apellido">Apellido:</label>
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingrese apellido" value="<?php echo $inv['apellido_invitado']; ?>">                
                </div>
                <div class="form-group">
                  <label for="descripcion">Descripcion:</label>
                  <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese descripcion"><?php echo $inv['descripcion']; ?></textarea>               
                </div>
                <div class="form-group">
                  <label for="imagen">Imagen actual:</label>
                  <br>
                  <img id="imagenMostrada" src="../img/invitados/<?php echo $inv['url_imagen']; ?>" alt="imagen_invitado" style=" max-width: 30%">
                </div>
                <div class="form-group">
                  <label for="foto">Fotografia:</label>
                  <input type="file" id="foto" name="foto">
                </div>
              </div>     
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="registro" value="editar">
                <input type="hidden" name="imgActual" value="<?php echo $inv['url_imagen']; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-primary" >Guardar</button>
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
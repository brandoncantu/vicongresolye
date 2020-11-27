<?php 
  include_once('funciones/sesiones.php');

  include_once('templates/header.php');

  include_once('templates/barra.php');

  include_once('templates/sidenav.php');

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper dashboard">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Resumen Evento</small>
      </h1>
    </section>

    <!-- Main row Chart -->
    <section class="content">
      <div class="row">
          <div class="box-body chart-responsive">
            <div class="chart" id="line-chart" style="height: 300px;">

            </div>
          </div>
        </div>
        <!-- /.row (main row) -->
    </section>

       <!-- Main content -->
      <?php require_once('funciones/eventos.php'); ?>
      <section class="content">  
        <!-- Small boxes (Stat box) -->
        <h2 class="page-header">Resumen Registros</h3>
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3><?php echo dashBoardInfo('all'); ?></h3>

                <p>Registrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3><?php echo dashBoardInfo('pagado'); ?></h3>

                <p>Pagados</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-plus"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3><?php echo dashBoardInfo('nopagado'); ?></h3>

                <p>Sin Pagar</p>
              </div>
              <div class="icon">
                <i class="fa fa-user-times"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3><?php echo "$ ".dashBoardInfo('total'); ?></h3>

                <p>Ganancias Totales</p>
              </div>
              <div class="icon">
                <i class="fa fa-dollar"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->



        <!-- Small boxes (Stat box) -->
        <h2 class="page-header">Extras</h3>
        <div class="row" id="regalos">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3 id="cantRegalo"><?php echo dashBoardInfo('all'); ?></h3>

                <p id="tipoRegalo">Regalos</p>
              </div>
              <div class="icon">
                <i class="fa fa-gift"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-maroon">
              <div class="inner">
                <h3><?php echo dashBoardInfo('stickers'); ?></h3>

                <p>Stickers</p>
              </div>
              <div class="icon">
                <i class="fa fa-sticky-note"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
              <div class="inner">
                <h3><?php echo dashBoardInfo('camisas'); ?></h3>

                <p>Camisas</p>
              </div>
              <div class="icon">
                <i class="fa fa-black-tie"></i>
              </div>
              <a href="lista-registrados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </section>

      

      

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php 
    include_once('templates/footer.php');
  ?>


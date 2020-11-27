<?php 
  session_start();
  if(isset($_GET['cerrar_sesion'])){
  $cerrar_sesion = $_GET['cerrar_sesion'];
  if($cerrar_sesion){
      session_destroy();
  }
}
  include_once('funciones/funciones.php');

  include_once('templates/header.php');

?>
<body class="hold-transition login-page">

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>VI</b>CONGRESO</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Inicia sesión para entrar a la plataforma</p>

    <form role="form" name="login-admin-form" id="login-admin" method="post" action="modelo-admin.php">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="usuario" placeholder="Usuario">
        <span class="form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8 remember-me">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Recordarme
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
            <input type="hidden" name="login-admin" value="1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">Olvide mi contraseña</a><br>

  </div>
  <!-- /.login-box-body -->
</div>

<script>
  window.onload = function() {
    alert("USER: demo\r\nPASSWORD: demo");
  };
</script>

<?php 
    include_once('templates/footer.php');
?>

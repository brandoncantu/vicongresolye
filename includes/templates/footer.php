<footer class="foot">
    <div class="contenedor footer-info clearfix">
      <div class="foot-part no">
        <h3>Sobre <span>VICONGRESO LE</span></h3>
        <p>EL VI Congreso de Líderes y Emprendores es un evento de
        alumnos para alumnos. El evento es en su totalidad responsabilidad
        de los alumnos de sexto semestre en modalidad bicultural </p>
      </div>
      <!--foot-part-->
      <div class="foot-part">
        <h3>Últimos <span>Tweets</span></h3>
        <ul class="tweets">
        <blockquote class="twitter-tweet" data-theme="dark"><p lang="es" dir="ltr">¡Gracias a todos por asistir a nuestro congreso! SON LO MÁXIMO ❤️</p>&mdash; VICongresoLyE (@VICongresoLyE) <a href="https://twitter.com/VICongresoLyE/status/862100289758875649?ref_src=twsrc%5Etfw">May 10, 2017</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>      </div>
      <!--foot-part-->
      <div class="foot-part no">
        <h3>Redes <span>Sociales</span></h3>
        <nav class="redes-sociales rsf">
          <?php include 'social-media.php'; ?>
        </nav>
      </div>
      <!--foot-part-->
    </div>
    <!--footer-info-->
    <div class="copyright">
      <p>Todos los Derechos Reservados VICONGRESO LE © 2017. </p>
    </div>
  </footer>

  
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')</script>
  <script src="js/plugins.js"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    if($pagina == 'invitados'){ echo '<script src="js/jquery.colorbox-min.js"></script>'; }else
    if($pagina == 'conferencias'){ echo '<script src="js/lightbox.js"></script>'; } else
    if($pagina == 'index'){ echo '<script src="js/jquery.waypoints.min.js"></script>'; } 
  ?>
  <script src="js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>
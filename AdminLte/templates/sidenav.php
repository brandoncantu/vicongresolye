<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="img/admins/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['nombre']; ?></p>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menú de Administración</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="admin-area"><i class="fa fa-circle-o"></i> Dashboard</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-calendar"></i>
            <span>Eventos</span>
            <span class="pull-right-container">
              <!--<span class="label label-primary pull-right">4</span>-->
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="lista-evento"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
            <li><a href="crear-evento"><i class="fa fa-plus-circle"></i> Agregar</a></li>
          </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-bookmark" style="color: #5c6366"></i>
                <span style="color: #5c6366">Categoria</span>
                <span class="pull-right-container">
                <!--<span class="label label-primary pull-right">4</span>-->
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="javascript:void(0)"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            </ul>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user"></i>
                <span>Invitados</span>
                <span class="pull-right-container">
                <!--<span class="label label-primary pull-right">4</span>-->
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="lista-invitado"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
                <li><a href="crear-invitado"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-address-card" style="color: #5c6366"></i>
                <span style="color: #5c6366">Registrados</span>
                <span class="pull-right-container">
                <!--<span class="label label-primary pull-right">4</span>-->
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="javascript:void(0)"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-comment" style="color: #5c6366"></i>
                <span style="color: #5c6366">Testimoniales</span>
                <span class="pull-right-container">
                <!--<span class="label label-primary pull-right">4</span>-->
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="javascript:void(0)"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="fa fa-pencil" style="color: #5c6366"></i>
                <span style="color: #5c6366">Administradores</span>
                <span class="pull-right-container">
                <!--<span class="label label-primary pull-right">4</span>-->
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="javascript:void(0)"><i class="fa fa-list-ul"></i> Ver Todos</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Agregar</a></li>
            </ul>
        </li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Secciones de la Pagina</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a target="_blank" href="../index"><i class="fa fa-circle-o"></i> Inicio</a></li>
            <li><a target="_blank" href="../invitados"><i class="fa fa-circle-o"></i> Invitados</a></li>
            <li><a target="_blank" href="../conferencias"><i class="fa fa-circle-o"></i> Conferencia</a></li>
            <li><a target="_blank" href="../registro"><i class="fa fa-circle-o"></i> Reservaciones</a></li>
            <li><a target="_blank" href="../calendario"><i class="fa fa-circle-o"></i> Calendario</a></li>
            <li><a target="_blank" href="../404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
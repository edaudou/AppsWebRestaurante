<html>

<head>
  <title>Restaurante</title>
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<nav class="navbarHotel">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Logo principal -->
            <a href="<?php echo ROOT_URL; ?>" class="navbar-brand">
                <img src="/restaurante/assets/img/logo.png" alt="Logo" style="width:42px;height:42px;">
            </a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Icono de calendario -->
                <li>
                    <a href="<?php echo ROOT_URL; ?>reservas">
                        <img src="/restaurante/assets/img/calendar.png" alt="Calendario" class="cal-icon">
                    </a>
                </li>

                <!-- Mostrar diferente contenido según sesión iniciada -->
                <?php if (isset($_SESSION['is_logged_in'])): ?>
                    <!-- Usuario autenticado: Mostrar dropdown con imagen -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle user-dropdown" role="button">
                            <img src="/restaurante/assets/img/<?php  echo $viewmodel['profile_image'] ?? 'user.png'; ?>" 
                                 alt="Usuario" class="user-icon">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo ROOT_URL; ?>users/perfil"><i class="fas fa-user"></i> Ver perfil</a></li>
                            <li><a href="<?php echo ROOT_URL; ?>tables"><i class="fas fa-table"></i> Gestión de mesas</a></li>
                            <li><a href="<?php echo ROOT_URL; ?>users"><i class="fas fa-user"></i> Gestión de usuarios</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo ROOT_URL; ?>users/logout"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- No autenticado: Mostrar Login y Registro -->
                    <li><a href="<?php echo ROOT_URL; ?>users/login">Iniciar sesión</a></li>
                    <li><a href="<?php echo ROOT_URL; ?>users/register">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

  <div class="container">
    <div class="row">
      <?php Messages::display(); ?>
      <?php require($view); ?>
    </div>
  </div><!-- /.container -->
                </div>
                <video autoplay muted loop id="myVideo">
  <source src="assets/video/restaurant.mp4" type="video/mp4">
</video>


<!-- CSS para activar el dropdown en hover -->
<style>
  .dropdown:hover .dropdown-menu {
    display: block;
  }
  .user-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
  }
</style>

</body>
</html>

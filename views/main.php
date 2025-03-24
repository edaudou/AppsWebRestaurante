<html>

<head>
  <title>Restaurante</title>
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo ROOT_PATH; ?>assets/css/style.css">
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
                    <!-- Usuario autenticado: Mostrar su imagen -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="/restaurante/assets/img/<?php echo $_SESSION['user_data']['profile_image'] ?? 'user.png'; ?>" 
                                 alt="Usuario" class="user-icon">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo ROOT_URL; ?>">Bienvenido <?php echo $_SESSION['user_data']['name']; ?></a></li>
                            <li><a href="<?php echo ROOT_URL; ?>users/logout">Cerrar sesión</a></li>
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

</body>

</html>
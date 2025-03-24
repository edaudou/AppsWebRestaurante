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
          <img src="/restaurante/assets/img/logo.png" alt="Logo" style="width:42px;height:42px;"/>
        </a>
      </div>

      <div id="navbar" class="collapse navbar-collapse">


        <ul class="nav navbar-nav navbar-right">
          <!-- Icono de calendario -->
          <a href="<?php echo ROOT_URL; ?>reservas"><img src="/restaurante/assets/img/calendar.png" alt="Usuario" class="cal-icon"></a>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <img src="/restaurante/assets/img/user.png" alt="Usuario" class="user-icon">
            </a>
          <!-- Menú desplegable del usuario -->
          <li class="dropdown">
          
            
            <ul class="dropdown-menu">
              <?php if (isset($_SESSION['is_logged_in'])): ?>
                <li><a href="<?php echo ROOT_URL; ?>">Welcome <?php echo $_SESSION['user_data']['name']; ?></a></li>
                <li><a href="<?php echo ROOT_URL; ?>users/logout">Logout</a></li>
              <?php else: ?>
                <li><a href="<?php echo ROOT_URL; ?>users/login">Login</a></li>
                <li><a href="<?php echo ROOT_URL; ?>users/register">Register</a></li>
              <?php endif; ?>
            </ul>
          </li>
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
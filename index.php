<?php
// Start Session
session_start();

// Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');
require('models/table.php');

require('controllers/home.php');
require('controllers/reservas.php');
require('controllers/users.php');
require('controllers/tables.php');

require('models/home.php');
require('models/reserva.php');
require('models/user.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../vendor/autoload.php";
require "./services/MidtermService.php";

Flight::register('midtermService', 'MidtermService');

require 'routes/MidtermRoutes.php';

Flight::start();
 ?>

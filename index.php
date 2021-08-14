<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");

require 'config.php';
require 'routers.php';
require 'helpers/functions.php';
require 'vendor/autoload.php';

$core = new Core\Core();
$core->run();
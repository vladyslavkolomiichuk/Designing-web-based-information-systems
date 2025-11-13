<?php
// Load Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load controller
include_once(__DIR__ . '/../controller/Controller.php');

// Create and run controller
$controller = new Controller();
$controller->invoke();

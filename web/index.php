<?php


defined('BASE_DIR') or define('BASE_DIR', realpath(__DIR__  . '/../'));

require_once BASE_DIR . '/vendor/autoload.php';

//ini_set('display_errors', 1);

\Core\Router::handleRequest();


?>
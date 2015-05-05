<?php

defined('DIR_ROOT') or define('DIR_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
$loader = require_once __DIR__.'/vendor/autoload.php';

$config = DIR_ROOT . 'config/main.php';
Core::createApplication($config)->run();
//Core::app()->run();
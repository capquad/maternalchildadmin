<?php

use Dotenv\Dotenv;
use Functions\Validator;

define('ROOT', $_SERVER['DOCUMENT_ROOT']);

require ROOT . '/src/autoload.php';
require ROOT . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(ROOT);
$dotenv->safeLoad();

if ($_ENV['MAINTENANCE'] === '1') {
  echo "Maintenance Mode";
  exit();
}
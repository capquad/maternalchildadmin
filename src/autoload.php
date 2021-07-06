<?php


spl_autoload_register(function ($path) {
  $root = $_SERVER['DOCUMENT_ROOT'];
  $file = $root . '/src/' . $path . '.php';
  $file = str_replace("/", DIRECTORY_SEPARATOR, $file);
  // echo $file;
  require_once $file;
});

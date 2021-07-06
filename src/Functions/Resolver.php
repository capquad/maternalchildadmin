<?php

namespace Functions;

/**
 * Resolver class
 * mainly for dealing with normailized access of files
 */
class Resolver
{
  /**
   * require function. uses the require function to request a file after
   * prepending with $_SERVER['DOCUMENT_ROOT']
   */
  static function require(string $path)
  {
    require $_SERVER['DOCUMENT_ROOT'] . '/' . $path . '.php';
  }
}

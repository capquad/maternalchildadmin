<?php

namespace Functions;

/**
 * Validator class: helper class for simple authentication and authorization
 */
class Validator
{
  /**
   * Validate: validate and authorize login. If not logged in redirect to login page
   */
  static function Validate()
  {
    if ($_SERVER['SCRIPT_NAME'] !== '/login.php') {
      if (@$_SESSION['login']['status'] !== true) {
        // echo "Not logged in.";
        header("Location: /login.php");
      }
    }
  }
}

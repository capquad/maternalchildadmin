<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require '../init.php';

if ($_POST) {
	// print_r($_POST);
	$username = Validator::validateString($_POST['username']);
	$password = Validator::validateString($_POST['password']);

	if ($username and $password) {
		$password = sha1($password);
		$db = new Database();
		if ($db->connect()) {
			$staff = $db->select('admin', null, "username='$username' and password='$password'")[0];

			if ($staff) {
				Response::RedirectWithSession('/', ['login' => true, 'staff' => $staff], 200);
			}
			// Response::Json(['ok' => true, $staff]);
		}
	}
}

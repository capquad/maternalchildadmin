<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require '../init.php';

$db = new Database();
$db->connect() or die("Couldn't connect to Database");

// Update patient details
if (@$_GET['endpoint'] === 'update') {
	$cardNumber = Validator::validateCardNumber($_POST['card-number']);
	$firstname = Validator::validateString($_POST['firstname']);
	$lastname = Validator::validateString($_POST['lastname']);
	$middlename = Validator::validateString($_POST['middlename']);
	$gender = Validator::validateOption($_POST['gender'], ['male', 'female']);
	$birthDate = Validator::validateDate($_POST['birthdate']);
	$phone = Validator::validatePhone($_POST['phone']);
	$email = Validator::validateEmail($_POST['email']);

	if ($cardNumber) {
		$update = $db->update('patients', ['firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename], "cardNumber='$cardNumber'");
		if ($update) {
			$update2 = $db->update('patient_details', [''], "cardNumber='$cardNumber'");
			Response::Json(['ok' => $update]);
		}
	}
}

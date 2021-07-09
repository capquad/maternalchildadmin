<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require '../init.php';

if (isset($_POST['card-number'])) {
	$db = new Database();
	if ($db->connect()) {
		$firstname = Validator::validateString($_POST['firstname']);
		$lastname = Validator::validateString($_POST['lastname']);
		$middlename = Validator::validateString($_POST['middlename']);
		$birthdate = Validator::validateDate($_POST['birthdate']);
		$gender = Validator::validateOption($_POST['gender'], ['male', 'female']);
		$email = Validator::validateEmail($_POST['email']);
		$phone = Validator::validatePhone($_POST['phone']);
		$cardNumber = Validator::cleanup($_POST['card-number']);
		$category = Validator::validateString($_POST['category']);

		$catCode = @$db->select('cards', 'code', "name='$_POST[category]'")[0]['code'];

		if (!$catCode) {
			Response::Json(['ok' => false, 'error' => 'Invalid Category supplied.']);
		}
		if ($firstname and $lastname and $cardNumber and $gender and $birthdate) {
			if ($db->insert('patients', ['firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename, 'category' => $category, 'registeredOn' => date('Y-m-d H:i:a'), 'cardNumber' => $cardNumber])) {
				if ($db->insert('patient_details', ['gender' => $gender, 'phone' => $phone, 'email' => $email, 'cardNumber' => $cardNumber])) {
					header("Location: /patients.php");
				} else {
					echo $db->getError();
				}
			} else {
				echo $db->getError();
			}
		}
	}
}

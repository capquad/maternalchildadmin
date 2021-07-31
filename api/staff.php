<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require '../init.php';

$db = new Database();
$db->connect();

if (@$_GET['endpoint'] === 'update') {
	// Validate POSTED Information
	if (!isset($_POST['staff'])) {
		Response::Json(['ok' => false, 'error' => 'Required information not fould. Please include staff field in your request body.'], 403);
	}
	$id = Validator::validateInteger($_POST['staff']);
	if ($id) {
		$title = Validator::validateOption($_POST['title'], ['mr', 'mrs', 'engr', 'dr']);
		$firstname = Validator::validateString($_POST['firstname']);
		$lastname = Validator::validateString($_POST['lastname']);
		$middlename = Validator::validateString($_POST['middlename']);
		$gender = Validator::validateOption($_POST['gender'], ['male', 'female']);
		$birthDate = Validator::validateDate($_POST['birthdate']);
		$email = Validator::validateEmail($_POST['email']);
		$phone = Validator::validatePhone($_POST['phone']);
		$office = Validator::validateOption($_POST['office'], ['records', 'ict', 'pharm', 'facility']);

		// Response::Json([$office, $_POST['office']]);
		$update1 = $db->update('staff', ['firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename, 'title' => $title], "id='$id'");


		$db->update('staff_details', ['phone' => $phone, 'email' => $email, 'gender' => $gender, 'birthDate' => $birthDate, 'office' => $office], "staffid='$id'");
		Response::Json(['ok' => true]);
	}
}

if (@$_GET['endpoint'] === 'create') {
	// Response::Json($_POST);
	// Response::Json(['error' => 1]);
	$title = Validator::validateOption($_POST['title'], ['engr', 'mr', 'mrs', 'dr']);
	$firstname = Validator::validateString($_POST['firstname']);
	$lastname = Validator::validateString($_POST['lastname']);
	$middlename = Validator::validateString(($_POST['middlename']));
	$gender = Validator::validateOption($_POST['gender'], ['male', 'female']);
	$email = Validator::validateEmail($_POST['email']);
	$phone = Validator::validatePhone($_POST['phone']);
	$office = Validator::validateOption($_POST['office'], ['records', 'ict', 'pharm', 'facility']);

	// Response::Json([$office]);

	if ($firstname and $lastname and $phone and $title and $gender) {
		$insertOne = $db->insert('staff', ['title' => $title, 'firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename]);
		if ($insertOne) {
			if ($db->insert('staff_details', ['staffid' => $insertOne, 'phone' => $phone, 'email' => $email, 'office' => $office])) {
				Response::Json(['ok' => true, 'id' => $insertOne]);
			}
			Response::Json(['ok' => false, 'error' => 'Staff Details not created successfully. Contact Admin']);
		}
	}

	Response::Json(['ok' => false, 'error' => 'Invalid input supplied']);
}


$staff = $db->select('staff', 'id, title,firstname, lastname, middlename');
$nstaff = array_map(function ($data) use ($db) {
	$details = $db->select('staff_details', 'office, phone, email, birthDate, facebook, twitter, linkedin', "staffid = '$data[id]'")[0];
	$data += $details;


	$data['name'] = "$data[firstname] $data[lastname] $data[middlename]";
	$data['office'] = ucfirst($data['office']);
	unset($data['firstname'], $data['lastname'], $data['middlename']);
	unset($details);
	return $data;
}, $staff);

Response::Json($nstaff);

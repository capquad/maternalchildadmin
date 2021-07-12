<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require '../init.php';

$db = new Database();
$db->connect();


if ($_POST) {
	$firstname = Validator::validateString($_POST['firstname']);
	$lastname = Validator::validateString($_POST['lastname']);
	$middlename = Validator::validateString(($_POST['middlename']));
	$gender = Validator::validateOption($_POST['gender'], ['male', 'female']);
	$email = Validator::validateEmail($_POST['email']);
	$title = Validator::validateOption($_POST['title'], ['engr', 'mr', 'mrs', 'dr']);
	$phone = Validator::validatePhone($_POST['phone']);

	if ($firstname and $lastname and $phone and $title and $gender) {
		$insertOne = $db->insert('staff', ['firstname' => $firstname, 'lastname' => $lastname, 'middlename' => $middlename]);
		if ($insertOne) {
			if ($db->insert('staff_details', ['staffid' => $insertOne, 'phone' => $phone, 'email' => $email])) {
				Response::Json(['ok' => true, 'id' => $insertOne]);
			}
			Response::Json(['ok' => false, 'error' => 'Staff Details not created successfully. Contact Admin']);
		}
	}


	Response::Json(['ok' => [$firstname, $lastname, $middlename, $gender, $email, $title, $phone]]);
}

// if (!isset($_GET) or !isset($_POST)) {
$staff = $db->select('staff', 'id, title,firstname, lastname, middlename');
$nstaff = array_map(function ($data) use ($db) {
	$details = $db->select('staff_details', 'office, phone, email, facebook, twitter, linkedin', "staffid = '$data[id]'")[0];
	$data += $details;

	// print_r($data);

	$data['name'] = "$data[firstname] $data[lastname] $data[middlename]";
	unset($data['firstname'], $data['lastname'], $data['middlename'], $data['id']);
	return $data;
}, $staff);

Response::Json($nstaff);
// }

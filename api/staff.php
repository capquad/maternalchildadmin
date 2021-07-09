<?php

use Database\Database;
use Functions\Response;

require '../init.php';

$db = new Database();
$db->connect();

$staff = $db->select('staff', 'id, firstname, lastname, middlename');

$nstaff = array_map(function ($data) use ($db) {
	$details = $db->select('staff_details', 'office, phone, email, facebook, twitter, linkedin', "staffid = '$data[id]'")[0];
	$data += $details;

	// print_r($data);

	$data['name'] = "$data[firstname] $data[lastname] $data[middlename]";
	unset($data['firstname'], $data['lastname'], $data['middlename'], $data['id']);
	return $data;
}, $staff);

Response::Json($nstaff);

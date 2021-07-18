<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require '../init.php';
require '../src/functions.php';

$db = new Database();

$db->connect();

$patients = $db->select('patients');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (!$_GET or @$_GET['_']) {
		$npatients = array_map(function ($patient) use ($db) {
			$details = $db->select('patient_details', null, "cardNumber='$patient[cardNumber]'")[0];
			$patient['card-no'] = $patient['cardNumber'];
			$patient['email'] = $details['email'];
			$patient['phone'] = $details['phone'];
			$patient['gender'] = $details['gender'];
			$patient['birthDate'] = $details['birthDate'];
			unset($patient['cardNumber']);
			unset($details);
			$patient['category'] = ucfirst($patient['category']);
			$patient['name'] = "$patient[lastname] $patient[firstname]";
			if ($patient['middlename']) {
				$patient['name'] .= " $patient[middlename]";
			}
			unset($patient['firstname'], $patient['lastname'], $patient['middlename']);


			return $patient;
		}, $patients);
		Response::Json($npatients);
	}
}

if (isset($_GET['getNewNumber'])) {
	if (isset($_GET['category'])) {
		$category = Validator::validateString($_GET['category']);

		if ($category) {
			$dbCat = @$db->select('cards', null, "name LIKE '$category'")[0];

			if ($dbCat) {
				$catCode = $dbCat['code'];

				$lastNumber = $db->select('patients', 'MAX(cardNumber) as latestNum', "cardNumber LIKE '$catCode%'")[0]['latestNum'];

				if (!$lastNumber) {
					$lastNumber = $catCode . '-00' . date('my');
				}

				$newNumber = constructPatientNumber($catCode, explode('-', $lastNumber)[1]);

				Response::Json(['ok' => true, 'data' => ['card-number' => $newNumber]], 200);
			} else {
				Response::Json(['ok' => false, 'error' => 'Supplied category does not exist'], 404);
			}
		}
		Response::Json(['ok' => false, 'error' => 'Invalid category supplied']);
	}
	Response::Json(['ok' => false, 'error' => 'No category indicated']);
}

<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require './init.php';

if (!@$_GET['patient']) {
	http_response_code(404);
	exit();
	// header("Location: /patients.php");
} else {
	$patientId = Validator::validateString($_GET['patient']);
	if ($patientId) {
		$db = new Database();

		$db->connect();

		$patient = $db->select('patients', 'cardNumber, firstname, lastname, middlename', "cardNumber='$patientId'")[0];

		$patient_details = $db->select('patient_details', null, "cardNumber='$patient[cardNumber]'")[0];

		$patient = array_merge($patient, $patient_details);
	} else {
		Response::Redirect('/patients.php', 403);
	}
}

$stylesheets = ['forms.css'];
require './views/snippets/header.php';
?>

<div id="main">
	<div class="container py-4">
		<h1><?= $patient['cardNumber'] ?></h1>
	</div>

	<div class="container">
		<form action="/api/patient.php?endpoint=update" class="async-form" id="patientForm" data-redirect="/patient.php?patient=<?= $patientId ?>">
			<div class="form-group">
				<div class="row align-items-center align-content-center">
					<label for="firstname">Firstname</label>
					<div class="col-10">
						<input type="text" name="firstname" id="firstname" class="form-control" required readonly value="<?= $patient['firstname'] ?>">
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger my-0" data-property='readonly' data-target='#firstname'>Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="lastname">Lastname</label>
					<div class="col-10">
						<input type="text" name="lastname" id="lastname" required="required" readonly="readonly" class="form-control" value="<?= $patient['lastname'] ?>">
					</div>
					<div class="col-2">
						<button type="button" data-property="readonly" data-target="#lastname" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="middlename">Middlename</label>
				<div class="row">
					<div class="col-10">
						<input type="text" name="middlename" id="middlename" readonly="readonly" class="form-control" value="<?= $patient['middlename'] ?>">
					</div>
					<div class="col-2">
						<button type="button" data-target="#middlename" data-property="readonly" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="f-gender">Gender</label>
				<div class="row">
					<input type="hidden" id="gender" name="gender" value="<?= $patient['gender'] ?>">
					<div class="col-10">
						<select id="f-gender" class="form-control" required="required" disabled="disabled">
							<option value="male" <?= $patient['gender'] === 'male' ? "selected='selected'" : '' ?>>Male</option>
							<option value="female" <?= $patient['gender'] === 'female' ? "selected='selected'" : '' ?>>Female</option>
						</select>
					</div>
					<div class="col-2">
						<button type="button" data-target="#f-gender" data-property="disabled" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="phone">Phone Number</label>
				<div class="row">
					<div class="col-10">
						<input type="text" name="phone" id="phone" required="required" readonly="readonly" class="form-control" value="<?= $patient['phone'] ?>">
					</div>
					<div class="col-2">
						<button type="button" data-target="#phone" data-property="readonly" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="email">E-mail Address</label>
				<div class="row">
					<div class="col-10">
						<input type="email" name="email" id="email" class="form-control" required="required" readonly="readonly" value="<?= $patient['email'] ?>">
					</div>
					<div class="col-2"><button type="button" class="btn btn-danger my-0" data-property="readonly" data-target="#email">Edit</button></div>
				</div>
			</div>
			<div class="form-group">
				<label for="birthdate">Date of Birth</label>
				<div class="row">
					<div class="col-10">
						<input type="date" name="birthdate" id="birthdate" required="required" readonly="readonly" class="form-control" value="<?= $patient['birthDate'] ?>">
					</div>
					<div class="col-2"><button class="btn btn-danger my-0" type="button" data-property="readonly" data-target="#birthdate">Edit</button></div>
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="card-number" value="<?= $patient['cardNumber'] ?>" />
				<input type="submit" class="btn btn-primary" value="Submit" name="updatePatient" />
				<button type="button" class="btn btn-success" id="check-in" data-info="<?= $patient['cardNumber'] ?>">Check In</button>
			</div>
		</form>
	</div>

	<!-- <div class="container mt-4">
		<?= print_r($patient, true) ?>
	</div> -->
</div>

<?php
$scripts = ['patient.js', 'patientedit.js'];
require './views/snippets/footer.php';

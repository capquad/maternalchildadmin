<?php

use Functions\Resolver;

require './init.php';

$stylesheets = ['forms.css'];
require './views/snippets/header.php';
?>
<div id="main">
	<div class="container py-3">
		<h2>Create New Patient</h2>
	</div>

	<div class="container px-3">
		<form action="/src/newpatient.php" method="post" id="new-patient-form">
			<div class="form-group">
				<label for="firstname" class="required">Firstname</label>
				<input type="text" name="firstname" id="firstname" class="form-control" required="required" />
			</div>
			<div class="form-group">
				<label for="lastname" class="required">Lastname</label>
				<input type="text" name="lastname" id="lastname" required="required" class="form-control" />
			</div>
			<div class="form-group">
				<label for="middlename">Middle name</label>
				<input type="text" name="middlename" id="middlename" class="form-control" />
			</div>
			<div class="form-group">
				<label for="birthdate" class="required">Date of Birth</label>
				<input type="date" name="birthdate" id="birthdate" class="form-control" required />
			</div>
			<div class="form-group">
				<label for="gender" class="required">Gender</label>
				<br />
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" value="male" id="male" name="gender" />
					<label class="form-check-label" for="male">Male</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" value="female" id="female" name="gender" />
					<label class="form-check-label" for="female">Female</label>
				</div>
			</div>
			<div class="form-group">
				<label for="category" class="required">Category</label>
				<select name="category" id="category" class="form-control">
					<option value="personal">Personal</option>
					<option value="antenatal">Antenatal</option>
				</select>
			</div>
			<div class="form-group">
				<label for="card-number" class="required">Card Number</label>
				<input type="text" name="card-number" id="card-number" readonly="readonly" class="form-control" required>
				<button type="button" id="generateNumber" class="btn btn-danger">Generate Number</button>
			</div>
			<div class="form-group">
				<label for="phone">Phone Number</label>
				<input type="text" name="phone" id="phone" class="form-control">
			</div>
			<div class="form-group">
				<label for="email">E-mail Address</label>
				<input type="email" name="email" id="email" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Register</button>
			</div>
		</form>
	</div>
</div>
<?php
$scripts = ['patients.js'];
require './views/snippets/footer.php';

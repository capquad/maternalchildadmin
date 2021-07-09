<?php

require './init.php';

$stylesheets = ['forms.css'];
require './views/snippets/header.php';
?>
<div id="main">
	<div class="container py-3">
		<h1>New Staff</h1>
	</div>
	<div class="container">
		<form action="#" method="POST">
			<div class="form-group">
				<label for="title">Title</label>
				<select name="title" id="title" class="form-control">
					<option value="mr">Mr.</option>
					<option value="mrs">Mrs.</option>
					<option value="dr">Dr.</option>
					<option value="engr">Engr.</option>
				</select>
			</div>
			<div class="form-group">
				<label for="firstname" class="required">Firstname</label>
				<input type="text" name="firstname" id="firstname" required="required" class="form-control" />
			</div>
			<div class="form-group">
				<label for="lastname" class="required">Lastname</label>
				<input type="text" name="lastname" id="lastname" class="form-control" />
			</div>
			<div class="form-group">
				<label for="middlename">Middlename</label>
				<input type="text" name="middlename" id="middlename" class="form-control" />
			</div>
			<div class="form-group">
				<label for="phone" class="required">Phone Number</label>
				<input type="text" name="phone" id="phone" required="required" class="form-control" />
			</div>
			<div class="form-group">
				<label for="gender" class="required">Gender</label>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" value="male" id="male" />
					<label class="form-check-label" for="male">Male</label>
				</div>
				<div class="form-check form-check-inline">
					<input class="form-check-input" type="radio" value="female" id="female" />
					<label class="form-check-label" for="female">Female</label>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
$scripts = [];
require './views/snippets/footer.php';

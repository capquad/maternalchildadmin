<?php

use Database\Database;
use Functions\Response;
use Functions\Validator;

require './init.php';

$stylesheets = ['table.css', 'forms.css'];

if (isset($_GET['staff'])) {
	$staffId = Validator::validateInteger($_GET['staff']);
	if ($staffId === 0 or $staffId) {
		$db = new Database();
		$db->connect();

		$staff = @$db->select('staff', null, "id='$staffId'")[0];

		if (!$staff) {
			http_response_code(404);
			exit();
		}

		$staff['name'] = "$staff[lastname] $staff[firstname] $staff[middlename]";

		$staffDetails = $db->select('staff_details', null, "staffid='$staffId'")[0];

		$staff = array_merge($staff, $staffDetails);

		require './views/snippets/header.php';
		require './views/snippets/staffdata.php';
		$scripts = ['patientedit.js'];
	}
} else {
	require './views/snippets/header.php';
	echo <<<_HTML
	<div id="main">
	<div class="container py-3">
		<h1>Staff</h1>
	</div>
	
	<div class="container">
	<table class="data-table display">
		<thead>
			<tr>
				<th></th>
				<th>Name</th>
			<th>Department</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	</div>
	</div>
	_HTML;
	$scripts = ['staff.js'];
}

require './views/snippets/footer.php';

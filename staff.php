<?php

require './init.php';

$stylesheets = ['table.css'];
require './views/snippets/header.php';
?>

<div id="main">
	<div class="container py-3">
		<h1>Staff</h1>
	</div>

	<div class="container">
		<table class="data-table">
			<thead>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Department</th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>
	</div>
</div>

<?php
$scripts = ['staff.js'];
require './views/snippets/footer.php';

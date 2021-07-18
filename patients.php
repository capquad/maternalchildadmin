<?php

use Functions\Resolver;

require './init.php';

$stylesheets = ['table.css'];
require './views/snippets/header.php';
?>

<div id="main">
	<div class="container py-4">
		<h2>Patients</h2>
	</div>

	<div class="table-wrapper container">
		<table id="data-table" class="display">
			<thead>
				<tr>
					<th></th>
					<th>Card</th>
					<th>Name</th>
					<th>Category</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<?php
$scripts = ['Datatable.js', 'patients.js'];
require './views/snippets/footer.php';

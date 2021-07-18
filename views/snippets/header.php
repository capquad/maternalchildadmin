<?php
global $stylesheets, $title;
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon">
	<?php
	if ($_ENV['CDN'] === '0') {
		echo <<<_LINKS
		<link rel="stylesheet" href="/assets/vendor/Font-Awesome/css/all.min.css">
		<link rel="stylesheet" href="/assets/vendor/datatables.net-dt/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="/assets/vendor/bootstrap/dist/css/bootstrap.min.css">
		_LINKS;
	} else {
		echo <<<_LINKS
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		_LINKS;
	}
	?>

	<link rel="stylesheet" href="/assets/css/index.css">
	<?php

	if ($stylesheets) {
		foreach ($stylesheets as $sheet) {
			echo "<link rel='stylesheet' href='/assets/css/$sheet'>\n";
		}
	}
	?>
	<title><?= $title ? $title : 'MCAdmin' ?></title>
	<?php
	if ($_ENV['CDN'] === '0') {
		echo <<<_SCRIPTS
		<script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
		<script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
		<script src="/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>

		_SCRIPTS;
	} else {
		echo <<<_SCRIPTS
		<script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

		_SCRIPTS;
	}
	?>
</head>

<body>
	<aside id="sidebar">
		<button class="btn text-white" id="closeNav">
			<i class="fas fa-times"></i>
		</button>
		<div class="head p-2">
			<a href="/"> Dashboard</a>
			<span><img src="/assets/logo.png"></span>
		</div>

		<div class="sidenav-nav">
			<ul class="sidenav">
				<li class="drop"><a href="#" class="drop-toggle"><i class="fa fa-user"></i>Patients</a>
					<div class="dropmenu">
						<ul class="side-drop-menu">
							<li><a href="/patients.php">Patients</a></li>
							<li><a href="/add-patient.php">New Patients</a></li>
						</ul>
					</div>
				</li>

				<li class="drop">
					<a href="#" class="drop-toggle"><i class="fa fa-female"></i>Staff</a>
					<div class="dropmenu">
						<ul class="side-drop-menu">
							<li><a href="/staff.php">Staff List</a></li>
							<li><a href="/newstaff.php">New Staff</a></li>
						</ul>
					</div>
				</li>
				<li><a href="/orders.php"><i class="fas fa-list"></i></i>Orders</a></li>
			</ul>
		</div>

		<div class="copyright text-center text-white">
			<p>Maternal-Child Specialists' Clinics &copy;2021</p>
		</div>
	</aside>

	<main>
		<header class="bg-white">
			<div id="topbar">
				<button id="openNav" class="btn">
					<i class="fa fa-bars"></i>
				</button>

				<div class="utilities">
					<div class="dropdown">
						<button class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="notificationDrop">
							<i class="fa fa-bell"></i>
							<span class="badge bg-danger">3</span>
						</button>

						<ul class="dropdown-menu" aria-labelledby="notificationDrop">
						</ul>
					</div>
					<div class="dropdown">
						<button class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="messagesDrop">
							<i class="fa fa-mail-bulk"></i>
							<span class="badge bg-danger">3</span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="messagesDrop">

						</ul>
					</div>
					<div class="dropdown">
						<button class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" id="profileDrop" title="Profile">
							<i class="fa fa-user-circle"></i>
						</button>
						<ul class="dropdown-menu" aria-labelledby="profileDrop">
							<li><a class="dropdown-item" href="/profile.php">Profile</a></li>
							<li><a class="dropdown-item" href="/login.php">Log Out</a></li>
						</ul>
					</div>
				</div>

			</div>
		</header>
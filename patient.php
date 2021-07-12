<?php

require './init.php';

if (!$_GET['patient']) {
	header("Location: /patients.php");
}

require './views/snippets/header.php';
?>

<?php

require './views/snippets/footer.php';

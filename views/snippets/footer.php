<?php
global $scripts;
?>
</main>

<script src="/assets/js/functions.js"></script>
<script src="/assets/js/main.js"></script>
<?php
if ($scripts) {
	foreach ($scripts as $script) {
		echo "<script src='/assets/js/$script'></script>\n";
	}
}
?>
</body>

</html>
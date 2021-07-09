<?php
global $scripts;
?>
</main>

<script src="/assets/js/main.js"></script>
<?php
if ($scripts) {
	foreach ($scripts as $script) {
		echo "<script src='/assets/js/$script' type='module'></script>\n";
	}
}
?>
</body>

</html>
<!DOCTYPE html>
<html>
	<?php require_once("header.php") ?>

<body>
	<div class="container">
		<?php require_once("menu.php") ?>

			<?php 
				if (isset($path)) {
					require_once($path);
				}
			?>

		<?php //require_once("footer.php") ?>
	</div>
</body>
</html>